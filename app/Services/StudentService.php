<?php

namespace App\Services;

use App\Exceptions\StudentException,
    App\Validators\StudentValidator,
    App\Repositories\StudentRepository,
    App\Repositories\InterestRepository;

class StudentService {

  protected $studentRepo, $interestRepo, $validator;
    /**
     * StudentService constructor.
     *
     * @param $studentRepository
     * @param $studentValidator
     * @param $interestRepository
     *
     */
  public function __construct(
      StudentRepository $studentRepository,
      InterestRepository $interestRepository,
      StudentValidator $studentValidator)
  {
    $this->studentRepo = $studentRepository;
    $this->interestRepo = $interestRepository;
    $this->validator  = $studentValidator;
  }

  /**
   * get student of user
   *
   * @param $user
   * @return mixed
   */
  public function getStudentsForUser($user) {

    return $this->studentRepo->getStudentsForUser($user);
  }

  /**
   * find student by id
   *
   * @param $id
   * @return mixed
   */
  public function find($id){

    $student = $this->studentRepo->find($id);

    $student = $this->studentRepo->student_with_interests_array($student);

    return $student;
  }

  /**
   * all interests
   *
   * @return mixed
   */
  public function getInterests(){

    return $this->interestRepo->get();
  }

  /**
   * if user is allowed to access student
   * @param $input
   * @throws StudentException
   */
  public function checkAuthenticatedUser($student) {

    if ($student->user_id != auth()->user()->id)
      throw new StudentException('You are trying to access non authorized data.', 403);

  }

  /**
   * create a student
   *
   * @param $inputs
   * @throws StudentException
   */
  public function create($inputs){

    $this->validator->fire($inputs,'create');

    $input = [
        'name'=>$inputs['name'],
        'address'=>$inputs['address'],
        'gender'=>$inputs['gender'],
        'year'=>$inputs['year']
    ];

    $student = $this->studentRepo->create($inputs);

    if (!isset($inputs['interests']))
      $input['interests'] = [];
    else
      $input['interests'] = $inputs['interests'];

    $this->studentRepo->syncInterests($student, $input['interests']);

  }

  /**
   * update a student
   *
   * @param $id
   * @param $inputs
   */
  public function update($id, $inputs) {

    $this->validator->fire($inputs,'update');

    $student = $this->studentRepo->find($id);

    $input = [
        'name'=>$inputs['name'],
        'address'=>$inputs['address'],
        'gender'=>$inputs['gender'],
        'year'=>$inputs['year']
    ];

    $this->studentRepo->update($student, $input);

    if (!isset($inputs['interests']))
      $inputs['interests'] = [];

    $this->studentRepo->syncInterests($student, $inputs['interests']);

  }

  /**
   * delete a student
   *
   * @param $id
   */
  public function delete($id){

    $student = $this->studentRepo->find($id);

    $this->studentRepo->delete($student);

    $this->studentRepo->syncInterests($student, []);

  }
}