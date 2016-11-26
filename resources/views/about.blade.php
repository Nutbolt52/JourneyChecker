@extends('layout.app')

@section('content')

    <div class="container theme-showcase" role="main">

        <div class="page-header">
            <h1>About Journey Checker</h1>
        </div>
        <div class="well">
            <p>The Journey Checker was developed by Nutbolt as a way of quickly and easily checking if there were any delays on his journey home from work</p>
            <p>It grew to allow more flexibility, allowing users to select their own tube lines etc...</p>
            <p>The London Underground data is provided by TfL and is updated every 30 seconds</p>
            <p>The Home page will update itself every 32 seconds to display the most recent data. The way it updates means you won't notice unless a lines status changes</p>
            <hr>
            <p>if you find an issue with the website, or would like to contact me for any other reason, please use the contact form below</p>
        </div>

    <div class="well">
        <h2>Contact Us</h2>

        @if(Session::has('message'))
            <div class="alert alert-info">
                {{Session::get('message')}}
            </div>
        @endif

        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>

        {!! Form::open(['url' => 'contact']) !!}

        <div class="form-group">
            {!! Form::label('name', 'Name', ['style' => 'color:black']) !!}
            {!! Form::text('name', null,
                array('required',
                      'class'=>'form-control',
                      'placeholder'=>'Your name')) !!}
        </div>

        <div class="form-group">
            {!! Form::label('email', 'E-mail Address', ['style' => 'color:black']) !!}
            {!! Form::text('email', null,
                array('required',
                      'class'=>'form-control',
                      'placeholder'=>'Your e-mail address')) !!}
        </div>

        <div class="form-group">
            {!! Form::label('message', 'Your Message', ['style' => 'color:black']) !!}
            {!! Form::textarea('message', null,
                array('required',
                      'class'=>'form-control',
                      'placeholder'=>'Your message')) !!}
        </div>

        {!! app('captcha')->display() !!}

        <div class="form-group">
            {!! Form::submit('Contact Us!',
              array('class'=>'btn btn-primary')) !!}
        </div>

        {!! Form::close() !!}


    </div>

@endsection