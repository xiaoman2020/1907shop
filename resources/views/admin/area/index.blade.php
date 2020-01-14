<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>售楼信息管理</title>
    <link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">
    <script src="/static/admin/js/jquery.js"></script>
    <script src="/static/admin/js/bootstrap.min.js"></script>

</head>
<body>
<div align="center">
    <h3>售楼信息列表</h3>

    <a href="{{url('/area/create/')}}">添加</a>
    <hr/>

</div>
<hr>
<form>
    <input type="text" name="name" value="{{$query['name']??''}}" placeholder="请输入小区名称">
    <input type="submit" value="搜索">
    {{--当前页面浏览量<b style="color:red">{{$num}}</b>次--}}
</form>

<table class="table table-striped">
    <thead>
    <tr>
        <th>信息id</th>
        <th>小区名称</th>
        <th>地理位置</th>
        <th>面积</th>
        <th>导购员</th>
        <td>联系电话</td>
        <td>价格</td>
        <td>楼盘主图</td>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    @if($data)
        @foreach($data as $v)
            <tr>
                <td>{{$v->id}}</td>
                <td>{{$v->name}}</td>
                <td>{{$v->wz}}</td>
                <td>{{$v->mj}}</td>
                <td>{{$v->dgy}}</td>
                <td>{{$v->tel}}</td>
                <td>{{$v->price}}</td>
                <td>
                    <img src="{{env('UPLOAD_URL')}}{{$v->img}}" width="100px" style="width:100px; height:100px;">
                </td>
                <td>
                    {{--<a href="{{url('/area/del/'.$v->id)}}" class="btn btn-danger">删除</a>--}}
                    <a onclick="ajaxdel({{$v->id}})" href="javascript:void(0)">删除</a>
                    <a href="{{url('area/show/'.$v->id)}}">详情页</a></td>

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

    function ajaxdel(id) {
//        alert(id);
        if (!id) {
            return;
        }
        $.get('area/del/' + id, function (res) {
            if (res.code == '00000') {
                alert(res);
                location.reload();
            }
        }, 'json');
    }

    $(document).on('click','.pagination a',function(){

        //alert(111);

        var url = $(this).attr('href');

        $.get(url,function(res){

            $('tbody').html(res);

        });

        return false;

    });
</script>


