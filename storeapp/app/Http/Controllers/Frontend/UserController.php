<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Model\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.user.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email'         => 'required|email|max:255|unique:users',
                'password'      => 'required|min:6|max:30',
                'repassword'    => 'min:6|max:30|same:password'
            ]);                                                                                                                                                                                                                                                                                                                                 
            if($validator->fails()) throw new \Exception($validator->errors()->first());
            $user = new User();
            $user->name = $request->firstname ." ". $request->lastname;
            $user->password = bcrypt($request->password);
            $user->email = $request->email;
            $user->save();
            return redirect()->back()->with([
                "messages" => 'Đăng ký thành công!',
                'color' => 'alert-success'
            ]);
        }catch(\Exception $e) {
            return redirect()->back()->with([      
                "messages" => $e->getMessage(), 
                'color' => 'alert-danger'
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            if( !isset($request->email) || !isset($request->password))  throw new \Exception('chua nhap tai khoan mat khau');
            $information = $request->only('email', 'password');
            if( Auth::attempt($information)) {
                return redirect()->route('my_account');
            }
        }catch(\Exception $e) {
            return redirect()->back()->with([      
                "messages" => $e->getMessage(), 
                'color' => 'alert-danger'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        try {
            if( Auth::check()) {
                return view('frontend.user.account');
            }
        }catch(\Exception $e) {
            return redirect()->route('home');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //logout user 

    public function logout() {
        try {
            if( Auth::Check() ) {
                Auth::logout();
                return redirect()->route('home');
            }
        }catch(\Exception $e) {
            return redirect()->route('home');
        }
    }
}
