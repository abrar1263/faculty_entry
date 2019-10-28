<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;
use Redirect;
use DateTime;
use App\user;

class coursealloting extends Controller

{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


          public function __construct()
   
     {
        $this->middleware('auth');
     }
    
    public function index()

    {  


        
        $semester_list = DB::table('semester')->get();
        $department = Auth::user()->department;
        $designation = Auth::user()->designation;

        $user= DB::table('users')->where('department',$department)->where('designation','!=',$designation)->get();

        $id = DB::table('users')->where('department',$department)->where('designation','!=',$designation)->pluck('id');

        $length = count($id);
        for ($i=0; $i < $length ; $i++) { 
            $id1 = $id[0];

            $courses = user::find($id1)->course;
            $course=array_pluck($courses,'course_name');
        }

        
        
        //$name=array_pluck($courses,'courses.course_name');

       
        return view('hod.allotcourse',compact('user','courses','semester_list'));
       
   }



   function fetch(Request $request)
    {
   
    
       
     $department = Auth::user()->department;
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



    function select_course(Request $request)
    {
        $id = $request->get('id');

        $data = DB::table('users')->where('id', $id)->get();

        $output = '<input type="hidden" name="faculty"  value="">';

        foreach($data as $row)
        {
           $output ='<strong><center><input type="hidden" name="faculty"  value="'.$row->id.'">Faculty Name : '.$row->name.'</center></strong>';
        }

        echo "$output";
    }




    function studentIA(Request $request)
    {
        $id = $request->get('select');
        
        $dependent = $request->get('dependent');

        $course = DB::table('courses')->where('id',$id)->get(); 
        $course_pattern = DB::table('courses')->where('id',$id)->pluck('pattern');
        $course_department = DB::table('courses')->where('id',$id)->pluck('department');
        $course_sem= DB::table('courses')->where('id',$id)->pluck('sem'); 
        $student =DB::table('student')->where('pattern',$course_pattern)->where('sem',$course_sem)->where('department',$course_department)->where('course_id',$id)->get();

        $marksia = DB::table('marksia')->where('course_id',$id)->get();
        $countia = count($marksia);



        $isverified = DB::table('marksverified')->where('course_id',$id)->get();
        $countverified = count($isverified);

        if ($countverified > 0) {

          $data1 = $isverified[0]->facultyverified_ia;
          $data2 = "Y";

          if ($data1 == $data2) {

            if($countia > 0)
       {

        $output = '
            <center><strong><p>Subject:- '.$course[0]->course_name.'</p> </strong>  </center> 
            <input type="hidden" name="courseid" value="'.$id.'">
         <table  class="table table-condensed">
    <thead>
    <tr>
          <th>Student Name</th>
          <th>Seat No</th>
          <th>Test 1(20)</th>
          <th>Test(20)</th>
          <th>AVG(20)</th>
       </tr>
  </thead><tbody>'; 
  $b='';
  


for ($i=0; $i <$countia ; $i++) { 
    
 $average[] = collect([$marksia[$i]->Test1,$marksia[$i]->Test2])->avg();
 $roundavg[] = round($average[$i]);

      
     

     $b =$b.'<tr>

      
        <td><input type="hidden" name="student_id[]" value="'.$student[$i]->id.'">'.$student[$i]->name.'</td>
        <td>'.$student[$i]->seatno.'</td>
        
        
      
         
   <div class="form-group">
          <td><input type="hidden"  class="form-control" maxlength="2" pattern="0|[1-9]|0[1-9]|1[0-9]|2[0]|Ab" id="test1" onclick="average()" value="'.$marksia[$i]->Test1.'" name="test1[]" onchange="average()"  placeholder="Enter Test Marks 1"required>'.$marksia[$i]->Test1.'</td></div>
       <div class="form-group">
          <td><input type="hidden" class="form-control" maxlength="2" pattern="0|[1-9]|0[1-9]|1[0-9]|2[0]|Ab" id="test2" onchange="average()" value="'.$marksia[$i]->Test2.'" name="test2[]" onchange="average()" placeholder="Enter Test Marks 2"required>'.$marksia[$i]->Test2.'</td></div>
       <div class="form-group">
          <td><input type="hidden" class="form-control "disabled id="avg" value="'.$roundavg[$i].'" name="avg[]" placeholder="Calculated marks">'.$roundavg[$i].'</td></div>
    </tr>';
 
}




 $d='</tbody></table>
 <p><font color="red"><strong>Note:</strong></font>Marks is Verified Save button is disabled You can only preview the marks</p>
 <center></center><br>';
                     
            

       

        echo "$output$b$d"; 


       }
        else
        {

                      
        $output = '
            <center><strong><p>Subject:- '.$course[0]->course_name.'</p> </strong>  </center> 
            <input type="hidden" name="courseid" value="'.$id.'">
         <table  class="table table-condensed">
    <thead>
    <tr>
          <th>Student Name</th>
          <th>Seat No</th>
          <th>Test 1(20)</th>
          <th>Test(20)</th>
          <th>AVG(20)</th>
       </tr>
  </thead><tbody>'; 
  $b='';
  foreach ($student as $data) {
    
     $b = $b.'<tr>

      
        <td><input type="hidden" name="student_id[]" value="'.$data->id.'">'.$data->name.'</td>
        <td>'.$data->seatno.'</td>
      
        <div class="form-group">
          <td><input type="text"  class="form-control" maxlength="2" pattern="0|[1-9]|0[1-9]|1[0-9]|2[0]|Ab" id="test1" name="test1[]" onchange="average()"  placeholder="Enter Test marks 1"required></td></div>
       <div class="form-group">
          <td><input type="text" class="form-control" maxlength="2" pattern="0|[1-9]|0[1-9]|1[0-9]|2[0]|Ab" id="test2" name="test2[]" onchange="average()" placeholder="Enter Test marks 2"required></td></div>
       <div class="form-group">
          <td><input type="text" class="form-control "disabled id="avg" name="avg[]" placeholder="Calculated marks"></td></div>
    </tr>';
 }

 $c='</tbody></table>
 <p><font color="red"><strong>Note:</strong></font>Marks is Verified Save button is disabled You can only preview the marks</p>
 <center><button type="submit" class="btn btn-success"disabled >Save</button></center><br>';
                     
            

       

        echo "$output$b$c";
    }
          } else {
            if($countia > 0)
       {

        $output = '
            <center><strong><p>Subject:- '.$course[0]->course_name.'</p> </strong>  </center> 
            <input type="hidden" name="courseid" value="'.$id.'">
         <table  class="table table-condensed">
    <thead>
    <tr>
          <th>Student Name</th>
          <th>Seat No</th>
          <th>Test 1(20)</th>
          <th>Test(20)</th>
          <th>AVG(20)</th>
       </tr>
  </thead><tbody>'; 
  $b='';
  


for ($i=0; $i <$countia ; $i++) { 
    
 $average[] = collect([$marksia[$i]->Test1,$marksia[$i]->Test2])->avg();
 $roundavg[] = round($average[$i]);

      
     

     $b =$b.'<tr>

      
        <td><input type="hidden" name="student_id[]" value="'.$student[$i]->id.'">'.$student[$i]->name.'</td>
        <td>'.$student[$i]->seatno.'</td>
        
        
      
         
   <div class="form-group">
          <td><input type="text"  class="form-control" maxlength="2" id="test1" onclick="average()" value="'.$marksia[$i]->Test1.'" name="test1[]" onchange="average()" pattern="0|[1-9]|0[1-9]|1[0-9]|2[0]|Ab"  placeholder="Enter Test Marks 1"required></td></div>
       <div class="form-group">
          <td><input type="text" class="form-control" maxlength="2" pattern="0|[1-9]|0[1-9]|1[0-9]|2[0]|Ab" id="test2" onchange="average()" value="'.$marksia[$i]->Test2.'" name="test2[]" onchange="average()" placeholder="Enter Test Marks 2"required></td></div>
       <div class="form-group">
          <td><input type="text" class="form-control "disabled id="avg" value="'.$roundavg[$i].'" name="avg[]" placeholder="Calculated marks"></td></div>
    </tr>';
 
}




 $d='</tbody></table>
 <center><button type="submit" class="btn btn-success" >Save</button></center><br>';
                     
            

       

        echo "$output$b$d";


       }
        else
        {

                      
        $output = '
            <center><strong><p>Subject:- '.$course[0]->course_name.'</p> </strong>  </center> 
            <input type="hidden" name="courseid" value="'.$id.'">
         <table  class="table table-condensed">
    <thead>
    <tr>
          <th>Student Name</th>
          <th>Seat No</th>
          <th>Test 1(20)</th>
          <th>Test(20)</th>
          <th>AVG(20)</th>
       </tr>
  </thead><tbody>'; 
  $b='';
  foreach ($student as $data) {
    
     $b = $b.'<tr>

      
        <td><input type="hidden" name="student_id[]" value="'.$data->id.'">'.$data->name.'</td>
        <td>'.$data->seatno.'</td>
      
        <div class="form-group">
          <td><input type="text"  class="form-control" maxlength="2" pattern="0|[1-9]|0[1-9]|1[0-9]|2[0]|Ab" id="test1" name="test1[]" onchange="average()"  placeholder="Enter Test marks 1"required></td></div>
       <div class="form-group">
          <td><input type="text" class="form-control" maxlength="2" pattern="0|[1-9]|0[1-9]|1[0-9]|2[0]|Ab" id="test2" name="test2[]" onchange="average()" placeholder="Enter Test marks 2"required></td></div>
       <div class="form-group">
          <td><input type="text" class="form-control "disabled id="avg" name="avg[]" placeholder="Calculated marks"></td></div>
    </tr>';
 }

 $c='</tbody></table>
 <center><button type="submit" class="btn btn-success" >Save</button></center><br>';
                     
            

       

        echo "$output$b$c";
    }
          }
          
    


        } else {


          if($countia > 0)
       {

        $output = '
            <center><strong><p>Subject:- '.$course[0]->course_name.'</p> </strong>  </center> 
            <input type="hidden" name="courseid" value="'.$id.'">
         <table  class="table table-condensed">
    <thead>
    <tr>
          <th>Student Name</th>
          <th>Seat No</th>
          <th>Test 1(20)</th>
          <th>Test(20)</th>
          <th>AVG(20)</th>
       </tr>
  </thead><tbody>'; 
  $b='';
  


for ($i=0; $i <$countia ; $i++) { 
    
 $average[] = collect([$marksia[$i]->Test1,$marksia[$i]->Test2])->avg();
 $roundavg[] = round($average[$i]);

      
     

     $b =$b.'<tr>

      
        <td><input type="hidden" name="student_id[]" value="'.$student[$i]->id.'">'.$student[$i]->name.'</td>
        <td>'.$student[$i]->seatno.'</td>
        
        
      
         
   <div class="form-group">
          <td><input type="text"  class="form-control" maxlength="2" id="test1" onclick="average()" value="'.$marksia[$i]->Test1.'" name="test1[]" onchange="average()"  pattern="0|[1-9]|0[1-9]|1[0-9]|2[0]|Ab" placeholder="Enter Test Marks 1"required></td></div>
       <div class="form-group">
          <td><input type="text" class="form-control" maxlength="2" id="test2" onchange="average()" value="'.$marksia[$i]->Test2.'" name="test2[]" onchange="average()"  pattern="0|[1-9]|0[1-9]|1[0-9]|2[0]|Ab" placeholder="Enter Test Marks 2"required></td></div>
       <div class="form-group">
          <td><input type="text" class="form-control "disabled id="avg" value="'.$roundavg[$i].'" name="avg[]" placeholder="Calculated marks"></td></div>
    </tr>';
 
}




 $d='</tbody></table>
 <center><button type="submit" class="btn btn-success" >Save</button></center><br>';
                     
            

       

        echo "$output$b$d";


       }
        else
        {

                      
        $output = '
            <center><strong><p>Subject:- '.$course[0]->course_name.'</p> </strong>  </center> 
            <input type="hidden" name="courseid" value="'.$id.'">
         <table  class="table table-condensed">
    <thead>
    <tr>
          <th>Student Name</th>
          <th>Seat No</th>
          <th>Test 1(20)</th>
          <th>Test(20)</th>
          <th>AVG(20)</th>
       </tr>
  </thead><tbody>'; 
  $b='';
  foreach ($student as $data) {
    
     $b = $b.'<tr>

      
        <td><input type="hidden" name="student_id[]" value="'.$data->id.'">'.$data->name.'</td>
        <td>'.$data->seatno.'</td>
      
        <div class="form-group">
          <td><input type="text"  class="form-control" maxlength="2"  pattern="0|[1-9]|0[1-9]|1[0-9]|2[0]|Ab" id="test1" name="test1[]" onchange="average()"  placeholder="Enter Test marks 1"required></td></div>
       <div class="form-group">
          <td><input type="text" class="form-control" maxlength="2" pattern="0|[1-9]|0[1-9]|1[0-9]|2[0]|Ab" id="test2" name="test2[]" onchange="average()" placeholder="Enter Test marks 2"required></td></div>
       <div class="form-group">
          <td><input type="text" class="form-control "disabled id="avg" name="avg[]" placeholder="Calculated marks"></td></div>
    </tr>';
 }

 $c='</tbody></table>
  <center><button type="submit" class="btn btn-success" >Save</button></center><br>';
                     
            

       

        echo "$output$b$c";
    }


          
        }
        

        
      

       
        
       

        

         
       
  }






     function studentTW(Request $request)
    {
         $id = $request->get('select');
        
        $dependent = $request->get('dependent');

        $course = DB::table('courses')->where('id',$id)->get();

        $course_pattern = DB::table('courses')->where('id',$id)->pluck('pattern');
        $course_department = DB::table('courses')->where('id',$id)->pluck('department');
        $course_sem= DB::table('courses')->where('id',$id)->pluck('sem'); 
        $student =DB::table('student')->where('pattern',$course_pattern)->where('sem',$course_sem)->where('department',$course_department)->where('course_id',$id)->get();
        $markstw = DB::table('markstw')->where('course_id',$id)->get();
        $counttw = count($markstw);
        $tw = DB::table('courses')->where('id',$id)->get()[0]->TW;

        $isverified = DB::table('marksverified')->where('course_id',$id)->get();
        $countverified = count($isverified);

        if ($countverified > 0) {

          $data1 = $isverified[0]->facultyverified_tw;
          $data2 = "Y";

          if ($data1 == $data2) {

            if ($counttw > 0) {

            $output =  '
       <center><strong><p> Subject:' .$course[0]->course_name.'</p> </strong>  </center>
         <input type="hidden" name="courseid" value="'.$id.'">
       <table  class="table table-condensed">
    <thead>
      
    <tr>
          <th>Student Name</th>
          <th>Seat No</th>
          <th>Term Work ('.$tw.')</th>
       
          
       </tr>

  </thead>
  <tbody>';
$a='';
for ($i=0; $i <$counttw ; $i++) { 

  if($tw == 25)
  {



    
   $a=$a.'<tr>

    <td><input type="hidden" name="student_id[]" value="'.$student[$i]->id.'">'.$student[$i]->name.'</td>
        <td>'.$student[$i]->seatno.'</td>

        <div class="form-group">
          <td><input type="hidden" class="form-control" maxlength="2"  pattern="0|[1-9]|0[1-9]|1[0-9]|2[0-5]|Ab" value="'.$markstw[$i]->TW.'" id="termwork" name="termwork[]" placeholder="Term Work marks"required>'.$markstw[$i]->TW.'</td></div>
      
    </tr>';
  }
  else if($tw == 50){

$a=$a.'<tr>

    <td><input type="hidden" name="student_id[]" value="'.$student[$i]->id.'">'.$student[$i]->name.'</td>
        <td>'.$student[$i]->seatno.'</td>

        <div class="form-group">
          <td><input type="hidden" class="form-control" maxlength="2"  pattern="0|[1-9]|0[1-9]|1[0-9]|2[0-9]|3[0-9]|4[0-9]|5[0]|Ab" value="'.$markstw[$i]->TW.'" id="termwork" name="termwork[]" placeholder="Term Work marks"required>'.$markstw[$i]->TW.'</td></div>
      
    </tr>';


  }

}


$b='</tbody></table>
<p><font color="red"><strong>Note:</strong></font>Marks is Verified Save button is disabled You can only preview the marks</p>
<center></center><br>';

       

            
            
        

        echo "$output$a$b";
        

            
        } else {
            $output =  '
       <center><strong><p>Subject:-'.$course[0]->course_name.'</p> </strong>  </center>
         <input type="hidden" name="courseid" value="'.$id.'">
       <table  class="table table-condensed">
    <thead>
      
    <tr>
          <th>Student Name</th>
          <th>Seat No</th>
          <th>Term Work ('.$tw.')</th>
       
          
       </tr>

  </thead>
  <tbody>';
$a='';
foreach ($student as $data) {

    
   if($tw == 25)
  {



    
   $a=$a.'<tr>

    <td><input type="hidden" name="student_id[]" value="'.$data->id.'">'.$data->name.'</td>
        <td>'.$data->seatno.'</td>

        <div class="form-group">
          <td><input type="text" class="form-control" maxlength="2"  pattern="0|[1-9]|0[1-9]|1[0-9]|2[0-5]|Ab" value="" id="termwork" name="termwork[]" placeholder="Term Work marks"required></td></div>
      
    </tr>';
  }
  else if($tw == 50){

$a=$a.'<tr>

    <td><input type="hidden" name="student_id[]" value="'.$data->id.'">'.$data->name.'</td>
        <td>'.$data->seatno.'</td>

        <div class="form-group">
          <td><input type="text" class="form-control" maxlength="2"  pattern="0|[1-9]|0[1-9]|1[0-9]|2[0-9]|3[0-9]|4[0-9]|5[0]|Ab" value="" id="termwork" name="termwork[]" placeholder="Term Work marks"required></td></div>
      
    </tr>';


  }
}


$b='</tbody></table>
<p><font color="red"><strong>Note:</strong></font>Marks is Verified Save button is disabled You can only preview the marks</p>
<center><button type="submit" class="btn btn-success"disabled >Save</button></center><br>';

       

            
            
        

        echo "$output$a$b";
        
        }
          }
          else
          {
            if ($counttw > 0) {

            $output =  '
       <center><strong><p>Subject:-'.$course[0]->course_name.'</p> </strong>  </center>
         <input type="hidden" name="courseid" value="'.$id.'">
       <table  class="table table-condensed">
    <thead>
      
    <tr>
          <th>Student Name</th>
          <th>Seat No</th>
          <th>Term Work ('.$tw.')</th>
       
          
       </tr>

  </thead>
  <tbody>';
$a='';
for ($i=0; $i <$counttw ; $i++) { 

    
     if($tw == 25)
  {



    
   $a=$a.'<tr>

    <td><input type="hidden" name="student_id[]" value="'.$student[$i]->id.'">'.$student[$i]->name.'</td>
        <td>'.$student[$i]->seatno.'</td>

        <div class="form-group">
          <td><input type="text" class="form-control" maxlength="2"  pattern="0|[1-9]|0[1-9]|1[0-9]|2[0-5]|Ab" value="'.$markstw[$i]->TW.'" id="termwork" name="termwork[]" placeholder="Term Work marks"required></td></div>
      
    </tr>';
  }
  else if($tw == 50){

$a=$a.'<tr>

    <td><input type="hidden" name="student_id[]" value="'.$student[$i]->id.'">'.$student[$i]->name.'</td>
        <td>'.$student[$i]->seatno.'</td>

        <div class="form-group">
          <td><input type="text" class="form-control" maxlength="2"  pattern="0|[1-9]|0[1-9]|1[0-9]|2[0-9]|3[0-9]|4[0-9]|5[0]|Ab" value="'.$markstw[$i]->TW.'" id="termwork" name="termwork[]" placeholder="Term Work marks"required></td></div>
      
    </tr>';


  }
}


$b='</tbody></table>
<center><button type="submit" class="btn btn-success" >Save</button></center><br>';

       

            
            
        

        echo "$output$a$b";
        

            
        } else {
            $output =  '
       <center><strong><p>Subject:-'.$course[0]->course_name.'</p> </strong>  </center>
         <input type="hidden" name="courseid" value="'.$id.'">
       <table  class="table table-condensed">
    <thead>
      
    <tr>
          <th>Student Name</th>
          <th>Seat No</th>
          <th>Term Work ('.$tw.')</th>
       
          
       </tr>

  </thead>
  <tbody>';
$a='';
foreach ($student as $data) {

    
   if($tw == 25)
  {



    
   $a=$a.'<tr>

    <td><input type="hidden" name="student_id[]" value="'.$data->id.'">'.$data->name.'</td>
        <td>'.$data->seatno.'</td>

        <div class="form-group">
          <td><input type="text" class="form-control" maxlength="2"  pattern="0|[1-9]|0[1-9]|1[0-9]|2[0-5]|Ab" value="" id="termwork" name="termwork[]" placeholder="Term Work marks"required></td></div>
      
    </tr>';
  }
  else if($tw == 50){

$a=$a.'<tr>

<td><input type="hidden" name="student_id[]" value="'.$data->id.'">'.$data->name.'</td>
        <td>'.$data->seatno.'</td>

        <div class="form-group">
          <td><input type="text" class="form-control" maxlength="2"  pattern="0|[1-9]|0[1-9]|1[0-9]|2[0-9]|3[0-9]|4[0-9]|5[0]|Ab" value="" id="termwork" name="termwork[]" placeholder="Term Work marks"required></td></div>
      
    </tr>';


  }
}


$b='</tbody></table>
<center><button type="submit" class="btn btn-success" >Save</button></center><br>';

       

            
            
        

        echo "$output$a$b";
        
        }

          }



        } else {


          if ($counttw > 0) {

            $output =  '
       <center><strong><p>Subject:-'.$course[0]->course_name.'</p> </strong>  </center>
         <input type="hidden" name="courseid" value="'.$id.'">
       <table  class="table table-condensed">
    <thead>
      
    <tr>
          <th>Student Name</th>
          <th>Seat No</th>
          <th>Term Work ('.$tw.')</th>
       
          
       </tr>

  </thead>
  <tbody>';
$a='';
for ($i=0; $i <$counttw ; $i++) { 

    if($tw == 25)
  {



    
   $a=$a.'<tr>

    <td><input type="hidden" name="student_id[]" value="'.$student[$i]->id.'">'.$student[$i]->name.'</td>
        <td>'.$student[$i]->seatno.'</td>

        <div class="form-group">
          <td><input type="text" class="form-control" maxlength="2"  pattern="0|[1-9]|0[1-9]|1[0-9]|2[0-5]|Ab" value="'.$markstw[$i]->TW.'" id="termwork" name="termwork[]" placeholder="Term Work marks"required></td></div>
      
    </tr>';
  }
  else if($tw == 50){

$a=$a.'<tr>

    <td><input type="hidden" name="student_id[]" value="'.$student[$i]->id.'">'.$student[$i]->name.'</td>
        <td>'.$student[$i]->seatno.'</td>

        <div class="form-group">
          <td><input type="text" class="form-control" maxlength="2"  pattern="0|[1-9]|0[1-9]|1[0-9]|2[0-9]|3[0-9]|4[0-9]|5[0]|Ab" value="'.$markstw[$i]->TW.'" id="termwork" name="termwork[]" placeholder="Term Work marks"required></td></div>
      
    </tr>';


  }
}


$b='</tbody></table>
<center><button type="submit" class="btn btn-success" >Save</button></center><br>';

       

            
            
        

        echo "$output$a$b";
        

            
        } else {
            $output =  '
       <center><strong><p>Subject:-'.$course[0]->course_name.'</p> </strong>  </center>
         <input type="hidden" name="courseid" value="'.$id.'">
       <table  class="table table-condensed">
    <thead>
      
    <tr>
          <th>Student Name</th>
          <th>Seat No</th>
         <th>Term Work ('.$tw.')</th>
       
          
       </tr>

  </thead>
  <tbody>';
$a='';
foreach ($student as $data) {

    if($tw == 25)
  {



    
   $a=$a.'<tr>

  <td><input type="hidden" name="student_id[]" value="'.$data->id.'">'.$data->name.'</td>
        <td>'.$data->seatno.'</td>

        <div class="form-group">
          <td><input type="text" class="form-control" maxlength="2"  pattern="0|[1-9]|0[1-9]|1[0-9]|2[0-5]|Ab" value="" id="termwork" name="termwork[]" placeholder="Term Work marks"required></td></div>
      
    </tr>';
  }
  else if($tw == 50){

$a=$a.'<tr>

  <td><input type="hidden" name="student_id[]" value="'.$data->id.'">'.$data->name.'</td>
        <td>'.$data->seatno.'</td>

        <div class="form-group">
          <td><input type="text" class="form-control" maxlength="2"  pattern="0|[1-9]|0[1-9]|1[0-9]|2[0-9]|3[0-9]|4[0-9]|5[0]|Ab" value="" id="termwork" name="termwork[]" placeholder="Term Work marks"required></td></div>
      
    </tr>';


  }
    
 
}


$b='</tbody></table>
  <center><button type="submit" class="btn btn-success" >Save</button></center><br>';

       

            
            
        

        echo "$output$a$b";
        
        }

        }
        




                

       
    }


     function studentOR(Request $request)
    {
         $id = $request->get('select');
        
        $dependent = $request->get('dependent');

        $course = DB::table('courses')->where('id',$id)->get();
        $course_pattern = DB::table('courses')->where('id',$id)->pluck('pattern');
        $course_department = DB::table('courses')->where('id',$id)->pluck('department');
        $course_sem= DB::table('courses')->where('id',$id)->pluck('sem'); 
        $student =DB::table('student')->where('pattern',$course_pattern)->where('sem',$course_sem)->where('department',$course_department)->where('course_id',$id)->get();
        $marksorpr = DB::table('marksorpr')->where('course_id',$id)->get();
        $orpr = DB::table('courses')->where('id',$id)->get()[0]->OR_PR;
        $countorpr = count($marksorpr);

        $isverified = DB::table('marksverified')->where('course_id',$id)->get();
        $countverified = count($isverified);

        if ($countverified > 0) {

          $data1 = $isverified[0]->facultyverified_oral;
          $data2 = "Y";

          if ($data1 === $data2) {

            if ($countorpr > 0 ) {


            $output =  '
       <center><strong><p>Subject:-'.$course[0]->course_name.'</p> </strong>  </center>
         <input type="hidden" name="courseid" value="'.$id.'">
        <table  class="table table-condensed">
    <thead>
    <tr>
          <th>Student Name</th>
          <th>Seat No</th>
          <th>oral & practical ('.$orpr.')</th>
       
       </tr>
  </thead>
  <tbody>';
  $a='';
    for ($i=0; $i <$countorpr ; $i++) {  

      if($orpr == 25)
      {


   
    $a = $a.'<tr>
     <td><input type="hidden" name="student_id[]" value="'.$student[$i]->id.'">'.$student[$i]->name.'</td>
        <td>'.$student[$i]->seatno.'</td>

      <div class="form-group">
          <td><input type="hidden" class="form-control" maxlength="2"  pattern="0|[1-9]|0[1-9]|1[0-9]|2[0-5]|Ab" value="'.$marksorpr[$i]->ORPR.'"id="oralpr" name="oralpr[]" placeholder="oral practical marks"required>'.$marksorpr[$i]->ORPR.'</td></div>
      
    </tr>';
  }
  elseif ($orpr == 50) {
     
    $a = $a.'<tr>
     <td><input type="hidden" name="student_id[]" value="'.$student[$i]->id.'">'.$student[$i]->name.'</td>
        <td>'.$student[$i]->seatno.'</td>

      <div class="form-group">
          <td><input type="hidden" class="form-control" maxlength="2"  pattern="0|[1-9]|0[1-9]|1[0-9]|2[0-9]|3[0-9]|4[0-9]|5[0]|Ab" value="'.$marksorpr[$i]->ORPR.'"id="oralpr" name="oralpr[]" placeholder="oral practical marks"required>'.$marksorpr[$i]->ORPR.'</td></div>
      
    </tr>';
  }
}


$b='</tbody></table>
<p><font color="red"><strong>Note:</strong></font>Marks is Verified Save button is disabled You can only preview the marks</p>
<center></center><br>';

        

           
        

        echo "$output$a$b";
           
        } else {

            $output =  '
       <center><strong><p>Subject:-'.$course[0]->course_name.'</p> </strong>  </center>
         <input type="hidden" name="courseid" value="'.$id.'">
        <table  class="table table-condensed">
    <thead>
    <tr>
          <th>Student Name</th>
          <th>Seat No</th>
          <th>oral & practical ('.$orpr.')</th>
       
       </tr>
  </thead>
  <tbody>';
  $a='';
     foreach ($student as $data) {
   
       if($orpr == 25)
      {


   
    $a = $a.'<tr>
    <td><input type="hidden" name="student_id[]" value="'.$data->id.'">'.$data->name.'</td>
        <td>'.$data->seatno.'</td>

      <div class="form-group">
          <td><input type="text" class="form-control" pattern="0|[1-9]|0[1-9]|1[0-9]|2[0-5]|Ab" value=""id="oralpr" name="oralpr[]" placeholder="oral practical marks"required></td></div>
      
    </tr>';
  }
  elseif ($orpr == 50) {
     
    $a = $a.'<tr>
   <td><input type="hidden" name="student_id[]" value="'.$data->id.'">'.$data->name.'</td>
        <td>'.$data->seatno.'</td>

      <div class="form-group">
          <td><input type="text" class="form-control" maxlength="2"  pattern="0|[1-9]|0[1-9]|1[0-9]|2[0-9]|3[0-9]|4[0-9]|5[0]|Ab" value=""id="oralpr" name="oralpr[]" placeholder="oral practical marks"required></td></div>
      
    </tr>';
  }
}


$b='</tbody></table>
<p><font color="red"><strong>Note:</strong></font>Marks is Verified Save button is disabled You can only preview the marks</p>
<center><button type="submit" class="btn btn-success"disabled >Save</button></center><br>';

        

           
        

        echo "$output$a$b";
           
        }

            
          } else {
            if ($countorpr > 0 ) {


            $output =  '
       <center><strong><p>Subject:-'.$course[0]->course_name.'</p> </strong>  </center>
         <input type="hidden" name="courseid" value="'.$id.'">
        <table  class="table table-condensed">
    <thead>
    <tr>
          <th>Student Name</th>
          <th>Seat No</th>
          <th>oral & practical ('.$orpr.')</th>
       
       </tr>
  </thead>
  <tbody>';
  $a='';
    for ($i=0; $i <$countorpr ; $i++) {  
   
       if($orpr == 25)
      {


   
    $a = $a.'<tr>
     <td><input type="hidden" name="student_id[]" value="'.$student[$i]->id.'">'.$student[$i]->name.'</td>
        <td>'.$student[$i]->seatno.'</td>

      <div class="form-group">
          <td><input type="text" class="form-control" maxlength="2" pattern="0|[1-9]|0[1-9]|1[0-9]|2[0-5]|Ab" value="'.$marksorpr[$i]->ORPR.'"id="oralpr" name="oralpr[]" placeholder="oral practical marks"required></td></div>
      
    </tr>';
  }
  elseif ($orpr == 50) {
     
    $a = $a.'<tr>
     <td><input type="hidden" name="student_id[]" value="'.$student[$i]->id.'">'.$student[$i]->name.'</td>
        <td>'.$student[$i]->seatno.'</td>

      <div class="form-group">
          <td><input type="text" class="form-control" maxlength="2"  pattern="0|[1-9]|0[1-9]|1[0-9]|2[0-9]|3[0-9]|4[0-9]|5[0]|Ab" value="'.$marksorpr[$i]->ORPR.'"id="oralpr" name="oralpr[]" placeholder="oral practical marks"required></td></div>
      
    </tr>';
  }
}


$b='</tbody></table>
<center><button type="submit" class="btn btn-success" >Save</button></center><br>';

        

           
        

        echo "$output$a$b";
           
        } else {

            $output =  '
       <center><strong><p>Subject:-'.$course[0]->course_name.'</p> </strong>  </center>
         <input type="hidden" name="courseid" value="'.$id.'">
        <table  class="table table-condensed">
    <thead>
    <tr>
          <th>Student Name</th>
          <th>Seat No</th>
          <th>oral & practical ('.$orpr.')</th>
       
       </tr>
  </thead>
  <tbody>';
  $a='';
     foreach ($student as $data) {
   
        if($orpr == 25)
      {


   
    $a = $a.'<tr>
   <td><input type="hidden" name="student_id[]" value="'.$data->id.'">'.$data->name.'</td>
        <td>'.$data->seatno.'</td>

      <div class="form-group">
          <td><input type="text" class="form-control" maxlength="2"  pattern="0|[1-9]|0[1-9]|1[0-9]|2[0-5]|Ab" value=""id="oralpr" name="oralpr[]" placeholder="oral practical marks"required></td></div>
      
    </tr>';
  }
  elseif ($orpr == 50) {
     
    $a = $a.'<tr>
   <td><input type="hidden" name="student_id[]" value="'.$data->id.'">'.$data->name.'</td>
        <td>'.$data->seatno.'</td>

      <div class="form-group">
          <td><input type="text" class="form-control" maxlength="2"  pattern="0|[1-9]|0[1-9]|1[0-9]|2[0-9]|3[0-9]|4[0-9]|5[0]|Ab" value=""id="oralpr" name="oralpr[]" placeholder="oral practical marks"required></td></div>
      
    </tr>';
  }
}


$b='</tbody></table>
<center><button type="submit" class="btn btn-success" >Save</button></center><br>';

        

           
        

        echo "$output$a$b";
           
        }
          }
          




}

else
{

        if ($countorpr > 0 ) {


            $output =  '
       <center><strong><p>Subject:-'.$course[0]->course_name.'</p> </strong>  </center>
         <input type="hidden" name="courseid" value="'.$id.'">
        <table  class="table table-condensed">
    <thead>
    <tr>
          <th>Student Name</th>
          <th>Seat No</th>
          <th>oral & practical ('.$orpr.')</th>
       
       </tr>
  </thead>
  <tbody>';
  $a='';
    for ($i=0; $i <$countorpr ; $i++) {  
   
         if($orpr == 25)
      {


   
    $a = $a.'<tr>
     <td><input type="hidden" name="student_id[]" value="'.$student[$i]->id.'">'.$student[$i]->name.'</td>
        <td>'.$student[$i]->seatno.'</td>

      <div class="form-group">
          <td><input type="text" class="form-control" maxlength="2" pattern="0|[1-9]|0[1-9]|1[0-9]|2[0-5]|Ab" value="'.$marksorpr[$i]->ORPR.'"id="oralpr" name="oralpr[]" placeholder="oral practical marks"required></td></div>
      
    </tr>';
  }
  elseif ($orpr == 50) {
     
    $a = $a.'<tr>
     <td><input type="hidden" name="student_id[]" value="'.$student[$i]->id.'">'.$student[$i]->name.'</td>
        <td>'.$student[$i]->seatno.'</td>

      <div class="form-group">
          <td><input type="text" class="form-control" maxlength="2" pattern="0|[1-9]|0[1-9]|1[0-9]|2[0-9]|3[0-9]|4[0-9]|5[0]|Ab" value="'.$marksorpr[$i]->ORPR.'"id="oralpr" name="oralpr[]" placeholder="oral practical marks"required></td></div>
      
    </tr>';
  }
}


$b='</tbody></table>
<center><button type="submit" class="btn btn-success" >Save</button></center><br>';

        

           
        

        echo "$output$a$b";
           
        } else {

            $output =  '
       <center><strong><p>Subject:-'.$course[0]->course_name.'</p> </strong>  </center>
         <input type="hidden" name="courseid" value="'.$id.'">
        <table  class="table table-condensed">
    <thead>
    <tr>
          <th>Student Name</th>
          <th>Seat No</th>
          <th>oral & practical ('.$orpr.')</th>
       
       </tr>
  </thead>
  <tbody>';
  $a='';
     foreach ($student as $data) {
      if($orpr == 25)
      {


   
    $a = $a.'<tr>
     <td><input type="hidden" name="student_id[]" value="'.$data->id.'">'.$data->name.'</td>
        <td>'.$data->seatno.'</td>

      <div class="form-group">
          <td><input type="text" class="form-control" maxlength="2" pattern="0|[1-9]|0[1-9]|1[0-9]|2[0-5]|Ab" value=""id="oralpr" name="oralpr[]" placeholder="oral practical marks"required></td></div>
      
    </tr>';
  }
  elseif ($orpr == 50) {
     
    $a = $a.'<tr>
 		<td><input type="hidden" name="student_id[]" value="'.$data->id.'">'.$data->name.'</td>
        <td>'.$data->seatno.'</td>

      <div class="form-group">
          <td><input type="text" class="form-control" maxlength="2"  pattern="0|[1-9]|0[1-9]|1[0-9]|2[0-9]|3[0-9]|4[0-9]|5[0]|Ab" value=""id="oralpr" name="oralpr[]" placeholder="oral practical marks"required></td></div>
      
    </tr>';
  }
}


$b='</tbody></table>
  <center><button type="submit" class="btn btn-success" >Save</button></center><br>';

        

           
        

        echo "$output$a$b";
           
        }
      }
    }


    




   


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return 123;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $faculty_id = $request->input('faculty');
        $course1 = $request->input('course1');
        $course2 = $request->input('course2');
        $course3 = $request->input('course3');
        $course4 = $request->input('course4');
        $course5 = $request->input('course5');
        $course6 = $request->input('course6');

  
    



        //return $wordCount;
     DB::table('courses')->whereIn('id',[$course1,$course2,$course3,$course4,$course5,$course6])->update( [ 'user_id' => $faculty_id ]);
        return Redirect::back()->with('status','Subject Alloted');

        
        

       

     



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
