<!DOCTYPE html>
<html>
    <head>
        <title>Domain Table</title>

        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link rel="stylesheet" href="{{ URL::asset('css/johns.css') }}" />
    </head>
    <body>
        <div class="topBorder">
            <div class="user_title">Here Is Your Table!</div>
        </div>
            <div>
                <?php
                    echo Form::open(array('url'=>'/auth/logout'));
                    echo Form::submit('Logout');
                    echo Form::close();
                ?>
            </div>
        <div>
            <table id="rankTable" align="center">
                <tr><td class="col1"><b>Rank</b></td><td class="col2"><b>Domain</b></td></tr>
            </table>
            <script>
                $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
                $.ajax({
                    url: "/generateTable/getUserTable",
                    type:"GET",
                    data: {'_token': $('meta[name=csrf-token]').attr('content')},
                    success:function(data1){
                        if(data1 !== null) {
                            for(var i=0; i<data1.length; i++) {
                                if(data1[i].length === 2)
                                    $("#rankTable").append("<tr><td>"+data1[i][0]+"</td><td>"+data1[i][1]+"</td></tr>");
                            } 
                        }
                    },
                    error:function(){ 
                        alert("error!!!!");
                    }
                }); //end of ajax
            </script>
        </div>
    </body>
</html>

