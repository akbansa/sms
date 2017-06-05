<?php

namespace App\Repositories;

use App\Models\Student;

class StudentRepository {

  public function get($user){

    return $user->students;
  }

  public function find($id){

    return Student::findOrFail($id);
  }

  public function student_with_interests_array($student){

    $student->interests = $student->interests->pluck('id')->all();

    return $student;
  }
  public function create($data){

    return auth()->user()->students()->create($data);
  }

  public function update($student,$data){

    $student->update($data);
  }

  public function delete($student)
  {
    $student->delete();
  }

  public function syncInterests($student, $interests) {
    $student->interests()->sync($interests);
  }

}