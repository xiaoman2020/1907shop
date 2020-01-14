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