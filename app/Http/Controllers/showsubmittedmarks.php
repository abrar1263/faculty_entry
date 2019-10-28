<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\course;
use Crypt;

class showsubmittedmarks extends Controller
{
    public function __construct()
   
     {
        $this->middleware('auth');
     }
    public function hod_showmarks()

    {

   
     


      $semester = DB::table('semester')->get();
    	$pattern = DB::table('pattern')->get();
    	return view('hod.Status',compact('pattern','semester'));

   
    }






      public function status(Request $request)
    {
   
    
       
     $department = Auth::user()->department;

     $pattern = $request->get('select');
     $semester = $request->get('value');
     $dependent =$request->get('dependent');


     $data = DB::table('courses')->where('sem', $semester)->where('department',$department)->where('pattern',$pattern)->get();



   
  $output = '
<center><h5><p>Department =<strong> '.$department.'</strong> Pattern = <strong>'.$pattern.'</strong> and Semester = <strong>'.$semester.'</strong> </p></h4></center>

   <table class="table table-condensed">
    <thead>
      <tr>
        <th>Subject  Name</th>
        <th>Alloted Faculty </th>
        <th>Is Filled</th>
        <th>Is Verify</th>
        <th>Preview marks</th>
      </tr>
    </thead>
    <tbody>';
    $b ='';


    foreach($data as $row)
    {
        
    $iaavailable = (DB::table('courses')->where('id',$row->id)->get()[0])->IA;
    $twavailable = (DB::table('courses')->where('id',$row->id)->get()[0]->TW);
    $oravailable = (DB::table('courses')->where('id',$row->id)->get()[0]->OR_PR);


   
    
   
    $counterverify = 0;
    $counter = 0;

    if ($iaavailable != 0)
    {
        $counter++;
    
        $isfilledia = count(DB::table('marksia')->where('course_id',$row->id)->get());

        if($isfilledia > 0)
         {
            $counter--;

        }
    } 

    if ($twavailable != 0 ) {

     $counter ++;
     $isfilledtw = count(DB::table('markstw')->where('course_id',$row->id)->get());
     if($isfilledtw > 0)
     {  
        $counter--;

     }
    }
    if ($oravailable != 0) {

        $isfilledorpr = count(DB::table('marksorpr')->where('course_id',$row->id)->get());
        $counter++;
        if ($isfilledorpr > 0) {

           $counter--;
        }

        
    }

    if ($iaavailable != 0)
    {
       
        $counterverify++;

       $isverification = count(DB::table('marksverified')->where('course_id',$row->id)->get());

       if($isverification > 0)
       {

        $isverified = DB::table('marksverified')->where('course_id',$row->id)->get()[0]->facultyverified_ia;

        if ($isverified == "Y" ) {

           $counterverify--;
        }

       }
       
    } 


    if ($twavailable != 0)
    {
       
        $counterverify++;

       $isverification = count(DB::table('marksverified')->where('course_id',$row->id)->get());

       if($isverification > 0)
       {

        $isverified = DB::table('marksverified')->where('course_id',$row->id)->get()[0]->facultyverified_tw;

        if ($isverified == "Y" ) {

           $counterverify--;
        }

       }
       
    }

    
    
    if ($oravailable != 0) 

       {
       
        $counterverify++;

       $isverification = count(DB::table('marksverified')->where('course_id',$row->id)->get());

       if($isverification > 0)
       {

        $isverified = DB::table('marksverified')->where('course_id',$row->id)->get()[0]->facultyverified_oral;

        if ($isverified == "Y" ) {

           $counterverify--;
        }

       }
       
    } 


    if($counter == 0 )
    {

        if($counterverify == 0)
        {

         $b=$b.'<tr>
         
        <td>'.$row->course_name.'</td>
        <td>'.(course::find($row->id)->User)->name.'</td>
        <td><span class="glyphicon glyphicon-ok" style="font-size:20px;color:Dodgerblue"</span></td>
        <td><span class="glyphicon glyphicon-ok" style="font-size:20px;color:Dodgerblue"</span></td>
        <td><a href="'.route('hodpreviewmarks',['course_id' => Crypt::encrypt($row->id) ]).'"><span class="fa fa-eye" style="font-size:30px;color:Dodgerblue"></span></a></td>
       
      </tr>';
        

        }
        else
        {

         $b=$b.'<tr>
         
        <td>'.$row->course_name.'</td>
        <td>'.(course::find($row->id)->User)->name.'</td>
        <td><span class="glyphicon glyphicon-ok" style="font-size:20px;color:Dodgerblue"</span></td>
        <td><span class="glyphicon glyphicon-remove" style="font-size:20px;color:Dodgerblue"</span></td>
        <td><span class="fa fa-eye-slash" style="font-size:30px;color:Dodgerblue"></span></td>
      </tr>';
        }


        
    }

    else
    {
          
        if($counterverify == 0)
        {

           $b=$b.'<tr>
         
        <td>'.$row->course_name.'</td>
        <td>'.(course::find($row->id)->User)->name.'</td>
        <td><span class="glyphicon glyphicon-remove" style="font-size:20px;color:Dodgerblue"</span></td>
        <td><span class="glyphicon glyphicon-ok" style="font-size:20px;color:Dodgerblue"</span></td>
        <td<span class="fa fa-eye-slash" style="font-size:30px;color:Dodgerblue"></span></td>
      </tr>';
  }
      else
      {
           $b=$b.'<tr>
         
        <td>'.$row->course_name.'</td>
        <td>'.(course::find($row->id)->User)->name.'</td>
        <td><span class="glyphicon glyphicon-remove" style="font-size:20px;color:Dodgerblue"</span></td>
        <td><span class="glyphicon glyphicon-remove" style="font-size:20px;color:Dodgerblue"</span></td>
        <td><span class="fa fa-eye-slash" style="font-size:30px;color:Dodgerblue"></span></td>
      </tr>';
    }


        }

}
   
    
    $c='</tbody>
  </table>';

   
    echo "$output$b$c";
    


  }

  public function adminshowmarks()
  {
  $semester = DB::table('semester')->get();
      $pattern = DB::table('pattern')->get();
  return view('adminarea.showmarks',compact('pattern','semester'));
  }

  public function admin_studentstatus(Request $request)
  {
  
  $pattern = $request->get('pattern');
  $semester = $request->get('semester');
  $department = $request->get('department');
  
  $data = DB::table('courses')->where('pattern',$pattern)->where('sem',$semester)->where('department',$department)->get();
     


      $output ='


      
      <center><h5><p>Department =<strong> '.$department.'</strong> Pattern = <strong>'.$pattern.'</strong> and Semester = <strong>'.$semester.'</strong> </p></h4></center>
      <table class="table table-condensed">
    <thead>
      <tr>
        <th>Subject  Name</th>
        <th>Alloted Faculty </th>
        <th>Faculty Verify</th>
        <th>Hod Verify</th>
        <th>Excel Sheet</th>
      </tr>
    </thead>
    <tbody>';

  
   $b='';

   

    foreach($data as $row)
    {


    $iaavailable = (DB::table('courses')->where('id',$row->id)->get()[0])->IA;
    $twavailable = (DB::table('courses')->where('id',$row->id)->get()[0]->TW);
    $oralvailable = (DB::table('courses')->where('id',$row->id)->get()[0]->OR_PR);
      
    $counterfaculty = 0;
    $counterhod = 0;



      if ($iaavailable != 0)
      {
       
        $counterfaculty++;

       $isverification = count(DB::table('marksverified')->where('course_id',$row->id)->get());

       if($isverification > 0)
       {

        $isverified = DB::table('marksverified')->where('course_id',$row->id)->get()[0]->facultyverified_ia;

        if ($isverified == "Y" ) {

           $counterfaculty--;
        }

       }
       
    } 

    
    
    if ($twavailable != 0) 

       {
       
        $counterfaculty++;

       $isverification = count(DB::table('marksverified')->where('course_id',$row->id)->get());

       if($isverification > 0)
       {

        $isverified = DB::table('marksverified')->where('course_id',$row->id)->get()[0]->facultyverified_tw;

        if ($isverified == "Y" ) {

           $counterfaculty--;
        }

       }
       
    }

    if ($oralvailable != 0) 

       {
       
        $counterfaculty++;

       $isverification = count(DB::table('marksverified')->where('course_id',$row->id)->get());

       if($isverification > 0)
       {

        $isverified = DB::table('marksverified')->where('course_id',$row->id)->get()[0]->facultyverified_oral;

        if ($isverified == "Y" ) {

           $counterfaculty--;
        }

       }
       
    }



    if ($iaavailable != 0) 

       {
       
        $counterhod++;

       $isverification = count(DB::table('marksverified')->where('course_id',$row->id)->get());

       if($isverification > 0)
       {

        $isverified = DB::table('marksverified')->where('course_id',$row->id)->get()[0]->hod_verified;

        if ($isverified == "Y" ) {

           $counterhod--;
        }

       }
       
    }

if ($twavailable != 0) 

       {
       
        $counterhod++;

       $isverification = count(DB::table('marksverified')->where('course_id',$row->id)->get());

       if($isverification > 0)
       {

        $isverified = DB::table('marksverified')->where('course_id',$row->id)->get()[0]->hod_verified;

        if ($isverified == "Y" ) {

           $counterhod--;
        }

       }
       
    }



    if ($oralvailable != 0) 

       {
       
        $counterhod++;

       $isverification = count(DB::table('marksverified')->where('course_id',$row->id)->get());

       if($isverification > 0)
       {

        $isverified = DB::table('marksverified')->where('course_id',$row->id)->get()[0]->hod_verified;

        if ($isverified == "Y" ) {

           $counterhod--;
        }

       }
       
    }




    if ($counterfaculty == 0) {

      if ($counterhod == 0) {
        
        $b = $b.'

        <input type="hidden" name="courseid" id="courseid" value="'.$row->id.'">
        <tr>
        <td>'.$row->course_name.'</td>
        <td>'.(course::find($row->id)->User)->name.'</td>
        <td><span class="glyphicon glyphicon-ok" style="font-size:20px;color:Dodgerblue"</span></td>
        <td><span class="glyphicon glyphicon-ok" style="font-size:20px;color:Dodgerblue"</span></td>
        <td><a href="'.route('exportexcel',['course_id' => Crypt::encrypt($row->id)]).'"><span class="fa fa-file-excel-o" style="font-size:30px;color:Dodgerblue"></span></a></td>
       
      </tr>';


      }

      else{

        $b = $b.'
        
        <td>'.$row->course_name.'</td>
        <td>'.(course::find($row->id)->User)->name.'</td>
        <td><span class="glyphicon glyphicon-ok" style="font-size:20px;color:Dodgerblue"</span></td>
        <td><span class="glyphicon glyphicon-remove" style="font-size:20px;color:Dodgerblue"</span></td>
        <td><span class="glyphicon glyphicon-ban-circle"style="font-size:30px;color:Dodgerblue"> </span></td>
       
      </tr>';



      }


      
    }

    else{

      if ($counterhod == 0) {

        $b = $b.'
        
        <td>'.$row->course_name.'</td>
        <td>'.(course::find($row->id)->User)->name.'</td>
        <td><span class="glyphicon glyphicon-remove" style="font-size:20px;color:Dodgerblue"</span></td>
        <td><span class="glyphicon glyphicon-ok" style="font-size:20px;color:Dodgerblue"</span></td>
        <td><span class="glyphicon glyphicon-ban-circle"style="font-size:30px;color:Dodgerblue"> </span></td>
       
      </tr>';
        
      }

      else
      {
        $b = $b.'
        <tr>
        <td>'.$row->course_name.'</td>
        <td>'.(course::find($row->id)->User)->name.'</td>
        <td><span class="glyphicon glyphicon-remove" style="font-size:20px;color:Dodgerblue"</span></td>
        <td><span class="glyphicon glyphicon-remove" style="font-size:20px;color:Dodgerblue"</span></td>
        <td><span class="glyphicon glyphicon-ban-circle"style="font-size:30px;color:Dodgerblue"> </span> </td>
       
      </tr>';
      }




    }





     


    }

    $c='</tbody>
  </table>';

    echo "$output$b$c";





  }




  }




    




