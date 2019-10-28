<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Alert;

class marksTW extends Controller
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

        $courseid = $request->get('courseid');
        $studentid = $request->get('student_id');

        $termwork = $request->get('termwork');
       

       $coursedata = count(DB::table('markstw')->where('course_id',$courseid)->pluck('course_id'));
       if($coursedata >0)
       {

        for ($i = 0; $i < count($studentid); $i++) {
        

        DB::table('markstw')->where('course_id',$courseid)->where('student_id',$studentid[$i])->update(['TW'=>$termwork[$i]]);
        


       }
       Alert::success('Success', 'Marks Updated!');
        return redirect('home');
   }


        else{

            for ($i = 0; $i < count($studentid); $i++)
                 {
        

        DB::table('markstw')->insert(['course_id' => $courseid, 'student_id' => $studentid[$i], 'TW'=>$termwork[$i]]);

                }
                Alert::success('Success', 'Marks Inserted!');
              return redirect('home');

             }
        
    }


    public function markstwverification(Request $request)
{


        $id = $request->get('select');

   
          
        
        
        
        $dependent = $request->get('dependent');

        $course = DB::table('courses')->where('id',$id)->get()[0]->course_name;
        $course_pattern = DB::table('courses')->where('id',$id)->pluck('pattern');
        $course_department = DB::table('courses')->where('id',$id)->pluck('department');
        $course_sem= DB::table('courses')->where('id',$id)->pluck('sem'); 
        $student =DB::table('student')->where('pattern',$course_pattern)->where('sem',$course_sem)->where('department',$course_department)->get();

        
        $markstw = DB::table('markstw')->where('course_id',$id)->get();


        
        $counttw = count($markstw);


        if ($counttw > 0) {

           $output = '
            <center><strong><p>Subject: '.$course.'</p> </strong>  </center> 

            <input type="hidden" name="courseid" value="'.$id.'">
         <table  class="table table-condensed">
    <thead>
    <tr>
          <th>Student Name</th>
          <th>Seat No</th>
        
          <th>TW(25)</th>
       </tr>
  </thead><tbody>';

        $b='';
      for ($i=0; $i <$counttw ; $i++) { 
       

        $b=$b.'<tr>
        <td><input type="hidden" name="student_id[]" value="'.$student[$i]->name.'">'.$student[$i]->name.'</td>
        <td><input type="hidden" name="seatno[]" value="'.$student[$i]->seatno.'">'.$student[$i]->seatno.'</td>

        
       
          <div class="form-group">
          <td><input type="hidden" class="form-control" id="termwork" value="'.$markstw[$i]->TW.'" name="termwork[]">'.$markstw[$i]->TW.'</td></div>
          </tr>';

      }

$c='</tbody></table>
<center><button type="submit" id="verify" class="btn btn-sucess" >Verify</button></center><br>';

          echo "$output$b$c";
       



        } else {
           
        
        


        $output = '
            <center><strong><p>Subject: '.$course.'</p> </strong>  </center> 

            <input type="hidden" name="courseid" value="'.$id.';">
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
