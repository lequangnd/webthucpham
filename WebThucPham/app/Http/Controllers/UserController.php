<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function register()
    {
        return view('user.register');
    }
    public function addRegister(Request $request)
    {
        $users=User::all();
        foreach($users as $u)
        {
            if($request->email==$u->email)
            {
                dd('Tài khoản đã tồn tại.');
                return;
            }
        }
        $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=bcrypt( $request->password);
        $user->address=$request->address;
        $user->phone=$request->phone;
        $user->save();
        return redirect()->route('login');
    }

    public function login()
    {
        return view('user.login');
    }

    public function postLogin(Request $request)
    {
        if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password] ))
        {
            return redirect()->route('index');
        }
        else{
            echo "lỗi";
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('index');
    }

    public function forget()
    {
        return view('user.forget');
    }

    public function postForget(Request $request)
    {
        $user=User::where('email',$request->email)->first();
        $token=rand();
        $user->remember_token=$token;
        $user->save();
        Mail::send('user.check',compact('user'),function($email) use($user)
        {
            $email->subject('Lấy lại mật khẩu');
            $email->to($user->email,$user->name);
        });
        Alert::success('', 'Yêu cầu lấy mật khẩu thành công.');
        return redirect()->route('login');
    }

    public function password($id,$token)
    {
        $user=User::where('id',$id)->where('remember_token',$token)->first();
        return view('user.password',['user'=>$user]);
    }

    public function postPassword(Request $request,$id,$token)
    {
        if($request->password != $request->password_new)
        {
          dd("Mật khẩu không trùng khớp");
        }
        $user=User::where('id',$id)->where('remember_token',$token)->first();
        $user->password=bcrypt( $request->password_new);
        $user->save();
        Alert::success('', 'Đổi mật khẩu thành công');
        return redirect()->route('login');
    }
}
