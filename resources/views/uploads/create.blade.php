@extends('master')


@section('container')

  <div class="col-md-12 col-lg-6 col-lg-offset-3">

    <div class="email-form">

      <div class="text-center logo">
        <img src="http://placehold.it/200x200.png">
      </div>

      <p class="text-center">
        Upload an image below
      </p>

      <div class="our-form">
        @if (count($errors) > 0)
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
        @endif

            {{ Form::open(['url' => 'uploads/store', 'files' => true]) }}

          <div class="form-group">
            {{Form::label('file','File:')}}
            {{Form::file('file')}}
          </div>

          <div class="form-group">
            {{Form::label('caption','Caption:')}}
            {{Form::textarea('caption',null,['class'=>'form-control'])}}
          </div>

          <div class="form-group">
            {{Form::label('email','Email:')}}
            {{Form::text('email',null,['class'=>'form-control'])}}
          </div>

          <div class="form-group text-right">
            {{Form::submit('Send Photo', ['class'=>'btn pink'])}}
          </div>

            {{ Form::close() }}

      </div>

    </div>

  </div>

@stop
