<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use Session;
use Alert;

class marksIA extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

     $v = Validator::make($request->all(), [

        'test1' => 'required|array|between:0,20',
        'test2' => 'required|array|between:0,20',
    ]);

    if ($v->fails())
    {
        return redirect()->back()->withErrors($v->errors());
    }
      

        $courseid = $request->get('courseid');
        $studentid = $request->get('student_id');

        $test1 = $request->get('test1');
        $test2 = $request->get('test2');

       $coursedata = count(DB::table('marksia')->where('course_id',$courseid)->pluck('course_id'));

       



      if($coursedata > 0)
       {

        for ($i = 0; $i < count($studentid); $i++) {


        

        DB::table('marksia')->where('course_id',$courseid)->where('student_id',$studentid[$i])->update(['Test1'=>$test1[$i],'Test2'=>$test2[$i]]);
          


       }
       Alert::success('Success ', 'Marks Updated!');
       return redirect('home');
   }


        else{
            for ($i = 0; $i < count($studentid); $i++) {
        

        DB::table('marksia')->insert(['course_id' => $courseid, 'student_id' => $studentid[$i], 'Test1'=>$test1[$i],'Test2'=>$test2[$i]]);
          
        
              
              }
              Alert::success('Success', 'Marks Inserted!');
              return redirect('home');
        

    }
}

public function marksiaverification(Request $request)
{


        $id = $request->get('select');

          
        
        
        
        $dependent = $request->get('dependent');

        $course = DB::table('courses')->where('id',$id)->get()[0]->course_name;
        $course_pattern = DB::table('courses')->where('id',$id)->pluck('pattern');
        $course_department = DB::table('courses')->where('id',$id)->pluck('department');
        $course_sem= DB::table('courses')->where('id',$id)->pluck('sem'); 
        $student =DB::table('student')->where('pattern',$course_pattern)->where('sem',$course_sem)->where('department',$course_department)->get();

        $marksia = DB::table('marksia')->where('course_id',$id)->get();
        


        $countia = count($marksia);
        


        if ($countia > 0) {

           $output = '
            <center><strong><p>Subject: '.$course.'</p> </strong>  </center> 

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

        if($roundavg[$i] < 8)
        {


        $b=$b.'<tr>
        <td><input type="hidden" name="student_id[]" value="'.$student[$i]->name.'"><font color="red">'.$student[$i]->name.'</font></td>
        <td><input type="hidden" name="seatno[]" value="'.$student[$i]->seatno.'">'.$student[$i]->seatno.'</td>

        
        <div class="form-group">
            <td><input type="hidden"  class="form-control" name="test1[]"  value="'.$marksia[$i]->Test1.'">'.$marksia[$i]->Test1.'</td></div>

            <div class="form-group">
        <td><input type="hidden" class="form-control" value="'.$marksia[$i]->Test2.'" name="test2[]">'.$marksia[$i]->Test2.'</td></div>

            <div class="form-group">
          <td><input type="hidden" class="form-control"  id="avg" value="'.$roundavg[$i].'" name="avg[]"><font color="red">'.$roundavg[$i].'</font></td></div>
         
          </tr>';

}
else{

     $b=$b.'<tr>
        <td><input type="hidden" name="student_id[]" value="'.$student[$i]->name.'"><font color="green">'.$student[$i]->name.'</td>
        <td><input type="hidden" name="seatno[]" value="'.$student[$i]->seatno.'">'.$student[$i]->seatno.'</td>

        
        <div class="form-group">
            <td><input type="hidden"  class="form-control" name="test1[]"  value="'.$marksia[$i]->Test1.'">'.$marksia[$i]->Test1.'</td></div>

            <div class="form-group">
        <td><input type="hidden" class="form-control" value="'.$marksia[$i]->Test2.'" name="test2[]">'.$marksia[$i]->Test2.'</td></div>

            <div class="form-group">
          <td><input type="hidden" class="form-control" id="avg" value="'.$roundavg[$i].'" name="avg[]">'.$roundavg[$i].'</td></div>
         
          </tr>';


}
      }

$c='</tbody></table>

<center><button type="submit" id="verify" class="btn btn-sucess verify" >Verify</button></center><br>';

          echo "$output$b$c";
       



        } else {
           
        
        


        $output = '
            <center><strong><p>Subject: '.$course.'</p> </strong>  </center> 

            <input type="hidden" name="courseid" value="'.$id.';">
         <table  class="table table-condensed">
           <p><font color="red"><strong>Note:</strong></font>There is No Student Details Contact Your head of Department</p>';


          

          echo "$output";



      }
    
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
