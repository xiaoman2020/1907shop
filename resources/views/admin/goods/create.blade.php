<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>商品添加</title>
    <link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">
    <script src="/static/admin/js/jquery.js"></script>
    <script src="/static/admin/js/bootstrap.min.js"></script>
</head>
<body>
<div align="center">
    <h3>商品添加</h3>
    <a href="{{url('goods')}}">商品列表</a>
</div>
<hr>


<form class="form-horizontal" action="{{url('goods/store')}}" role="form" method="post" enctype="multipart/form-data">
    @csrf

<ul id="myTab" class="nav nav-tabs">
    <li class="active">
        <a href="#home" data-toggle="tab">
           基础信息
        </a>
    </li>
    <li><a href="#ios" data-toggle="tab">商品相册</a></li>
    <li><a href="#desc" data-toggle="tab">商品详情</a></li>

</ul>
<div id="myTabContent" class="tab-content">
    <div class="tab-pane fade in active" id="home">
        <p>
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">商品名称</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="goods_name" id="firstname"
                       placeholder="请输入商品名称">
                <b style="color:red">{{$errors->first('goods_name')}}</b>
            </div>
        </div>

        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">商品货号</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="goods_no" id="lastname"
                       placeholder="请输入商品货号">
                <b style="color:blue">{{$errors->first('goods_no')}}</b>
            </div>
        </div>

        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">商品价格</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="goods_price" id="lastname"
                       placeholder="请输入商品价格">
                <b style="color:blue">{{$errors->first('goods_price')}}</b>
            </div>
        </div>

        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">分类id</label>
            <div class="col-sm-10">
                <select class="form-control" name="cate_id" >
                    <option value="0">--请选择商品分类--</option>
                    @foreach($cate as $v)
                        <option value="{{$v->cate_id}}">{{str_repeat('|——',$v->level)}}{{$v->cate_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">品牌id</label>
            <div class="col-sm-10">
                <select class="form-control" name="brand_id" >
                    <option value="0">--请选择商品品牌--</option>
                    @foreach($brand as $v)
                        <option value="{{$v->brand_id}}">{{$v->brand_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">库存</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="goods_num" id="lastname"
                       placeholder="请输入商品库存">
                <b style="color:blue">{{$errors->first('goods_num')}}</b>
            </div>
        </div>

        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">赠送积分</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="goods_score" id="lastname"
                       placeholder="请输入赠送积分">
                <b style="color:blue">{{$errors->first('goods_score')}}</b>
            </div>
        </div>

        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">图片</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" name="goods_img" id="lastname" placeholder="请输入商品图片">
            </div>
        </div>




        </p>
    </div>


    <div class="tab-pane fade" id="ios">
        <p><div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">商品相册</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" multiple="multiple" name="goods_imgs[]" id="lastname" placeholder="请输入商品相册">
            </div>
        </div></p>
    </div>


    <div class="tab-pane fade" id="desc">
        <p><div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">商品详情</label>
            <div class="col-sm-10">
                <textarea class="form-control" name="goods_desc" id="lastname" placeholder="请输入商品详情"></textarea>
            </div>
        </div></p>
    </div>

</div>












    <div class="col-sm-10">
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button class="btn btn-default">添加</button>
            </div>
        </div>
    </div>
</form>
</body>

{{--<script>--}}
    {{--//js验证--}}
    {{--//品牌名称--}}
    {{--$('input[name="brand_name"]').blur(function(){--}}

        {{--$(this).next().text('');--}}

        {{--var brand_name = $(this).val();--}}

        {{--checkname(brand_name);--}}
    {{--});--}}

    {{--//品牌网址--}}
    {{--$('input[name="brand_url"]').blur(function(){--}}

        {{--$(this).next().text('');--}}

        {{--var brand_url = $(this).val();--}}

        {{--checkUrl(brand_url)--}}

    {{--});--}}


    {{--function checkUrl(brand_url)--}}
    {{--{--}}
        {{--var reg = /^http:\/\/*/;--}}

        {{--if(!reg.test(brand_url)){--}}

            {{--$('input[name="brand_url"]').next().text('品牌网址需以http开头');--}}

            {{--return false;--}}

        {{--}--}}

        {{--return true;--}}

    {{--}--}}

    {{--function checkname(){--}}
        {{--var flag = true;--}}

        {{--var reg = /^[\u4e00-\u9fa5\w.\-]$/;--}}

        {{--if(!reg.test(brand_name)){--}}

            {{--$('input[name="brand_name"]').next().text('品牌名称需是中文、字母、数字、下划线、点和-组成且长度为1-16位');--}}

            {{--return false;--}}

        {{--}--}}

        {{--//ajax验证唯一性--}}
{{--//        $.get('/brand/checkOnly',{brand_nmae:brand_name},function(res){--}}
{{--//--}}
{{--//            if(res != 0){--}}
{{--//--}}
{{--//                $('input[name="brand_name"]').next().text('品牌名称已存在');--}}
{{--//--}}
{{--//            }--}}
{{--//--}}
{{--//        });--}}

        {{--$.ajax({--}}
            {{--method: "get",--}}
            {{--url: "/brand/checkOnly",--}}
            {{--data: {brand_name: brand_name},--}}
            {{--async:flase,--}}
        {{--}).done(function(res){--}}
            {{--if(res!=0){--}}
                {{--$('input[name="brand_name"]').next().text('品牌名称已存在');--}}
                {{--flag = false;--}}
            {{--}--}}

        {{--});--}}
        {{--return flag;--}}

    {{--}--}}


    {{--//提交验证--}}
    {{--$('[type = "button"]').click(function(){--}}

        {{--//名称--}}
        {{--$('input[name="brand_name"]').blur(function(){--}}

            {{--$('input[name="brand_name"]').next().text('');--}}

            {{--var nameflag = checkname(brand_nmae);--}}

        {{--});--}}

        {{--//网址--}}
        {{--$('input[name="brand_url"]').next().text('');--}}

        {{--var brand_url = $('input[name="brand_url"]').val();--}}

        {{--var urlflag = checkUrl(brand_url);--}}

{{--//        alert(nameflag);--}}
{{--//        alert(urlflag);--}}

        {{--if(nameflag == true && urlflag == true)--}}
        {{--{--}}
            {{--$('form').submit();--}}

        {{--}--}}

    {{--});--}}

{{--</script>--}}

</html>