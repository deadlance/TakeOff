
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<a href="/tags/create">[ Create Tag ]</a> - {!! count($tags) !!}<br />
<table border="1">
    @foreach($tags as $tag)
        <tr>
            <td>{{ $tag->name }}</td>
            <td>{{ $tag->slug }}</td>
            <td>{{ $tag->description }}</td>
            <td>
                {!! Form::open(array('url' => 'tags/' . $tag->id, 'class' => 'pull-right')) !!}
                {!! Form::hidden('_method', 'DELETE') !!}
                {!! Form::submit('[ DELETE ]', array('class' => 'btn btn-warning')) !!}
                {!! Form::close() !!}

                {!! Form::open(array('url' => 'tags/' . $tag->id . '/edit', 'class' => 'pull-right')) !!}
                {!! Form::hidden('_method', 'GET') !!}
                {!! Form::submit('[ EDIT ]', array('class' => 'btn btn-warning')) !!}
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
</table>