<!DOCTYPE html>
<html>
    <head>
        <title>User Home</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                background-color: #434343;
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
                color: #2ACAFF;
                text-align: center;
                display: inline-block; 
            }

            .user_title {
                font-size: 36px;
                margin: 10px;
            }

            .user_info {
                font-size: 18px;
                margin: 10px;
            }

            form {
                text-align: center;
            }

            [name=domain_list] {
                border-radius:    25px;
                border: 3px solid #2ACAFF;
                height: 200px;
                width: 410px;
                text-align: left;
                padding: 15px;
	    }

            [type=submit] {
                background-color: #939393;
                border-radius:    15px;
                border: 3px solid #2ACAFF;
                height: 200px;
	        height: 40px;
                width: 445px;
                font-size: 18px;
	    }

        </style>
    </head>
    <body>
        <div>
            <div class="user_title">Welcome To The User Home Page!</div>
            <a href="/">Log Out</a>
        </div>
        <div>
	    <div class="user_info">Enter Domain Names Below to Determine Their Alexa Rank</div>
          
            <div>
                <?php echo Form::open(array('url'=>'generateTable')); echo Form::textarea('domain_list'); ?>
            </div>
            <div>
                <?php echo Form::submit('Create Table'); echo Form::close(); ?>
            </div>
        </div>
    </body>
</html>

