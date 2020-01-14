<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>商品管理</title>
    <link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">
    <script src="/static/admin/js/jquery.js"></script>
    <script src="/static/admin/js/bootstrap.min.js"></script>
</head>
<body>
<div align="center">
    <h3>商品列表</h3>
    <h3>欢迎【{{session('admin')->username}}】登录,<a href="{{url('/logout')}}">退出</a></h3>
    <a href="{{url('/goods/create/')}}">添加</a>
    <hr/>

</div>
<hr>
<table class="table table-striped">
    <thead>
    <tr>
        <th>商品id</th>
        <th>商品名称</th>
        <th>商品价格</th>
        <th>商品货号</th>
        <th>分类id</th>
        <th>品牌id</th>
        <th>库存</th>
        <th>赠送积分</th>
        <th>图片</th>
        <th>添加时间</th>
        <th>商品相册</th>
        <th>商品详情</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    @if($data)
        @foreach($data as $v)
            <tr>
                <td>{{$v->goods_id}}</td>
                <td>{{$v->goods_name}}</td>
                <td>{{$v->goods_price}}</td>
                <td>{{$v->goods_no}}</td>
                <td>{{$v->cate_name}}</td>
                <td>{{$v->brand_name}}</td>
                <td>{{$v->goods_num}}</td>
                <td>{{$v->goods_score}}</td>
                <td>
                    <img src="{{env('UPLOAD_URL')}}{{$v->goods_img}}" width="100px"/>
                </td>
                <td>{{date('Y-m-d H:i:s',$v->create_time)}}</td>

                <td>
                    @if($v->goods_imgs)
                    @foreach($v->goods_imgs as $vv)
                    <img src="{{env('UPLOAD_URL')}}{{$vv}}" width="100px"/>
                    @endforeach
                        @endif
                </td>
                <td>{{$v->goods_desc}}</td>
                <td>
                    <a href="{{url('/goods/edit/'.$v->goods_id)}}">编辑</a>
                    <a onclick="ajaxdel({{$v->goods_id}})" href="javascript:void(0)">删除</a>
                    {{--<a href="{{url('/goods/del/'.$v->id)}}" class="btn btn-danger">删除</a>--}}
                    <a href="{{url('/goods/show/'.$v->goods_id)}}" class="btn btn-danger">预览</a>
                </td>
            </tr>
        @endforeach
    @endif
    <tr>
        <td colspan="6">
            {{ $data->links() }}
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>

<script>
    //ajax分页
    //$('.pagination a').click(function(){

    $(document).on('click','.pagination a',function(){

        var url = $(this).attr('href');

        $.get(url,function(res){

            $('tbody').html(res);

        });

        return false;

    });


    function ajaxdel(id){
//        alert(id);
        if(!id){
            return;
        }
        $.get('goods/del/'+id,function(res){
            if(res.code=='00000'){
                alert(res);
                location.reload();
            }
        },'json');

    }
</script>
