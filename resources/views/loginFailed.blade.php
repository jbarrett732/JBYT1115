<!DOCTYPE html>
<html>
    <head>
        <title>Login Failed</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{ URL::asset('css/login.css') }}" />
    </head>
    <body>
        <div class="container">
            <div class="content" id="content_login">
                <div class="login_title">Please Login</div>
                <div id="error_div">
                    <p class="error">
                        <img src="images/error.png" alt="error icon" stlye='height:22px;width:22px;float:left;'>
                        Authentication Failed 
                    </p>
                    <script>
                        document.getElementById("content_login").style.height='232px'; 
                        setTimeout(function () {
                            document.getElementById("error_div").style.display='none'; 
                            document.getElementById("content_login").style.height='200px'; 
                        }, 5000);
                    </script>
                </div>
                <div>
                <form action='/auth/login' method="post">
                    <input type="text"     name="username" class="login_input" placeholder="User Name"><br>
                    <input type="password" name="password" class="login_input" placeholder="Password"><br>
                    <input type="submit"   class="login_submit" value="Login">
                    <?php echo Form::token(); ?>
                </form>
            </div>
        </div>
    </body>
</html>
