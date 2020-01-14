<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Brand;
use App\Http\Requests\StoreBrandPost;
use Validator;
use Illuminate\Support\Facades\Cache;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *品牌列表
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //cache 门面 use Illuminate\Support\Facades\Cache;
//        Cache::put('key', 'value', $seconds); //存储
//        Cache::get('key'); //获取
//        Cache::forget('key');//删除
//
//        //全局辅助函数
//        cache(['key' => 'value'], $seconds);//存储
//        $value = cache('key');//获取

        //showMsg(1,'Hello World!');

        $brand_name = request() -> brand_name??'';

        $brand_url = request() -> brand_url??"";

        $page = request() -> page?:1;


        $data = cache('data_'.$page.'-'.$brand_name.'-'.$brand_url);
//        echo 'data_'.$page;
//
//        dump($data);
        if(!$data) {
            //echo "走db";
            $where = [];

            if ($brand_name) {
                $where[] = ['brand_name', 'like', "%$brand_name%"];
            }
            if ($brand_url) {
                $where[] = ['brand_url', 'like', "%$brand_url%"];
            }

            //监听
            //DB::connection()->enableQueryLog();

            //$data = DB::table('brand')-> orderBy('brand_id','desc')->paginate(2);

            //ORM操作
            $data = Brand::where($where)->orderBy('brand_id', 'desc')->paginate(2);

            cache(['data_'.$page.'-'.$brand_name.'-'.$brand_url => $data], 20);

        }

        //监听
        //$logs = DB::getQueryLog();

        $query = request() -> all();
        //dd($query);

        if(request() -> ajax()){

            return view('admin.brand.ajaxindex',['data'=>$data,'query'=>$query]);

        }

        return view('admin.brand.index',['data' => $data,'query' => $query]);

    }

    /**
     * Show the form for creating a new resource.
     *品牌添加
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *执行添加
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(request $request)

        //第二种验证
    //public function store(StoreBrandPost $request)
    {
        //第一种验证
//        $validatedData = $request->validate([
//            'brand_name' => 'required|unique:brand|max:255',
//            'brand_url' => 'required',
//        ],[
//                'brand_name.required'=>'品牌名称必填!',
//                'brand_name.unique'=>'品牌名称已存在!',
//                'brand_url.required'=>'品牌网址必填!',
//            ]
//        );

        $post = $request -> except('_token');

        //第三种
        $validator = Validator::make($post, [
            'brand_name' => 'required|unique:brand|max:255',
            'brand_url' => 'required',
        ],[
                'brand_name.required'=>'品牌名称必填!',
                'brand_name.unique'=>'品牌名称已存在!',
                'brand_url.required'=>'品牌网址必填!',
            ]
    );
        if ($validator->fails()) {
            return redirect('brand/create')
                ->withErrors($validator)
                ->withInput();
        }


        //单文件上传

        if($request->hasFile('brand_logo')){

            $post['brand_logo'] =upload('brand_logo');

        }
        //dd($post);

        //db操作
        //$res = DB::table('brand') -> insert($post);

        //ORM操作
        $res = Brand::create($post);

//        dd($res);

        if($res){

            return redirect('/brand');

        }
    }



    /**
     * Display the specified resource.
     *详情页展示
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *编辑页面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$data = DB::table('brand') -> where('brand_id','=',$id) -> first();

        //ORM操作
        $data = Brand::where('brand_id',$id) -> first();

        return view('admin.brand.edit',['data'=>$data]);
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

        if($request->hasFile('brand_logo')){

            $post['brand_logo'] =upload('brand_logo');

        }

        //$res = DB::table('brand') -> where('brand_id','=',$id) -> update($post);

        //ORM操作
        $res = Brand::where('brand_id','=',$id)->update($post);

        if($res !== false){

            return redirect('/brand');

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
        //$res = $data = DB::table('brand') -> where('brand_id','=',$id) -> delete();

        //ORM操作
        $res = Brand::destroy($id);

        if($res){

            return redirect('/brand');

        }

    }

    public function checkOnly()
    {
       $brand_name = request() -> brand_name;

        $where = [];

        if($brand_name){

            $where['brand_name'] = $brand_name;

        }

        $count = Brand::where($where) -> count();

        echo intval($count);
    }
}
