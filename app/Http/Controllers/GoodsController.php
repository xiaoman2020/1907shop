<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Goods;
use App\Brand;
use App\Category;
use App\Cart;
use App\Http\Requests\StoreGoodsPost;
use Validator;
use Illuminate\Support\Facades\Redis;

class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *商品列表
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //showMsg(1,'Hello World!');

        $goods_name = request() -> goods_name??'';

        $goods_url = request() -> goods_url??"";

        $where = [];

        if($goods_name){
            $where[] = ['goods_name','like',"%$goods_name%"];
        }
        if($goods_url){
            $where[] = ['goods_url','like',"%$goods_url%"];
        }

        $pageSize = config('app.pageSize');
        //ORM操作
        $data = Goods::select('goods.*','brand.brand_name','category.cate_name')
                ->leftjoin('category','goods.cate_id','=','category.cate_id')
                ->leftjoin('brand','goods.brand_id','=','brand.brand_id')
                ->orderBy('goods_id','desc')
                ->where($where)
                ->paginate($pageSize);
//        dd($data);

        //多文件
        foreach($data as $v){
            if($v -> goods_imgs){

                $v -> goods_imgs = explode('|',$v->goods_imgs);

            }

        }
       $query = request() -> all();
        //dd($query);
        if(request() -> ajax()){
            return view('admin.goods.ajaxindex',['data'=>$data,'query'=>$query]);
        }
        return view('admin.goods.index',['data' => $data,'query' => $query]);

    }

    /**
     * Show the form for creating a new resource.
     *商品添加
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //获取品牌数据
        $brand = Brand::get();
        //获取分类数据
        $cate = Category::get();
        $cate = createTree($cate);

        return view('admin.goods.create',['brand'=>$brand,'cate'=>$cate]);
    }

    /**
     * Store a newly created resource in storage.
     *执行添加
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(request $request)
    {
        //第一种验证
//       $validatedData = $request->validate([
//           'goods_name' => 'required|unique:goods|max:255',
//           'goods_url' => 'required',
//       ],[
//               'goods_name.required'=>'品牌名称必填!',
//               'goods_name.unique'=>'品牌名称已存在!',
//               'goods_url.required'=>'品牌网址必填!',
//           ]
//       );

        $post = request() -> except('_token');


        //单文件上传

        if(request()->hasFile('goods_img')){

            $post['goods_img'] = upload('goods_img');

        }

        //多文件上传
        if(isset($post['goods_imgs'])){

            $post['goods_imgs'] = moreuploads('goods_imgs');
            $post['goods_imgs'] = implode('|',$post['goods_imgs']);

        }
        //dd($post);
        $post['create_time'] = time();
        $post['update_time'] = time();
        //dd($post);


        //ORM操作
        $res = Goods::create($post);

        //dd($res);

        if($res){

            return redirect('/goods');

        }
    }



    /**
     * Display the specified resource.
     *详情页展示
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($goods_id)
    {
        $goods = Goods::find($goods_id);

        Redis::setnx('num'.$goods_id,0);

        Redis::incr('num'.$goods_id);

        $num = Redis::get('num'.$goods_id);

        return view('admin.goods.show',['goods'=>$goods,'num'=>$num]);

    }

    //public function addCookiecart($goods_id,$buy_nmber){
//
//        //求商品添加信息
//        $goods =  Goods::where('id',$goods_id)->first();
//
//        $data['goods'.$goods_id] = [
//            'goods_id' => $goods__id,
//            'buy_number'=> $buy_nmber,
//            'price' =>$goods -> price,
//            'add_time'=>time(),
//        ];
//        return response()->json(['code' => '00000','msg'>'加入购物车成功']) ->cookie();
//
//    }

    /**
     * Display the specified resource.
     *添加购物车
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function addcart()
    {
        $goods_id = request() -> goods_id;
        $buy_number = 1;
        //判断用户是否登录
        if($this -> isLogin()){

            //echo json_encode(['code'=>'00001','msg'=>'未登录，请先登录']);die;
            //未登录存入cookie
            //return $this -> addCookiecart($goods_id,$buy_number);
        }
        //登录存入db
        return $this -> addDBcart($goods_id,$buy_number);

    }

    public function addDBcart($goods_id,$buy_number)
    {
        //求商品添加信息
        $goods =  Goods::where('goods_id',$goods_id)->first();

        //判断库存
        if($goods -> goods_num < $buy_number){

            echo json_encode(['code'=>'00002','msg'=>'库存不足']);die;

        }

        $user_id = session('admin')->admin_id;

        //判断用户是否购买之前
        $cart = Cart::where(['goods_id' => $goods_id,'admin_id'=>$goods_id])->first();

        if($cart){

            //判断库存
            if($cart -> buy_number + $buy_number > $goods -> goods_num ){

                echo json_encode(['code'=>'00002','msg'=>'库存不足']);die;

            }

            //更新购买数量
            $res = Cart::where(['goods_id'=>$goods_id,'$admin_id'=>$user_id])->increment('buy_number');

            if($res) {echo json_encode(['code'=>'00000','msg'=>'加入购物车成功']);die;}
        }

        //没有购买过   则正常添加数据
        $data = [
            'admin_id' => $user_id,
            'goods_id' => $goods_id,
            'buy_number'=> 1,
            'price' =>$goods -> price,
            'add_time'=>time(),
        ];
        $res = Cart::create($data);

        if($res){

            echo json_encode(['code'=>'00000','msg'=>'加入购物车成功']);die;

        }
    }

    public function isLogin(){

        $user = session('admin');

        if(!$user){

            return false;
        }
        return true;
    }

    /**
     * Show the form for editing the specified resource.
     *编辑页面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        //ORM操作
        $data = Goods::where('goods_id',$id) -> first();

        return view('admin.goods.edit',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *执行编辑
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = $request -> except('_token');

        //单文件上传

        if($request->hasFile('goods_img')){

            $post['goods_img'] = upload('goods_img');

        }

        //ORM操作
        $res = Goods::where('goods_id','=',$id)->update($post);

        if($res !== false){

            return redirect('/goods');

        }

    }

    /**
     * Remove the specified resource from storage.
     *删除页面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        //ORM操作
        $res = Goods::destroy($id);

        if($res){

            return redirect('/goods');

        }

    }

    public function checkOnly()
    {
        $goods_name = request() -> goods_name;

        $where = [];

        if($goods_name){

            $where['goods_name'] = $goods_name;

        }

        $count = Goods::where($where) -> count();

        echo intval($count);
    }
}
