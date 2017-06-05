<?php

namespace App\Services;

use Auth,
    Hash,
    App\Validators\UserValidator,
    Illuminate\Support\Facades\Mail,
    App\Repositories\UserRepository,
    App\Exceptions\AuthenticationException,
    App\Repositories\ResetPasswordRepository;

use App\Mail\PasswordReset;

class UserService{

  protected $userRepo,$validator,$resetPasswordRepo;
  
  public function __construct(
      UserRepository $userRepository,
      UserValidator $validator,
      ResetPasswordRepository $resetPasswordRepository)
  {
    $this->userRepo = $userRepository;
    $this->validator = $validator;
    $this->resetPasswordRepo  = $resetPasswordRepository;
  }

  public function register($input){

    $this->validator->fire($input, 'register');

    $input = [
        'name'=>$input['name'],
        'email'=>$input['email'],
        'password' => Hash::make($input['password'])
    ];

    $user = $this->userRepo->register($input);

    Auth::login($user);

  }

  public function login($input){

    $this->validator->fire($input, 'login');

    if (isset($input['remember']))
      $remember = true;
    else
      $remember = false;

    $input = [
        'email' =>  $input['loginEmail'],
        'password'  =>  $input['loginPassword']
    ];

    if (!auth()->attempt($input,$remember)) {
      throw new AuthenticationException();
    }

  }

  public function sendToken($input){

    $this->validator->fire($input,'forgot');

    $reset_token = $this->resetPasswordRepo->forgotPassword($input['forgotEmail']);

    Mail::to($input['forgotEmail'])->send(new PasswordReset($reset_token));

  }

  public function resetPassword($input) {

    $this->validator->fire($input, 'reset');

    $this->resetPasswordRepo->reset($input);

    $this->userRepo->reset($input);

  }

}