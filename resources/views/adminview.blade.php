<!DOCTYPE html>
<html>
    <head>
        <title>Admin Home</title>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link rel="stylesheet" href="{{ URL::asset('css/johns.css') }}" />
    </head>
    <body>
        <div>
            <div class="user_title">Welcome To The Admin Home Page!</div>
            <div>
                <?php 
                    echo Form::open(array('url'=>'/auth/logout')); 
                    echo Form::submit('Logout'); 
                    echo Form::close();
                    echo Form::open(array('url'=>'/addview')); 
                    echo Form::submit('Add'); 
                    echo Form::close();
                ?>
            </div>
        </div>
        <div>
	    <div class="user_info">Enter Domain Names Below to Determine Their Alexa Rank</div>
          
            <div>
                <?php echo Form::open(array('url'=>'/generateTable/makeUserTable')); echo Form::textarea('domain_list'); ?>
            </div>
            <div>
                <?php echo Form::submit('Create Table'); echo Form::close(); ?>
            </div>
        </div>

        <div class="user_title">Top Alexa Rankings</div>
        <div>
            <table id="rankTable" align="center">
                <tr><td class="col1"><b>Rank</b></td><td class="col2"><b>Domain</b></td></tr>
            </table>
            <script>
                $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
                $.ajax({
                    url: "/generateTable/getTopTable",
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

