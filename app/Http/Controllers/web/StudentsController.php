<?php

namespace App\Http\Controllers\web;

use App\Exceptions\StudentException;
use Illuminate\Http\Request,
    App\Services\StudentService,
    App\Http\Controllers\Controller;

/**
 * Class StudentsController
 * @package App\Http\Controllers\web
 */
class StudentsController extends Controller{

  /**
   * @var StudentService
   */
  protected $studentService;

  /**
   * StudentsController constructor.
   * @param StudentService $studentService
   */
  public function __construct(StudentService $studentService)
  {
    $this->studentService = $studentService;
  }

  /**
   * show all students of a user
   *
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function showAll(){

    $students = $this->studentService->getStudentsForUser(auth()->user());

    return view('web.student.view', compact('students'));
  }

  /**
   * show create student page
   *
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function showCreate() {

    $interests = $this->studentService->getInterests();

    return view('web.student.add',compact('interests'));
  }

  /**
   * show student edit page
   *
   * @param $id
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   * @throws StudentException
   */
  public function showEdit($id){

    try {

      $student = $this->studentService->find($id);

      $this->studentService->checkAuthenticatedUser($student);

      $interests = $this->studentService->getInterests();

      return view('web.student.edit', compact(['student', 'interests']));

    } catch (\Exception $e) {

      throw new StudentException($e->getMessage(), $e->getCode() ? $e->getCode() : 400);

    }

  }

  /**
   * update student details
   *
   * @param $id
   * @param Request $request
   * @return \Illuminate\Http\RedirectResponse
   */
  public function update($id,Request $request) {

    $input = $request->all();

    $this->studentService->update($id, $input);

    return redirect()->route('student.view')->with('message','Student updated successfully!');
  }

  /**
   * delete student
   *
   * @param $id
   * @return \Illuminate\Http\JsonResponse
   */
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

  /**
   * create student
   *
   * @param Request $request
   * @return \Illuminate\Http\RedirectResponse
   */
  public function create(Request $request){

    try{

      $input = $request->all();

      $this->studentService->create($input);

      return redirect()->route('student.view')->with('message','Student added successfully!');

    } catch (StudentException $e) {

      return redirect()->back()->with('exception_message','Student added successfully!')
          ->with($input);
    }

  }
}
