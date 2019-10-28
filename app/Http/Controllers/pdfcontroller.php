<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;
use Alert;
use Auth;

class pdfcontroller extends Controller
{
    public function __construct()
   
     {
        $this->middleware('auth');
     }
	public function ia(Request $request)
	{

		
		
		$student_id = $request->get('student_id');
		$seatno = $request->get('seatno');
		$test1 = $request->get('test1');
		$test2 = $request->get('test2');
		$avg = $request->get('avg');
		
		


		$courseid = $request->get('courseid');
		$department = Auth::user()->department;
		$coursename = DB::table('courses')->where('id',$courseid)->get()[0]->course_name;
		$coursesem = DB::table('courses')->where('id',$courseid)->get()[0]->sem;
		$ia = DB::table('courses')->where('id',$courseid)->get()[0]->IA;


		$isverified = DB::table('marksverified')->where('course_id',$courseid)->get();
		$countverified = count($isverified);

		if ($countverified == 0 ) {

			DB::table('marksverified')->insert(['course_id' => $courseid, 'facultyverified_ia' => "Y", 'facultyverified_tw' => "N" ,'facultyverified_oral' => "N" , 'hod_verified' => "N",'created_at'=> now()]);
		

		$pdf = PDF::loadView('pdfview.iamarks',compact('student_id','seatno','test1','test2','avg','ia','department','coursename','coursesem'));
		return $pdf->stream('ia.pdf');

		} else {

			DB::table('marksverified')->where('course_id',$courseid)->update(['facultyverified_ia'=> "Y"]);

			$pdf = PDF::loadView('pdfview.iamarks', compact('student_id','seatno','test1','test2','avg','ia','department','coursename','coursesem'));
		return $pdf->stream('ia.pdf');
		}
}


public function tw(Request $request)
	{

		
		$student_id = $request->get('student_id');
		$seatno = $request->get('seatno');
		
		$termwork = $request->get('termwork');
		


		$courseid = $request->get('courseid');
		$department = Auth::user()->department;
		$coursename = DB::table('courses')->where('id',$courseid)->get()[0]->course_name;
		$coursesem = DB::table('courses')->where('id',$courseid)->get()[0]->sem;



		$tw = DB::table('courses')->where('id',$courseid)->get()[0]->TW;

		$isverified = DB::table('marksverified')->where('course_id',$courseid)->get();
		$countverified = count($isverified);

		if ($countverified == 0 ) {

			DB::table('marksverified')->insert(['course_id' => $courseid, 'facultyverified_ia' => "N",  'facultyverified_tw' => "Y" ,'facultyverified_oral' => "N" , 'hod_verified' => "N",'created_at'=> now()]);
		

		$pdf = PDF::loadView('pdfview.twmarks',compact('student_id','seatno','termwork','tw','department','coursename','coursesem'));
		return $pdf->stream('tw.pdf');

		} else {

			DB::table('marksverified')->where('course_id',$courseid)->update(['facultyverified_tw'=> "Y"]);

			$pdf = PDF::loadView('pdfview.twmarks', compact('student_id','seatno','termwork','tw','department','coursename','coursesem'));
		return $pdf->stream('tw.pdf');
		}



		

		

		
	}

	public function orpr(Request $request)
	{

		$id = $request->get('id');
		$student_id = $request->get('student_id');
		$seatno = $request->get('seatno');
		$oralpr = $request->get('oralpr');

		
		$courseid = $request->get('courseid');
		$department = Auth::user()->department;
		$coursename = DB::table('courses')->where('id',$courseid)->get()[0]->course_name;
		$coursesem = DB::table('courses')->where('id',$courseid)->get()[0]->sem;

		$orpr = DB::table('courses')->where('id',$courseid)->get()[0]->OR_PR;

		$isverified = DB::table('marksverified')->where('course_id',$courseid)->get();
		$countverified = count($isverified);

		if ($countverified == 0 ) {

			DB::table('marksverified')->insert(['course_id' => $courseid, 'facultyverified_ia' => "N",  'facultyverified_tw' => "N" ,'facultyverified_oral' => "Y" , 'hod_verified' => "N",'created_at'=> now()]);
		

		$pdf = PDF::loadView('pdfview.orprmarks',compact('student_id','seatno','oralpr','orpr','department','coursename','coursesem'));
		return $pdf->stream('orpr.pdf');

		} else {

			DB::table('marksverified')->where('course_id',$courseid)->update(['facultyverified_oral'=> "Y"]);


			
			$pdf = PDF::loadView('pdfview.orprmarks', compact('student_id','seatno','oralpr','orpr','department','coursename','coursesem'));
		return $pdf->stream('orpr.pdf');
		}
	}


	

}
