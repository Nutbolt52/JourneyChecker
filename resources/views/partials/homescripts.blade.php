<script>
    $( "#line-status" ).load( "/api/update", function( response, status, xhr ) {
        if ( status == "error" ) {
            var msg = "Sorry but there was an error: ";
            $( "#TfLlineserror" ).html( msg + xhr.status + " " + xhr.statusText );
        }
    });
    setInterval('refresh_lines()', 32000);
    function refresh_lines() {
        $( "#line-status" ).load( "/api/update", function( response, status, xhr ) {
            if ( status == "error" ) {
                var msg = "Sorry but there was an error: ";
                $( "#TfLlineserror" ).html( msg + xhr.status + " " + xhr.statusText );
            }
        });
    }
</script>
