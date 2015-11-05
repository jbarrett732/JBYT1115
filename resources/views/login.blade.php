<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>

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
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                background-color: #007BA4;
		border-radius:    25px;
    		border: 3px solid #2ACAFF;
                height: 200px;
                width: 300px;
                text-align: center;
                display: inline-block;
            }

            .login_title {
                font-size: 36px;
		margin: 10px;
            }

            .login_input {
                width: 75%;
                height: 18px;
		margin: 10px;
		border-radius: 5px;
    		border: 2px solid #000000;
            }

            .login_submit {
		float: right;
                height: 26px;
		margin-right: 12%;
		margin-top: 10px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="login_title">Please Login</div>
		<form>
		    <input type="text"     name="username" class="login_input" placeholder="User Name"><br>
		    <input type="password" name="password" class="login_input" placeholder="Password"><br>
		    <input type="submit"   class="login_submit" value="Login">
		</form>
            </div>
        </div>
    </body>
</html>
