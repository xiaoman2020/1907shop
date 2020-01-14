<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Area;
use Illuminate\Support\Facades\Redis;


class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *售楼列表
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $name = request() -> name??'';

        $page = request() -> page?:1;

        $data = Redis::get('area_'.$page.'_'.$name);//获取

        //dump ($data);

        if(!$data) {

            echo "走数据库";

            $where = [];

            if ($name) {

                $where[] = ['name', 'like', "%$name%"];

            }

            //ORM操作
            $data = Area::where($where)->orderBy('id', 'desc')->paginate(2);

           // dd($data);

            $data =serialize($data);

            Redis::setex('area_'.$page.'_'.$name,20,$data);
        }

        $data = unserialize($data);

        $query = request()->all();

//        Redis::add('num',0);
//
//        Redis::increment('num');
//
//        $num = Redis::get('num');

        return view('admin.area.index', ['data' => $data,'query'=>$query]);

    }

    /**
     * Show the form for creating a new resource.
     *售楼添加
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.area.create');
    }

    /**
     * Store a newly created resource in storage.
     *执行添加
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(request $request)
    {

        $post = $request->except('_token');
//dd($post);

        //单文件上传

        if ($request->hasFile('img')) {

            $post['img'] = upload('img');

        }

        //多文件上传
//        if ($post['imgs']) {
//
//            $post['imgs'] = moreuploads('imgs');
//
//            $post['imgs'] = implode('|', $post['imgs']);
//
//        }


        //ORM操作
        $res = Area::insert($post);

//        dd($res);

        if ($res) {

            return redirect('/area');

        }
    }


    /**
     * Display the specified resource.
     *详情页展示
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data=Area::where('id',$id)->get();

        $res = Redis::setnx('num'.$id,1);//之前没有初始化自增1

        if(!$res){

            Redis::incr('num'.$id);

        }

        $num=Redis::get('num'.$id);

        return view('admin.area.show',['num'=>$num,'data'=>$data]);
    }


    /**
     * Show the form for editing the specified resource.
     *编辑页面
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *执行编辑
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *删除页面
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        //ORM操作
//        $res = Area::destroy($id);
//
//        if ($res) {
//
//            return redirect('/area');
//
//        }


        //echo $id;die;

        $data = area::destroy($id);

        if($data){

            if(request()->ajax()){

                echo json_encode(['code'=>'00000','msg'=>'删除成功']);die;


            }
        }


    }
}
