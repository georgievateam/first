<?php


namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class UsersController extends Controller
{
    public function signUp(){
        return view('regist');

    }
    function postSignUp(Request $request){
        $this->validate($request,[
        'first_name'=>'required|min: 2|max: 25',
         'last_name'=>'required|min: 2|max: 25',
         'email'=>   'required|email|min: 2|max: 125|',// 'unique:users, email_address',
         'password'=>'required|confirmed',
          'sex'=>'required'

        ]);
        //ako vs e ok
        //return response('raboti', 200);
        //dd($reqest->all());
        //echo 'bravo';
        $user = new User();
        $user->email_address = $request->email;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->gender = $request->sex;
        $user->password=Hash::make($request->password);
        $user->save();


        Auth::login($user);
        return redirect('home');
    }

    function logOut()
    {
        Auth::logout();
        //return redirect()->back();
    }
    function postLogIn(Request $request){

        $this->validate($request,[
            'email'=>'required|email',
            'password'=>'required'
         ]);
        if(Auth::attempt([
            'password'=>$request->password,
            'email_address'=>$request->email,
        ])){
            return redirect('home');
        }else{
            return back()->with('error', 'Неуспешно влизане');
        }

        dd('log in');
    }

}