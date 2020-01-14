<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>品牌添加</title>
    <link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">
    <script src="/static/admin/js/jquery.js"></script>
    <script src="/static/admin/js/bootstrap.min.js"></script>
</head>
<body>
<div align="center">
    <h3>品牌添加</h3>
    <a href="{{url('brand')}}">品牌列表</a>
</div>
<hr>

{{--@if ($errors->any())--}}
    {{--<div class="alert alert-danger">--}}
        {{--<ul>--}}
            {{--@foreach ($errors->all() as $error)--}}
                {{--<li>{{ $error }}</li>--}}
            {{--@endforeach--}}
        {{--</ul>--}}
    {{--</div>--}}
{{--@endif--}}

<form class="form-horizontal" action="{{url('brand/store')}}" role="form" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">品牌名称</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="brand_name" id="firstname"
                   placeholder="请输入品牌名称">
            <b style="color:red">{{$errors->first('brand_name')}}</b>
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">品牌网址</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="brand_url" id="lastname"
                   placeholder="请输入品牌网址">
            <b style="color:blue">{{$errors->first('brand_url')}}</b>
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">品牌LOGO</label>
        <div class="col-sm-10">
            <input type="file" class="form-control" name="brand_logo" id="lastname" placeholder="请输入品牌LOGO">
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">品牌简介</label>
        <div class="col-sm-10">
            <textarea class="form-control" name="brand_desc" id="lastname" placeholder="请输入品牌简介"></textarea>
        </div>
    </div>
    <div class="col-sm-10">
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="button" class="btn btn-default">添加</button>
            </div>
        </div>
    </div>
</form>
</body>

<script>
    //js验证
    //品牌名称
    $('input[name="brand_name"]').blur(function(){

        $(this).next().text('');

        var brand_name = $(this).val();

        checkname(brand_name);
    });

    //品牌网址
    $('input[name="brand_url"]').blur(function(){

        $(this).next().text('');

        var brand_url = $(this).val();

        checkUrl(brand_url)

    });


    function checkUrl(brand_url)
    {
        var reg = /^http:\/\/*/;

        if(!reg.test(brand_url)){

            $('input[name="brand_url"]').next().text('品牌网址需以http开头');

            return false;

        }

        return true;

    }

    function checkname(){
        var flag = true;

        var reg = /^[\u4e00-\u9fa5\w.\-]$/;

        if(!reg.test(brand_name)){

            $('input[name="brand_name"]').next().text('品牌名称需是中文、字母、数字、下划线、点和-组成且长度为1-16位');

            return false;

        }

        //ajax验证唯一性
//        $.get('/brand/checkOnly',{brand_nmae:brand_name},function(res){
//
//            if(res != 0){
//
//                $('input[name="brand_name"]').next().text('品牌名称已存在');
//
//            }
//
//        });

        $.ajax({
            method: "get",
            url: "/brand/checkOnly",
            data: {brand_name: brand_name},
            async:flase,
        }).done(function(res){
            if(res!=0){
                $('input[name="brand_name"]').next().text('品牌名称已存在');
                flag = false;
            }

        });
        return flag;

    }


    //提交验证
    $('[type = "button"]').click(function(){

        //名称
        $('input[name="brand_name"]').blur(function(){

            $('input[name="brand_name"]').next().text('');

            var nameflag = checkname(brand_nmae);

        });

        //网址
        $('input[name="brand_url"]').next().text('');

        var brand_url = $('input[name="brand_url"]').val();

        var urlflag = checkUrl(brand_url);

//        alert(nameflag);
//        alert(urlflag);

        if(nameflag == true && urlflag == true)
        {
            $('form').submit();

        }

    });

</script>

</html>