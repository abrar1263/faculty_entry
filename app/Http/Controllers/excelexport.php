<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Crypt;
use DB;
use Excel;

class excelexport extends Controller
{
    public function index($course_id)

    {

    	$course_id = Crypt::decrypt($course_id); 

    	$course_name = DB::table('courses')->where('id',$course_id)->get()[0]->course_name;


    	$course_ESE = DB::table('courses')->where('id',$course_id)->get()[0]->ESE;

    	$course_IA = DB::table('courses')->where('id',$course_id)->get()[0]->IA;

    	$course_ORPR = DB::table('courses')->where('id',$course_id)->get()[0]->OR_PR;

    	$course_TW = DB::table('courses')->where('id',$course_id)->get()[0]->TW;

    	$studentdata = DB::table('student')->where('course_id',$course_id)->get()->toArray();
    	$countstudent = count($studentdata);



    	

    	$ese = 0;
    	$ia = 0;
    	$pr_or = 0;
    	$tw = 0;

    	
    	if($course_ESE != 0)
    	{	
    		$ese++; 
    	}

    	if($course_IA != 0)
    	{
    		$ia++;

    	}

    	if($course_ORPR != 0)
    	{
    		$pr_or++;

    	}

    	if($course_TW != 0)
    	{
    		$tw++;

    	}


        


       // pror

            if($pr_or != 0 and $ese == 0)
        {
            if($ia == 0 and $tw == 0)
            {
                
               $marksorpr = DB::table('marksorpr')->where('course_id',$course_id)->get();
              


                $student_Array[] = array('SR NO.','STUDENT ID','NAME OF THE CANDIDATE', 'EXAM SEAT NO.','PR OR ('.$course_ORPR.')');

                for ($i=0; $i <$countstudent ; $i++) { 

                    $student_Array[] = array(

                        'SR NO.' => $i+1,
                        'STUDENT ID' =>$studentdata[$i]->students_id,
                        'NAME OF THE CANDIDATE' => $studentdata[$i]->name,
                        'EXAM SEAT NO.'   => $studentdata[$i]->seatno,
                       
                        'OR PR'        =>$marksorpr[$i]->ORPR

                    );
                    
                }



                    Excel::create($course_name, function($excel) use ($student_Array){

                        
                        $excel->sheet('student details', function($sheet) use ($student_Array){
                        $sheet->fromArray($student_Array, null,'A1',false,false);

                        });


                    })->download('xlsx');
                    return \Redirect::back()->withSuccess( 'Message you want show in View' );


                
            }
        }



        // for Tw

        if($pr_or == 0 and $ese == 0)
        {
            if($ia == 0 and $tw !=0)
            {
                
                $markstw = DB::table('markstw')->where('course_id',$course_id)->get();

              


                $student_Array[] = array('SR NO.','STUDENT ID','NAME OF THE CANDIDATE', 'EXAM SEAT NO.','TW ('.$course_TW.')');

                for ($i=0; $i <$countstudent ; $i++) { 

                    $student_Array[] = array(

                        'SR NO.'                => $i+1,
                        'STUDENT ID'            =>$studentdata[$i]->students_id,
                        'NAME OF THE CANDIDATE' => $studentdata[$i]->name,
                        'EXAM SEAT NO.'   => $studentdata[$i]->seatno,
                        'TW'              =>$markstw[$i]->TW

                    );
                    
                }



                    Excel::create($course_name, function($excel) use ($student_Array){

                        
                        $excel->sheet('student details', function($sheet) use ($student_Array){
                        $sheet->fromArray($student_Array, null,'A1',false,false);

                        });


                    })->download('xlsx');
                    return \Redirect::back()->withSuccess( 'Message you want show in View' );


                
            }
        }










    	// for ese and ia

    	if($pr_or == 0 and $tw == 0)
    	{
    		if($ese != 0 and $ia != 0)
    		{
    			$marksia = DB::table('marksia')->where('course_id',$course_id)->get();
    			$countia = count(DB::table('marksia')->where('course_id',$course_id)->get());

    				for ($i=0; $i < $countia ; $i++) { 
					 $average[] = collect([$marksia[$i]->Test1,$marksia[$i]->Test2])->avg();
        			 $roundavg[] = round($average[$i]);
				}
    			


    			$student_Array[] = array('SR NO.','STUDENT ID','NAME OF THE CANDIDATE',	'EXAM SEAT NO.','ESE ('.$course_ESE.')','IA ('.$course_IA.')');

    			for ($i=0; $i <$countstudent ; $i++) { 

    				$student_Array[] = array(

    					'SR NO.' => $i+1,
    					'STUDENT ID' =>$studentdata[$i]->students_id,
    					'NAME OF THE CANDIDATE' => $studentdata[$i]->name,
    					'EXAM SEAT NO.'   => $studentdata[$i]->seatno,
    					'ESE'       =>null,
    					'IA '      => $roundavg[$i],
    					
    				);
    				
    			}



    				Excel::create($course_name, function($excel) use ($student_Array){

    					
    					$excel->sheet('student details', function($sheet) use ($student_Array){
    					$sheet->fromArray($student_Array, null,'A1',false,false);

    					});


    				})->download('xlsx');
                

    		}
    	}

    	// for PR_OR and TW

    	if($ese === 0 and $ia === 0)
    	{
    		if($pr_or != 0 and $tw != 0)
    		{
    			$marksorpr = DB::table('marksorpr')->where('course_id',$course_id)->get();
    			$markstw = DB::table('markstw')->where('course_id',$course_id)->get();
                $counttw = count($markstw);


					$student_Array[] = array('SR NO.','STUDENT ID','NAME OF THE CANDIDATE',	'EXAM SEAT NO.','PR OR ('.$course_ORPR.')','TW ('.$course_TW.')');

    			for ($i=0; $i <$counttw ; $i++) { 

    				$student_Array[] = array(

    					'SR NO.' => $i+1,
    					'STUDENT ID' =>$studentdata[$i]->students_id,
    					'NAME OF THE CANDIDATE' => $studentdata[$i]->name,
    					'EXAM SEAT NO.'   => $studentdata[$i]->seatno,
    					'PR OR'		=>$marksorpr[$i]->ORPR,
    					'TW'        =>$markstw[$i]->TW

    				);
    				
    			}



    				Excel::create($course_name, function($excel) use ($student_Array){

    					
    					$excel->sheet('sheet1', function($sheet) use ($student_Array){
    					$sheet->fromArray($student_Array, null,'A1',false,false);

    					});


    				})->download('xlsx');
                    //return \Redirect::back()->withSuccess( 'Message you want show in View' );


    			
    		}
    	}


   











		// for ESE, IA and TW
    	if($pr_or === 0 and $ese != 0)
    	{
    		if($ia != 0 and $tw !=0)
    		{
    			$marksia = DB::table('marksia')->where('course_id',$course_id)->get();
    			$countia = count(DB::table('marksia')->where('course_id',$course_id)->get());
    			$markstw = DB::table('markstw')->where('course_id',$course_id)->get();

    			for ($i=0; $i < $countia ; $i++) { 
					 $average[] = collect([$marksia[$i]->Test1,$marksia[$i]->Test2])->avg();
        			 $roundavg[] = round($average[$i]);
				}


				$student_Array[] = array('SR NO.','STUDENT ID','NAME OF THE CANDIDATE',	'EXAM SEAT NO.','ESE ('.$course_ESE.')','IA ('.$course_IA.')','TW ('.$course_TW.')');

    			for ($i=0; $i <$countstudent ; $i++) { 

    				$student_Array[] = array(

    					'SR NO.' => $i+1,
    					'STUDENT ID' =>$studentdata[$i]->students_id,
    					'NAME OF THE CANDIDATE' => $studentdata[$i]->name,
    					'EXAM SEAT NO.'   => $studentdata[$i]->seatno,
    					'ESE'       =>null,
    					'IA '      => $roundavg[$i],
    					'TW'        =>$markstw[$i]->TW

    				);
    				
    			}



    				Excel::create($course_name, function($excel) use ($student_Array){

    					
    					$excel->sheet('student details', function($sheet) use ($student_Array){
    					$sheet->fromArray($student_Array, null,'A1',false,false);

    					});


    				})->download('xlsx');
                    return \Redirect::back()->withSuccess( 'Message you want show in View' );


    			
    		}
    	}

        // for ESE , IA and PR_or

        if($ese != 0 and $ia != 0)
        {
            if($pr_or !=0 and $tw == 0)
            {   
                $marksia = DB::table('marksia')->where('course_id',$course_id)->get()->toArray();
                $countia = count(DB::table('marksia')->where('course_id',$course_id)->get());
                $marksorpr = DB::table('marksorpr')->where('course_id',$course_id)->get()->toArray();
                $markstw = DB::table('markstw')->where('course_id',$course_id)->get()->toArray();

                for ($i=0; $i < $countia ; $i++) { 
                     $average[] = collect([$marksia[$i]->Test1,$marksia[$i]->Test2])->avg();
                    $roundavg[] = round($average[$i]);
                }

                

                $student_Array[] = array('SR NO.','STUDENT ID','NAME OF THE CANDIDATE', 'EXAM SEAT NO.','ESE ('.$course_ESE.')','IA ('.$course_IA.')','PR OR ('.$course_ORPR.')');

                for ($i=0; $i <$countstudent ; $i++) { 

                    $student_Array[] = array(

                        'SR NO.' => $i+1,
                        'STUDENT ID' =>$studentdata[$i]->students_id,
                        'NAME OF THE CANDIDATE' => $studentdata[$i]->name,
                        'EXAM SEAT NO.'   => $studentdata[$i]->seatno,
                        'ESE'       =>null,
                        'IA '      => $roundavg[$i],
                        'PR OR'     =>$marksorpr[$i]->ORPR,
                        
                    );
                    
                }



                    Excel::create($course_name, function($excel) use ($student_Array){

                        
                        $excel->sheet('student details', function($sheet) use ($student_Array){
                        $sheet->fromArray($student_Array, null,'A1',false,false);

                        });


                    })->download('xlsx');
                    return \Redirect::back()->withSuccess( 'Message you want show in View' );



            }
        }







    	// for ESE , IA , PR_OR , and TW

    	if($ese != 0 and $ia != 0)
    	{
    		if($pr_or !=0 and $tw != 0)
    		{	
    			$marksia = DB::table('marksia')->where('course_id',$course_id)->get()->toArray();
    			$countia = count(DB::table('marksia')->where('course_id',$course_id)->get());
    			$marksorpr = DB::table('marksorpr')->where('course_id',$course_id)->get()->toArray();
				$markstw = DB::table('markstw')->where('course_id',$course_id)->get()->toArray();

				for ($i=0; $i < $countia ; $i++) { 
					 $average[] = collect([$marksia[$i]->Test1,$marksia[$i]->Test2])->avg();
        			$roundavg[] = round($average[$i]);
				}

    			

    			$student_Array[] = array('SR NO.','STUDENT ID','NAME OF THE CANDIDATE',	'EXAM SEAT NO.','ESE ('.$course_ESE.')','IA ('.$course_IA.')','PR OR ('.$course_ORPR.')','TW ('.$course_TW.')');

    			for ($i=0; $i <$countstudent ; $i++) { 

    				$student_Array[] = array(

    					'SR NO.' => $i+1,
    					'STUDENT ID' =>$studentdata[$i]->students_id,
    					'NAME OF THE CANDIDATE' => $studentdata[$i]->name,
    					'EXAM SEAT NO.'   => $studentdata[$i]->seatno,
    					'ESE'       =>null,
    					'IA '      => $roundavg[$i],
    					'PR OR'		=>$marksorpr[$i]->ORPR,
    					'TW'        =>$markstw[$i]->TW

    				);
    				
    			}



    				Excel::create($course_name, function($excel) use ($student_Array){

    					
    					$excel->sheet('student details', function($sheet) use ($student_Array){
    					$sheet->fromArray($student_Array, null,'A1',false,false);

    					});


    				})->download('xlsx');
                    return \Redirect::back()->withSuccess( 'Message you want show in View' );



    		}
    	}




    	






    	
    	
 

  }

  
}
