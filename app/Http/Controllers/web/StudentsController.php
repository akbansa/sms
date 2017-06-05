<?php

namespace App\Http\Controllers\web;

use Illuminate\Http\Request,
    App\Services\StudentService,
    App\Http\Controllers\Controller;

class StudentsController extends Controller{

  protected $studentService;
    public function __construct(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }

    public function showAll(){

      $students = $this->studentService->getStudentsForUser(auth()->user());

      return view('web.student.view', compact('students'));
    }

    public function showCreate() {

        $interests = $this->studentService->getInterests();

        return view('web.student.add',compact('interests'));
    }

    public function showEdit($id){

        $student = $this->studentService->find($id);

        if ($student->user_id != auth()->user()->id)
          abort(404,'Student do not exist!');

        $interests = $this->studentService->getInterests();

        return view('web.student.edit', compact(['student','interests']));
    }

    public function doEdit($id,Request $request) {

      $input = $request->all();

      $this->studentService->update($id, $input);

      return redirect()->route('student.view')->with('message','Student updated successfully!');
    }

    public function delete($id){

        try {

            $this->studentService->delete($id);

            return response()->json([
                'status' => true
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'status' => false
            ]);
        }

    }

    public function doCreate(Request $request){

      $input = $request->all();

      $this->studentService->create($input);

      return redirect()->route('student.view')->with('message','Student added successfully!');


    }
}
