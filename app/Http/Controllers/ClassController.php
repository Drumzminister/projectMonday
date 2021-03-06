<?php

namespace App\Http\Controllers;

use App\Models\AssignmentSubscription;
use App\Repositories\ClassRepository;
use App\Repositories\StudentClassRepository;
use Illuminate\Http\Request;
use Auth;
use Exception;


class ClassController extends Controller
{
	private $class;
	private $studentClassRepository;

	public function __construct(ClassRepository $class, StudentClassRepository $studentClassRepository)
	{
		$this->middleware('auth');
		$this->middleware('student');
		$this->class = $class;
		$this->studentClassRepository = $studentClassRepository;
	}

	public function list()
    {
    	$data['classes'] = $this->class->getByAttributes(['level_id' => Auth::user()->student->level_id]);
    	return view('students.listing', $data);
    }

    public function joinClass(Request $request)
    {
			$data = $request->except(['_token']);
			$data['student_id'] = Auth::user()->student->id;
			$result = $this->studentClassRepository->fillAndSave($data);

    	if ($result) {
    		return back()->with('message', 'Class Joined Successfully.');
		}

    }


    public function showClass($classId)
    {
    	$class = $this->class->find($classId, ['assignments']);

	    $conditions = [
    		    ['student_id', '=', Auth::user()->student->id,],
		        ['submitted', '=', 1],
		    ];

	    $data['submittedAssignments'] = AssignmentSubscription::where($conditions)->whereIn('assignment_id', ($class->assignments()->pluck('id')))->paginate(4);
	    $data['pendingAssignments'] = $class->assignments()->whereNotIn('id', ($data['submittedAssignments'])->pluck('assignment_id'))->paginate(4);
	    $data['class'] = $class;

	    return view('students.class', $data);
    }

    public function myClasses()
    {
        $data['classes'] = $this->studentClassRepository->getByAttributes(['student_id' => Auth::user()->student->id], 'AND', ['class'])->pluck('class');
        // return $data;
    	return view('students.my-classes', $data);
    }
}
