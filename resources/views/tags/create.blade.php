{{ HTML::ul($errors->all()) }}

{!! Form::open(array('url' => 'tags')) !!}

<div class="form-group">
{!! Form::label('name', 'Name') !!}
{!! Form::text('name', '', array('class' => 'form-control')) !!}
</div>

<div class="form-group">
{!! Form::label('slug', 'Slug') !!}
{!! Form::text('slug', '', array('class' => 'form-control')) !!}
</div>

<div class="form-group">
{!! Form::label('description', 'Description') !!}
{!! Form::textarea('description', '', array('class' => 'form-control')) !!}
</div>

{!! Form::submit('Submit', array('class' => 'btn btn-primary')) !!}

{!! Form::close() !!}