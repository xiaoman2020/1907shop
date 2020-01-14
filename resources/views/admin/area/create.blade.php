<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>售楼信息添加</title>
    <link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">
    <script src="/static/admin/js/jquery.js"></script>
    <script src="/static/admin/js/bootstrap.min.js"></script>
</head>
<body>
<div align="center">
    <h3>售楼信息添加</h3>
    <a href="{{url('area')}}">售楼信息列表</a>
</div>
<hr>



<form class="form-horizontal" action="{{url('area/store')}}" role="form" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">小区名称</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="name" id="firstname"
                   placeholder="请输入小区名名称">
            <b style="color:red">{{$errors->first('name')}}</b>
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">地理位置</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="wz" id="lastname"
                   placeholder="请输入地理位置">
            <b style="color:blue">{{$errors->first('wz')}}</b>
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">面积</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="mj" id="lastname"
                   placeholder="请输入面积">
            <b style="color:blue">{{$errors->first('mj')}}</b>
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">导购员</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="dgy" id="lastname"
                   placeholder="请输入导购员">
            <b style="color:blue">{{$errors->first('dgy')}}</b>
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">联系电话</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="tel" id="lastname"
                   placeholder="请输入联系电话">
            <b style="color:blue">{{$errors->first('tel')}}</b>
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">价格</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="price" id="lastname"
                   placeholder="请输入价格">
            <b style="color:blue">{{$errors->first('price')}}</b>
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">楼盘主图</label>
        <div class="col-sm-10">
            <input type="file" class="form-control" name="img" id="lastname" placeholder="请输入楼盘主图">
        </div>
    </div>
    {{--<div class="form-group">--}}
        {{--<label for="lastname" class="col-sm-2 control-label">楼盘相册</label>--}}
        {{--<div class="col-sm-10">--}}
            {{--<input type="file" class="form-control" name="imgs[]" id="lastname" placeholder="请输入楼盘相册">--}}
        {{--</div>--}}
    {{--</div>--}}
    <div class="col-sm-10">
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">添加</button>
            </div>
        </div>
    </div>
</form>
</body>

</html>