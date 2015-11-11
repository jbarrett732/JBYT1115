<!DOCTYPE html>
<html>
    <head>
        <title>Admin</title>
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{ URL::asset('css/johns.css') }}" />
    </head>
    <body>
        <div class="topBorder">
            <div class="user_title">Welcome Admin!</div>
            <div>
                <?php
                    echo Form::open(array('url'=>'/auth/logout'));
                    echo Form::submit('Logout');
                    echo Form::close();
                ?>
            </div>
        </div>
        <div>
            <div class="user_info">Enter A Rank And Domain To Add To The List</div>
            <div>
                <?php 
                    echo Form::open(array('url'=>'/generateTable/adminAdd')); 
                    echo Form::number('rank'); 
                    echo Form::text('domain');
                ?>
            </div>
            <div>
                <?php echo Form::submit('Add To List'); echo Form::close(); ?>
            </div>
        </div>
    </body>
</html>

