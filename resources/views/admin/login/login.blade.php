<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>登录</title>
    <link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">
</head>

<body>
    <center><h1>登录</h1></center>
    <b style="color:blueviolet">{{session('msg')}}</b>


<form class="form-horizontal" action="{{url('/dologin')}}" role="form" method="post">

    <div class="form-group">
        @csrf
        <label for="firstname" class="col-sm-2 control-label">账号</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="username" id="firstname"
                   placeholder="请输入账号">
            <b style="color:red">{{$errors->first('username')}}</b>
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">密码</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" name="pwd" id="lastname"
                   placeholder="请输入密码">
            <b style="color:blue">{{$errors->first('pwd')}}</b>
        </div>
    </div>
    <div class="col-sm-10">
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">登录</button>
            </div>
        </div>
    </div>
</form>
</body>
</html>
