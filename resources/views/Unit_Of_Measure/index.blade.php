
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<a href="/unit_of_measure/create">[ Create Unit of Measure ]</a> - {!! count($units_of_measure) !!}<br />
<table border="1">
    @foreach($units_of_measure as $unit_of_measure)
        <tr>
            <td>{{ $unit_of_measure->name }}</td>
            <td>{{ $unit_of_measure->slug }}</td>
            <td>{{ $unit_of_measure->description }}</td>
            <td>
                {!! Form::open(array('url' => 'unit_of_measure/' . $unit_of_measure->id, 'class' => 'pull-right')) !!}
                {!! Form::hidden('_method', 'DELETE') !!}
                {!! Form::submit('[ DELETE ]', array('class' => 'btn btn-warning')) !!}
                {!! Form::close() !!}

                {!! Form::open(array('url' => 'unit_of_measure/' . $unit_of_measure->id . '/edit', 'class' => 'pull-right')) !!}
                {!! Form::hidden('_method', 'GET') !!}
                {!! Form::submit('[ EDIT ]', array('class' => 'btn btn-warning')) !!}
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
</table>