@if($data)
    @foreach($data as $v)
        <tr>
            <td>{{$v->id}}</td>
            <td>{{$v->name}}</td>
            <td>{{$v->price}}</td>
            <td>
                <img src="{{env('UPLOAD_URL')}}{{$v->photo}}" width="100px" style="width:100px; height:100px;">
            </td>
            <td>
                <a href="{{url('/goods/del/'.$v->id)}}" class="btn btn-danger">删除</a>
            </td>
        </tr>
    @endforeach
@endif
<tr>
    <td colspan="6">
        {{ $data->links() }}
    </td>
</tr>