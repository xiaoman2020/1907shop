<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Category;
use App\Http\Requests\StoreCategoryPost;
use Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *分类列表
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        //$data = DB::table('category')-> orderBy('cate_id','desc')->paginate(2);

        //ORM操作
        $data = Category::get();

        //无限极分类
        $data = createTree($data);

        return view('admin.category.index',['data'=>$data]);

    }

    /**
     * Show the form for creating a new resource.
     *分类添加
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Category::get();

        //无限极分类
        $data = createTree($data);

        return view('admin.category.create',['data'=>$data]);
    }

    /**
     * Store a newly created resource in storage.
     *执行添加
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(request $request)

        //第二种验证
        //public function store(StoreCategoryPost $request)
    {
        //第一种验证
//        $validatedData = $request->validate([
//            'category_name' => 'required|unique:category|max:255',
//        ],[
//                'category_name.required'=>'品牌名称必填!',
//                'category_name.unique'=>'品牌名称已存在!',
//            ]
//        );

        $post = $request -> except('_token');

//        //第三种
//        $validator = Validator::make($post, [
//            'category_name' => 'required|unique:category|max:255',
//        ],[
//                'category_name.required'=>'分类名称必填!',
//                'category_name.unique'=>'分类名称已存在!',
//            ]
//        );
//        if ($validator->fails()) {
//            return redirect('category/create')
//                ->withErrors($validator)
//                ->withInput();
//        }


        //dd($post);

        //db操作
        //$res = DB::table('category') -> insert($post);

        //ORM操作
        $res = Category::create($post);

//        dd($res);

        if($res){

            return redirect('/category');

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
        //$data = DB::table('category') -> where('category_id','=',$id) -> first();

        //ORM操作
        $data = Category::where('category_id',$id) -> first();

        return view('admin.category.edit',['data'=>$data]);
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



        //$res = DB::table('category') -> where('category_id','=',$id) -> update($post);

        //ORM操作
        $res = Category::where('category_id','=',$id)->update($post);

        if($res !== false){

            return redirect('/category');

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
        //$res = $data = DB::table('category') -> where('category_id','=',$id) -> delete();

        //ORM操作
        $res = Category::destroy($id);

        if($res){

            return redirect('/category');

        }

    }
}
