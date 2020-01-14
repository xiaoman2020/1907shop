@if($data)
    @foreach($data as $v)
        <tr>
            <td>{{$v->id}}</td>
            <td>{{$v->name}}</td>
            <td>{{$v->price}}</td>
            <td><img src="{{env('UPLOAD_URL')}}{{$v->photo}}" width="100px"></td>
            <td>
                <a onclick="ajaxdel({{$v->id}})" href="javascript:void(0)">删除</a>
                {{--<a href="{{url('/goods/del/'.$v->id)}}">删除</a>--}}
            </td>
        </tr>
        @endforeach
        @endif
        <tr>
            <td colspan="6">
                {{ $data->links() }}
            </td>
        </tr>
