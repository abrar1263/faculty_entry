<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\user;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        
         
         $id = Auth::user()->id;
         $userdesignation = Auth::user()->designation;
         $user = DB::table('users')->where('id',$id)->get();
         
        

        if($userdesignation == 'Admin')
        {
            return view('Adminarea.adminhome',compact('user'));
        }
        elseif ($userdesignation == 'HOD') {
                
            return view('hod.hodhome',compact('user'));         
             



             }

               
            
        
        else
        {

           $courses = user::find($id)->course;
           
            $abc =str_word_count($courses);
                if($abc > 0)
                {   
                    return view('faculty.facultyhome',compact('courses'));
                }
                else
                {

                   return view('faculty.facultynotallored');
                }

        

            
            
            } 
            


          

        }
        
         

  

    }

