<?php

namespace App\Services;

use App\Validators\StudentValidator;
use App\Repositories\StudentRepository;
use App\Repositories\InterestRepository;

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

    public function getStudentsForUser($user) {

      return $this->studentRepo->get($user);
    }

    public function find($id){

        $student = $this->studentRepo->find($id);

        $student = $this->studentRepo->student_with_interests_array($student);

        return $student;
    }

    public function getInterests(){

        return $this->interestRepo->get();
    }

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

    public function update($id, $inputs){
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
          $input['interests'] = [];
        else
          $input['interests'] = $inputs['interests'];

        $this->studentRepo->syncInterests($student, $input['interests']);

    }

    public function delete($id){
        $interests =[];

        $student = $this->studentRepo->find($id);

        $this->studentRepo->delete($student);

        $this->studentRepo->syncInterests($student, $interests);
    }
}