<?php

namespace App\Http\Controllers\web;

use Auth,
    Illuminate\Http\Request,
    App\Services\UserService,
    App\Http\Controllers\Controller,
    App\Exceptions\RegistrationException,
    App\Exceptions\AuthenticationException;


class UserController extends Controller {

  protected $userService;

  public function __construct(UserService $userService){

    $this->userService = $userService;
  }


  public function showLogin() {

    if(auth()->check()) {

      return redirect()->route('student.view');
    }
    return view('web.auth.login');
  }

  public function redirectTo() {

    return route('student.view');
  }

  public function doLogin(Request $request){

    try {

      $input = $request->all();

      $this->userService->login($input);

      return redirect()->route('student.view');

    } catch (AuthenticationException $e) {

      return redirect()->back()
          ->with('invalid_login_credentials', $e->getMessage())
          ->withInput($input);
    }

  }

  public function logout(){

    Auth::logout();

    return redirect()->route('user.login.get')->with('message','You are logged out!');

  }

  public function doRegister(Request $request){

    try{

      $inputs = $request->all();

      $this->userService->register($inputs);

      return redirect()->route('student.view')
          ->with('message','Your account has been successfully registered!');

    } catch (RegistrationException $e) {

      return redirect()->back()
          ->with('registration_exception', $e->getMessage())
          ->withInput($inputs);
    }

  }

  public function showReset($token){

    return view('web.auth.reset', ['token' => $token]);
  }

  public function doReset(Request $request){

    $input  = $request->all();

    $this->userService->resetPassword($input);

    return redirect()->route('user.login.get')
        ->with('message','Your password has been successfully changed!');

  }

  public function sendToken(Request $request) {

    $input  = $request->all();

    $this->userService->sendToken($input);

    return redirect()->route('user.login.get')
        ->with('message','Your password has been sent to your mail');

  }

}