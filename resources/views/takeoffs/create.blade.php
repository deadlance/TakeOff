@extends('master.index')

@section('header')
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

                {!! Form::open() !!}
                {!! Form::token() !!}

                <div class="form-group">
                    {!! Form::label('name', 'Name') !!}
                    {!! Form::text('name', '', ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('description', 'Description') !!}
                    {!! Form::textarea('description', '', ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('magento_product_id', 'Magento Product ID (eventually I want this to be a drop down list)') !!}
                    {!! Form::text('magento_product_id', '', ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('magento_option_id', 'Magento Option ID (eventually I want this to be a drop down list)') !!}
                    {!! Form::text('magento_option_id', '', ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Create', ['class' => 'btn btn-default']) !!}
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('footer')
@endsection