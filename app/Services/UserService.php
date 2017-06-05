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

  /**
   * @var UserRepository
   */
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

  /**
   * register the user and login
   *
   * @param $input
   */
  public function register($input) {

    $this->validator->fire($input, 'register');

    $input = [
        'name'=>$input['name'],
        'email'=>$input['email'],
        'password' => Hash::make($input['password'])
    ];

    $user = $this->userRepo->register($input);

    Auth::login($user);

  }

  /**
   * login
   *
   * @param $input
   * @throws AuthenticationException
   */
  public function login($input){

    $this->validator->fire($input, 'login');

    $input = [
        'email' =>  $input['loginEmail'],
        'password'  =>  $input['loginPassword']
    ];

    if (!auth()->attempt($input, isset($input['remember']))) {
      throw new AuthenticationException("Your credentials are incorrect!",401);
    }

  }

  /**
   * generate token and send mail
   *
   * @param $input
   */
  public function sendResetPasswordToken($input) {

    $this->validator->fire($input,'forgot');

    $reset_token = $this->resetPasswordRepo->generateToken($input['forgotEmail']);

    Mail::to($input['forgotEmail'])->send(new PasswordReset($reset_token));

  }

  /**
   * update user's password
   *
   * @param $input
   * @throws AuthenticationException
   */
  public function resetPassword($input) {

    $this->validator->fire($input, 'reset');

    $password_reset = $this->resetPasswordRepo->findFromEmail($input['email']);

    if($password_reset->token == $input['token']) {

      $this->resetPasswordRepo->delete($input);

      $user = $this->userRepo->findFromEmail($input['email']);

      $this->userRepo->update($user, $input['password']);

    } else {

      throw new AuthenticationException("You cannot change password for this email with this password reset link!",400);

    }

  }

}