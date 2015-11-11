<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Illuminate\Routing\Controller;

class JohnsAuthController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @return Response
     */
    public function authenticate()
    {
        $username = isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '';
        $password = isset($_POST['password']) ? htmlspecialchars($_POST['password']) : '';

        if (Auth::attempt(['name' => $username, 'password' => $password])) {
            // Authentication passed...
            $db_group = \DB::table('groups')->where('users',$username)->first();
            if('regular' === $db_group->name)
                // User belongs to regular group
                return redirect()->intended('userview');
            else if('admin' === $db_group->name)
                // User belongs to admin group
                return redirect()->intended('adminview');
            else 
                //must belong to a known group, so failed...
                return redirect()->intended('loginFailed');
        }
        else {
            // Authentication failed...
            return redirect()->intended('loginFailed');
        }
    }

    public function logout() {
        Auth::logout();
        return redirect()->intended('/');
    }
}
