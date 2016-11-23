{{-- NOTE: A line can have multiple Statuses --}}
{{-- 10 is fine; 6 is severe delays; 5 is part closure; 3 is part suspended --}}

@foreach($tfldata as $line)
    @if($line['statusSeverity'] < 10)
        <div class="panel panel-danger" id="{{ $line['id'] }}">
    @else
        <div class="panel panel-success" id="{{ $line['id'] }}">
    @endif
            <div class="panel-heading"><h3 class="panel-title">
        {{ $line['name'] }} </h3></div>
        <div class="panel-body">
            <strong>{{ $line['statusSeverityDescription'] }}</strong>
            @if(isset($line['reason']))
                <br><strong>Details: </strong> {{ $line['reason'] }}
            @endif
        </div>
        </div>
@endforeach
