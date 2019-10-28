<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Alert;
use Excel;

class addstudent extends Controller
{

	public function __construct()
   
     {
        $this->middleware('auth');
     }
    public function index()
    {
    	$semester = DB::table('semester')->get();
       $pattern = DB::table('pattern')->get();
    	return view('adminarea.addstudent',compact('semester','pattern'));
    }


    function coursefetch(Request $request)
    {
   
    
       
     $department = $request->get('department');
     $select = $request->get('select');
     $value = $request->get('value');
     //$dependent = $request->get('dependent');
     $dependent1 = 'course_name';
     $data = DB::table('courses')->where('sem', $value)->where('department',$department)->get();
  
     $output = '<option value="">Select '.ucfirst($dependent1).'</option>';


    
     foreach($data as $row)
    {
      $output .= '<option value="'.$row->id.'">'.$row->$dependent1.'</option>';
 }
     echo "$output";
    

    }

    function check(Request $request)
    {

     $department = $request->get('department');
     $pattern = $request->get('pattern');
     $semester = $request->get('semester');
     $course = $request->get('course');
     $dependent = "upload";

     $countdata = count(DB::table('student')->where('department',$department)->where('pattern',$pattern)->where('sem',$semester)->where('course_id',$course)->get());
 
    if($countdata == 0)
    {
        $output = '
      
            <input type="hidden" value="'.$department.'" name="department">
            <input type="hidden" value="'.$pattern.'" name="pattern">
            <input type="hidden" value="'.$semester.'" name="semester">
            <input type="hidden" value="'.$course.'" name="course">
            
           


            <table  class="table table-condensed">
                <thead>
            <tr>
                <th><label for="semester">Upload Excel File</label></th>
                <th></th>
                 <th><input type="file" name="file" id="file" class="form-control"></th>
               
       </tr>
    
   </table>


 <center><button type="submit" class="btn btn-success">Upload</button></center>
 
    ';
    }
    else
    {
      $output = '
     <div class="form-group col-md-5"
      <big><label for="semester">Student Already Exist !</label></big>
      
        

     
       
    </div>';  
    }

        echo "$output";
    }



     public function upload(Request $request)
    {
        

        $request->validate([
            'file' => 'required'
        ]);
 
        $path = $request->file('file')->getRealPath();
        $data = Excel::load($path)->get();
        $department = $request->get('department');
        $pattern = $request->get('pattern');
        $semester = $request->get('semester');
        $course = $request->get('course');
        $countdata = count($data);

        if($data->count()){
            foreach ($data as $key => $value) {
                $arr[] = ['studentid' => $value->studentid , 'StudentName' => $value->studentname , 'seatNo' => $value->seatno];
            }

 
            if(!empty($arr)){
               $counteddata = count($arr);
               for ($i=0; $i < $counteddata ; $i++) { 

        DB::table('student')->insert(['students_id' => $arr[$i]['studentid'], 'name' =>$arr[$i]['StudentName'],  'seatno' =>$arr[$i]['seatNo'],'pattern'=> $pattern , 'sem'=> $semester , 'department'=>$department,'course_id'=>$course]);           
                     }
           
            }
        }

                Alert::success('Success', 'Student Stored in database!');
                return redirect('home/addstudent');
                
    }
       

    }



    

