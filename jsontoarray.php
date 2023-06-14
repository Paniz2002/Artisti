<script>
    var users = new Array();
    function loadQuestions() {
        $.getJSON('gfguserdetails.json', function (data) {
            users = data.users;
        })
        .error(function() {
            console.log('error: JSON not loaded'); 
        })
        .done(function() {
            console.log( "JSON loaded!" );
            printQuestion(allQuestions[0]); 
        });
    }
</script>