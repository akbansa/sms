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

    if($user = $this->userRepo->register($input))
      Auth::login($user);
    else
      throw new AuthenticationException("There is some error",400);

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
      throw new AuthenticationException("Your email or password is incorrect!",401);
    }

  }

  public function sendResetPasswordToken($input) {

    $this->validator->fire($input,'forgot');

    $reset_token = $this->resetPasswordRepo->forgotPassword($input['forgotEmail']);

    Mail::to($input['forgotEmail'])->send(new PasswordReset($reset_token));

  }

  public function resetPassword($input) {

    $this->validator->fire($input, 'reset');

    $check = $this->resetPasswordRepo->checkTokenEmail($input['email']);

    if($check->token == $input['token']) {

      $this->resetPasswordRepo->reset($input);

      $this->userRepo->reset($input);
    }
    else
    {
      throw new AuthenticationException("You cannot change password for this email with this password reset link!",400);
    }

  }

}