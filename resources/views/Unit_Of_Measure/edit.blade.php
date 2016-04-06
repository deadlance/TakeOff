<h1>Edit {!! $unit_of_measure->name !!}</h1>

<!-- if there are creation errors, they will show here -->
{!! HTML::ul($errors->all()) !!}

{!! Form::model($unit_of_measure, array('route' => array('unit_of_measure.update', $unit_of_measure->id), 'method' => 'PUT')) !!}

<div class="form-group">
    {!! Form::label('name', 'Name') !!}
    {!! Form::text('name', null, array('class' => 'form-control')) !!}
</div>

<div class="form-group">
    {!! Form::label('slug', 'slug') !!}
    {!! Form::text('slug', null, array('class' => 'form-control')) !!}
</div>

<div class="form-group">
    {!! Form::label('description', 'description') !!}
    {!! Form::textarea('description', null, array('class' => 'form-control')) !!}
</div>

{!! Form::submit('Edit the tag!', array('class' => 'btn btn-primary')) !!}

{!! Form::close() !!}