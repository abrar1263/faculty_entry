<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Crypt;
use DB;
use Alert;

class hodpreviewmarks extends Controller
{
    
	public function index($course_id)
	{


		$course_id = Crypt::decrypt($course_id);

		$course_name = DB::table('courses')->where('id',$course_id)->get()[0]->course_name;
		 $ia = DB::table('courses')->where('id',$course_id)->get()[0]->IA;
		 $tw = DB::table('courses')->where('id',$course_id)->get()[0]->TW;
		 $orpr = DB::table('courses')->where('id',$course_id)->get()[0]->OR_PR;

	

		 $studentdata = DB::table('student')->where('course_id',$course_id)->get();

		

		 

		 /// for ia 
		if($tw === 0 and $orpr ===0)
		{
			if($ia != 0)
			{
				$marksia = DB::table('marksia')->where('course_id',$course_id)->get();
    			$countia = count(DB::table('marksia')->where('course_id',$course_id)->get());

    				for ($i=0; $i < $countia ; $i++) { 
					 $average[] = collect([$marksia[$i]->Test1,$marksia[$i]->Test2])->avg();
        			 $roundavg[] = round($average[$i]);
        			}
        			return view('hod.previewmarks.preview_ia',compact('ia','course_name','studentdata','marksia','roundavg','course_id'));
		} 
	}

		// for tw

		if($tw != 0 and $orpr === 0)
		{
			if($ia === 0)
			{


    			$markstw = DB::table('markstw')->where('course_id',$course_id)->get();
				return view('hod.previewmarks.preview_tw',compact('tw','course_name','studentdata','markstw','course_id'));
			}
		} 

		// for orpr
			if($tw === 0 and $orpr != 0)
		{
			if($ia === 0)
			{
				$marksorpr = DB::table('marksorpr')->where('course_id',$course_id)->get();
				return view('hod.previewmarks.preview_orpr',compact('orpr','course_name','studentdata','marksorpr','course_id'));
			}
		} 

		// for iatw
		if($tw != 0 and $orpr ===0)
		{
			if($ia != 0)
			{
				$markstw = DB::table('markstw')->where('course_id',$course_id)->get();
				$marksia = DB::table('marksia')->where('course_id',$course_id)->get();
    			$countia = count(DB::table('marksia')->where('course_id',$course_id)->get());

    				for ($i=0; $i < $countia ; $i++) { 
					 $average[] = collect([$marksia[$i]->Test1,$marksia[$i]->Test2])->avg();
        			 $roundavg[] = round($average[$i]);
        			}

				return view('hod.previewmarks.preview_iatw',compact('ia','tw','course_name','studentdata','marksia','roundavg','markstw','course_id'));
			
		} 
	}

		// for iaorpr
			if($tw === 0 and $orpr != 0)
		{
			if($ia != 0)
			{
				$marksorpr = DB::table('marksorpr')->where('course_id',$course_id)->get();
				$marksia = DB::table('marksia')->where('course_id',$course_id)->get();
    			$countia = count(DB::table('marksia')->where('course_id',$course_id)->get());

    				for ($i=0; $i < $countia ; $i++) { 
					 $average[] = collect([$marksia[$i]->Test1,$marksia[$i]->Test2])->avg();
        			 $roundavg[] = round($average[$i]);
        			}

				return view('hod.previewmarks.preview_iaorpr',compact('ia','orpr','course_name','studentdata','marksia','roundavg','marksorpr','course_id'));
			}
		} 

		// for tworpr

			if($tw != 0 and $orpr !=0 )
				{
					if($ia === 0)
						{
							$markstw = DB::table('markstw')->where('course_id',$course_id)->get();
							$marksorpr = DB::table('marksorpr')->where('course_id',$course_id)->get();
							$counttw = count($markstw);
							return view('hod.previewmarks.preview_tworpr',compact('tw','orpr','course_name','studentdata','markstw','marksorpr','course_id','counttw'));
						}		
				}


		// for ia tw orpr

		 if($tw != 0 and $orpr !=0 )
				{
					if($ia != 0)
						{


							$markstw = DB::table('markstw')->where('course_id',$course_id)->get();
							$marksorpr = DB::table('marksorpr')->where('course_id',$course_id)->get();
							$counttw = count($markstw);

							$marksia = DB::table('marksia')->where('course_id',$course_id)->get();
    						$countia = count(DB::table('marksia')->where('course_id',$course_id)->get());

    							for ($i=0; $i < $countia ; $i++) { 
							 $average[] = collect([$marksia[$i]->Test1,$marksia[$i]->Test2])->avg();
        						 $roundavg[] = round($average[$i]);
        			}
							return view('hod.previewmarks.preview_iatworpr',compact('ia','tw','orpr','course_name','studentdata','markstw','marksorpr','marksia','roundavg','course_id','counttw',''));
						}		
				}






	}

	public function marksverify(Request $Request)
	{
		$course_id = $Request->get('course_id');

		$isverified = DB::table('marksverified')->where('course_id',$course_id)->get();
		

		DB::table('marksverified')->where('course_id',$course_id)->update(['hod_verified'=> "Y"]);
		Alert::success('success','Marks Verified');
		return redirect('home/showsubmittedmarks'); 


	}



	public function reedit(Request $Request)
	{
		$course_id = $Request->get('course_id');

		DB::table('marksverified')->where('course_id',$course_id)->update(['facultyverified_ia' => "N",'facultyverified_tw' => "N", 'facultyverified_oral' => "N", 'hod_verified' => "N"]);
		Alert::success('Success ', 'Marks Edited faculty can edit this marks');
       	return redirect('home/showsubmittedmarks');
	}


}


