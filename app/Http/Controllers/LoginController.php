<?php

namespace App\Http\Controllers;
use App\User;
use Validator;
use Auth;
use Hash;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\AdminLoginModel;

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'user_password' =>  'required'
        ]);
        $username = $request->input('username');
        $password = $request->input('user_password');

        $user = User::where('username', '=', $username)
            ->orWhere('email','=','$username')
            ->first();
        if ($user) {
            if (Hash::check($password, $user->user_password)) {
                if($user->status ==1){
                    return redirect()->intended('/home');
                }
                else{
                    $request->session()->flash('message', 'User is Inactive');
                    return redirect()->back();
                }
            }else{
                $request->session()->flash('message', 'Incorrect Password');
                return redirect()->back();
            }
        }else{
            $request->session()->flash('message', 'Invalid User');
            return redirect()->back();
        }
    }
    function doLogout(Request $request)
    {
        Auth::logout(); // logging out user
        return redirect()->intended('/');
    }
    function doLogin()
    {
        // Creating Rules for Email and Password
        $request = array(
            'username' => 'required', // make sure the email is an actual email
            'user_password' => 'required'
        );
      $validator = Validator::make(input::all() , $request);
      if ($validator->fails())
      {
          return Redirect::to('login')->withErrors($validator) // send back all errors to the login form
          ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
      }
      else
      {

          $userdata = array(
              'username' => $request->input::get('username') ,
              'user_password' => input::get('user_password')
          );
          if (Auth::attempt($userdata))
          {
              return redirect()->intended('/home');
          }
          else
          {
              $request->session()->flash('message', 'Invalid User');
              return redirect()->back();
          }
      }
    }


}
