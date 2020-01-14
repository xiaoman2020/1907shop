<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>品牌编辑</title>
    <link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">
    <script src="/static/admin/js/jquery.js"></script>
    <script src="/static/admin/js/bootstrap.min.js"></script>
</head>
<body>
<div align="center">
    <h3>品牌编辑</h3>
    <a href="{{url('brand')}}">品牌列表</a>
    <a href="{{url('brand/create')}}">品牌添加</a>
</div>
<hr>
<form class="form-horizontal" action="{{url('/brand/update/'.$data->brand_id)}}" role="form" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">品牌名称</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="brand_name" id="firstname"
                   placeholder="请输入品牌名称" value="{{$data->brand_name}}">
            <b style="color: red;">{{$errors->first('brand_name')}}</b>
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">品牌网址</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="brand_url" id="lastname"
                   placeholder="请输入品牌网址" value="{{$data->brand_url}}">
            <b style="color: red;">{{$errors->first('brand_url')}}</b>
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">品牌LOGO</label>
        <div class="col-sm-10">
            <img src="{{env('UPLOAD_URL')}}{{$data->brand_logo}}" style="width:100px; height:100px;">
            <input type="file" class="form-control" name="brand_logo" id="lastname" value="{{$data->brand_logo}}">
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">品牌简介</label>
        <div class="col-sm-10">
            <textarea class="form-control" name="brand_desc" id="lastname" placeholder="请输入品牌简介">{{$data->brand_desc}}</textarea>
        </div>
    </div>
    <div class="col-sm-10">
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">编辑</button>
            </div>
        </div>
    </div>
</form>
</body>
</html>
