<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">
    <script src="/static/admin/js/jquery.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{$goods->goods_name}}</title>
</head>
<body>
<div align="center">
    <h3>{{$goods->goods_name}}</h3>

</div>
<hr>
    <p>价格：{{$goods->goods_price}}</p>

    <p>积分：{{$goods->goods_score}}</p>

    <p>{{$goods->goods_desc}}</p>

    <button>购买</button>

    <h3>详情页</h3>
        {{--@foreach($goods as $v)--}}
            {{--详情内容: {{$v->goods_desc}}<br>--}}
        {{--@endforeach--}}
    访问量:{{$num}}

</body>

<script>
    $('button').click(function(){

        var goods_id = {{$goods -> goods_id}}

        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

        $.post('/goods/addcart',{goods_id:goods_id},function(res){

            if(res.code == '00001'){

               //alert(res.msg);

                location.href='/login';

            }

            if(res.code == '00002'){

                alert(res.msg);

            }

            if(res.code == '00000'){

                alert(res.msg);

                location.href='/goods';

            }

        },'json');

    });
</script>
</html>