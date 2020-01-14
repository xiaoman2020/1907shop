<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>品牌管理</title>
    <link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">
    <script src="/static/admin/js/jquery.js"></script>
    <script src="/static/admin/js/bootstrap.min.js"></script>
</head>
<body>
<div align="center">
    <h3>品牌列表</h3>
    <h3>欢迎【{{session('admin')->username}}】登录,<a href="{{url('/logout')}}">退出</a></h3>
    <a href="{{url('/brand/create/')}}">添加</a>
    <hr/>

</div>
<hr>
<form>
    <input type="text" name="brand_name" value="{{$query['brand_name']??''}}" placeholder="输入品牌名称">
    <input type="text" name="brand_url" value="{{$query['brand_url']??''}}" placeholder="输入品牌网址">
    <input type="submit" value="搜索">
</form>
<table class="table table-striped">
    <thead>
    <tr>
        <th>品牌id</th>
        <th>品牌名称</th>
        <th>品牌网址</th>
        <th>品牌LOGO</th>
        <th>品牌描述</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
         @if($data)
             @foreach($data as $v)
                <tr>
                    <td>{{$v->brand_id}}</td>
                    <td>{{$v->brand_name}}</td>
                    <td>{{$v->brand_url}}</td>
                    <td>
                        <img src="{{env('UPLOAD_URL')}}{{$v->brand_logo}}" width="100px" style="width:100px; height:100px;">
                    </td>
                    <td>{{$v->brand_desc}}</td>
                    <td>
                        <a href="{{url('/brand/edit/'.$v->brand_id)}}" class="btn btn-info">编辑</a>
                        <a href="{{url('/brand/del/'.$v->brand_id)}}" class="btn btn-danger">删除</a>
                    </td>
                </tr>
             @endforeach
         @endif
         <tr>
             <td colspan="6">
                 {{ $data->appends($query)->links() }}
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


</script>
