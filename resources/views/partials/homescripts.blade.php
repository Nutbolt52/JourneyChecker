<script>
    $(window).load(function (){
        $("#ajaxloader").fadeIn("slow");
    });
    $( "#TfLlines" ).load( "/ajax/tfllines.php", function( response, status, xhr ) {
        if ( status == "error" ) {
            var msg = "Sorry but there was an error: ";
            $( "#TfLlineserror" ).html( msg + xhr.status + " " + xhr.statusText );
        }
    });
    setInterval('refresh_lines()', 32000);
    function refresh_lines() {
        $( "#TfLlines" ).load( "/ajax/tfllines.php", function( response, status, xhr ) {
            if ( status == "error" ) {
                var msg = "Sorry but there was an error: ";
                $( "#TfLlineserror" ).html( msg + xhr.status + " " + xhr.statusText );
            }
        });
    }
</script>