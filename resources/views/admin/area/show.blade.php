<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h3>详情页</h3>
@foreach($data as $v)
    售楼内容: {{$v->dgy}}<br>
@endforeach
访问量:{{$num}}
</body>
</html>