<?php

namespace App\Repositories;

use App\Models\Student;

class StudentRepository {

    public function get($user){

      return $user->students;
    }

    public function find($id){

        $data = Student::findOrFail($id);

        return $data;
    }

    public function student_with_interests_array($student){

        $student->interests = $student->interests->pluck('id')->all();

        return $student;
    }
    public function create($data){

        return auth()->user()->students()->create($data);
    }

    public function update($student,$data){

        auth()->user()->students()
              ->where('id',$student['id'])->update($data);
    }

    public function delete($student)
    {
        auth()->user()->students()->delete($student);
    }

    public function syncInterests($student, $interests) {
        $student->interests()->sync($interests);
    }

}