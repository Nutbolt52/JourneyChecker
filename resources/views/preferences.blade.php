@extends('layout.app')

@section('content')

    <div class="container theme-showcase" role="main">

        <div class="page-header">
            <h1>Set Your Preferences</h1>
        </div>
        <div class="well">

            <div class="container">
                <form class="form-preferences" role="form" method="post" action="{{ url('preferences') }}">
                    {{ csrf_field() }}
                    @foreach($lines as $line => $line_value)
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="{{ $line }}" name="line_ids[]"> {{ $line_value }}
                        </label>
                    </div>
                    @endforeach

                    <button class="btn btn-primary btn-raised" type="submit" name="submit">Save</button>
                </form>
            </div> <!-- /container -->
        </div>

        <hr>

        <div class="well">
            <p>Select all the underground lines you wish to view on the front page</p>
            <p>If you wish to change your selection simply set your preferences again</p>
            <p>Preferences are saved on your computer for 30 days since your last visit to the site</p>
            <p>To delete cookies saved on your computer click this handy button <a class="btn-xs btn-danger btn-raised" href="{{ url('preferences/delete') }}">Delete Preferences</a> </p>
        </div>

@endsection