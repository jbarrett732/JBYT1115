<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{ URL::asset('css/login.css') }}" />
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="login_title">Please Login</div>
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
