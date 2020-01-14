<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>分类管理</title>
    <link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">
    <script src="/static/admin/js/jquery.js"></script>
    <script src="/static/admin/js/bootstrap.min.js"></script>
</head>
<body>
<div align="center">
    <h3>分类列表</h3>
    <a href="{{url('/category/create/')}}">添加</a>
</div>
<hr>

<table class="table table-striped">
    <thead>
    <tr>
        <th>分类id</th>
        <th>分类名称</th>
        <th>是否显示</th>
        <th>是否导航栏显示</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    @if($data)
        @foreach($data as $v)
            <tr>
                <td>
                    {{--<a href="javascript:;" class="sign">+</a>--}}
                    {{$v->cate_id}}
                </td>

                <td>
                    @php echo str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;",$v->level); @endphp {{$v->cate_name}}
                </td>

                <td>
                    {{$v->cate_show == "1" ? '√' : '×'}}
                </td>

                <td>
                    {{$v->cate_nav_show =="1" ? '√' : '×'}}
                </td>

                <td>
                    <a href="{{url('/category/edit/'.$v->cate_id)}}" class="btn btn-info">编辑</a>
                    <a href="{{url('/category/del/'.$v->cate_id)}}" class="btn btn-danger">删除</a>
                </td>
            </tr>
        @endforeach
    @endif

    </tbody>
</table>
</body>
</html>

{{--<script>--}}
    {{--$(document).ready(function(){--}}

        {{--//顶级展示--}}
        {{--$("tr[parent_id]").hide();--}}

        {{--$("tr[parent_id=0]").show();--}}

        {{--//点击符号--}}
        {{--$(document).on('click','.sign',function(){--}}

            {{--var _this=$(this);--}}

            {{--var sign=_this.text();--}}

            {{--var cate_id=_this.parents('tr').attr('cate_id');--}}

            {{--if(sign=='+'){--}}

                {{--if($("tr[parent_id="+cate_id+"]").length>0){--}}

                    {{--$("tr[parent_id="+cate_id+"]").show();--}}

                    {{--_this.text('-');--}}
                {{--}--}}

            {{--}else{--}}

                {{--// $("tr[parent_id="+cate_id+"]").hide();--}}

                {{--trHide(cate_id);--}}

                {{--_this.text('+');--}}
            {{--}--}}
        {{--})--}}

        {{--function trHide(cate_id){--}}

            {{--var _tr=$("tr[parent_id="+cate_id+"]");--}}

            {{--_tr.each(function(index){--}}

                {{--$(this).hide();--}}

                {{--$(this).find("a[class='sign']").text('+');--}}

                {{--var c_id=$(this).attr('cate_id');--}}

                {{--trHide(c_id);--}}
            {{--})--}}
        {{--}--}}
        {{--})--}}
{{--</script>--}}


