<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display register page.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $students = Student::all();
        return view('student',$students)->with('studentList',$students);
    }

    /**
     * Handle account registration request
     *
     * @param RegisterRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function register(StudentRequest $request)
    {
        // EMAIL TO CHECK IF EXISTS.
        $email = $request->get('email');

        // WE CHECK IF THE EMAIL EXISTS.
        if (sizeof(Student::where('email','=',$email)->get() )> 0)
            return redirect('/')->withErrors(['emailInUse'=> 'emailInUse']);

        // WE INSERT ITEM INTO STUDENTS TABLE.
        $student = Student::create($request->validated());

        // WE RETURN SUCCESSFULL MESSAGE.
        return redirect('/')->with('success', "Student successfully created.");
    }
}
