@extends('layout.app')

@section('content')
<div class="jumbotron">

    @unless($preferences_set)
    <div>
        <div class="alert alert-info fade in">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <p><strong>Welcome to Journey Checker!</strong> Set your preferences to limit which lines you see below</p>
            <h5>This website uses cookies to remember your preferences. By setting your preferences you are agreeing to allow this site to store cookies on your computer</h5>
            <p><a class="btn btn-warning btn-raised" href="{{ url('preferences') }}">Set Preferences</a>
                <button class="btn btn-primary btn-raised" data-toggle="modal" data-target="#info-dialog">More Information</button> </p>
        </div>
        <div id="info-dialog" class="modal fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h2 class="modal-title">More Information</h2>
                    </div>
                    <div class="modal-body">
                        <p>Journey Checker allows you to select what London Underground lines you use on your commute to and from work.</p>
                        <p>Once this is set, only these lines will be displayed on the homepage, allowing you to quickly and easily view any delays on lines you use.</p>
                        <p>So that you can see any delays as easily as possible, underground lines currently experiencing delays are shown in red. Any information provided by Transport for London (TfL) is included, and is updated automatically when TfL release new information about the delay. </p>
                        <p>If you leave the page open it will automatically refresh the status of each line every 32 seconds.</p>
                        <p>Journey Checker looks good on any screen size, making it ideal for viewing on your mobile as you travel. </p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" data-dismiss="modal">Dismiss</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endunless

    <p>
    <div id="TfLlines">

        <!--Javascript to load in the actual lines and their statuses. Probably use Vue for this? But for SEO want it to load first, then update...? -->

            @include('partials.linestatus')

        <div id="ajaxloader" style="text-align:center; display:none"><img src="img/ajax-loader.gif" /></div>


    </div>

    <div id="TfLlineserror">

    </div>
    </p>
</div><!-- /.container -->

<div class="alert alert-warning">
    <strong>Note: </strong>If there is a disruption the affected lines will turn red and details of the disruption will be provided</p>
</div>

@endsection