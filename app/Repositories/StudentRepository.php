<?php

namespace App\Repositories;

use App\Models\Student;

class StudentRepository {

  /**
   * get students of user
   *
   * @param $user
   * @return mixed
   */
  public function getStudentsForUser($user){

    return $user->students;
  }

  /**
   * find student by id
   *
   * @param $id
   * @return mixed
   */
  public function find($id){

    return Student::findOrFail($id);
  }

  /**
   * find student's interests in array
   *
   * @param $student
   * @return mixed
   */
  public function student_with_interests_array($student){

    $student->interests = $student->interests->pluck('id')->all();

    return $student;
  }

  /**
   * create a student
   *
   * @param $data
   * @return mixed
   */
  public function create($data){

    return auth()->user()->students()->create($data);
  }

  /**
   * update a student
   *
   * @param $student
   * @param $data
   */
  public function update($student,$data){

    $student->update($data);
  }

  /**
   * delete a student
   *
   * @param $student
   */
  public function delete($student){
    $student->delete();
  }

  /**
   * synchronize interests
   *
   * @param $student
   * @param $interests
   */
  public function syncInterests($student, $interests){
    $student->interests()->sync($interests);
  }

}