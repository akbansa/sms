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
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function showAll(){

    $students = $this->studentService->getStudentsForUser(auth()->user());

    return view('web.student.view', compact('students'));
  }

  /**
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function showCreate() {

    $interests = $this->studentService->getInterests();

    return view('web.student.add',compact('interests'));
  }

  /**
   * @param $id
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   * @throws StudentException
   */
  public function showEdit($id){

    try{

      $student = $this->studentService->find($id);

      $this->studentService->checkAuthenticatedUser($student);

      $interests = $this->studentService->getInterests();

      return view('web.student.edit', compact(['student','interests']));

    } catch (StudentException $e) {

      return view('errors.403');
    }

  }

  /**
   * @param $id
   * @param Request $request
   * @return \Illuminate\Http\RedirectResponse
   */
  public function doEdit($id,Request $request) {

    $input = $request->all();

    $this->studentService->update($id, $input);

    return redirect()->route('student.view')->with('message','Student updated successfully!');
  }

  /**
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
   * @param Request $request
   * @return \Illuminate\Http\RedirectResponse
   */
  public function doCreate(Request $request){

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
