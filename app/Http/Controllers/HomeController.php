<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Auth::user()->status == 1){
            \Auth::logout();
            return redirect('/login');
        }
        return view('home');
    }

    public function activeuser(Request $request){
        if(\Auth::user()->status == 0){
            if(isset($_POST) && isset($_POST['user_id'])){
                $user = \App\User::find((int)$_POST['user_id']);
                $user->status = 1;
                if($user->save()){
                    return \Response::json(array('code' => '200', 'message' => 'success'));
                }
            }
        }
        return \Response::json(array('code' => '404', 'message' => 'unsuccess'));
    }

    public function inactiveuser(Request $request){
        if(\Auth::user()->status == 0){
            if(isset($_POST) && isset($_POST['user_id'])){
                $user = \App\User::find((int)$_POST['user_id']);
                $user->status = 0;
                if($user->save()){
                    return \Response::json(array('code' => '200', 'message' => 'success'));
                }
            }
        }
        return \Response::json(array('code' => '404', 'message' => 'unsuccess'));
    }

    public function add3time(Request $request){
        if(\Auth::user()->status == 0){
            if(isset($_POST) && isset($_POST['user_id'])){
                $user = \App\User::find((int)$_POST['user_id']);
                $user->expiration_date = date('Y-m-d H:i:s', strtotime("+3 months", strtotime($user->expiration_date)));
                if($user->save()){
                    $log = new \App\Log;
                    $log->user = \Auth::user()->id;
                    $log->message = "Add 3 months for user " . $_POST['user_id'];
                    $log->save();
                    return \Response::json(array('code' => '200', 'message' => 'success'));
                }
            }
        }
        return \Response::json(array('code' => '404', 'message' => 'unsuccess'));
    }

    public function remove3time(Request $request){
        if(\Auth::user()->status == 0){
            if(isset($_POST) && isset($_POST['user_id'])){
                $user = \App\User::find((int)$_POST['user_id']);
                $user->expiration_date = date('Y-m-d H:i:s', strtotime("-3 months", strtotime($user->expiration_date)));
                if($user->save()){
                    $log = new \App\Log;
                    $log->user = \Auth::user()->id;
                    $log->message = "Remove 3 months for user " . $_POST['user_id'];
                    $log->save();
                    return \Response::json(array('code' => '200', 'message' => 'success'));
                }
            }
        }
        return \Response::json(array('code' => '404', 'message' => 'unsuccess'));
    }
}
