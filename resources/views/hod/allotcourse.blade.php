@extends('layout.hodapp')

@section('body')



<div class="container">
  <div class="col-xs-12 " >
    <div class="panel panel-primary">
      <div class="panel-heading">
        <div class="container">
          <h2>Course Alloting</h2>
        </div>
      </div><br>

      <div class="container">
 <div class="col-md-11 " >
 

  <table class="table table-condensed">
    <thead>
      <tr>
        <th>Faculty Name</th>
       <th>Allocate Subjects</th>
       <th>Details</th>
      </tr>
    </thead>
    <tbody>
      <tr>
         @foreach ($user as $user2)

        <td>{{$user2->name}}</td>
         
        
        <td>
          {{--<button class="btn-primary id01" onclick="document.getElementById('id01').style.display='block'" data-dependent="id01">click me to edit</button>--}}

          <span style="font-size: 25px; color: Dodgerblue;"><a class="glyphicon glyphicon-plus-sign id01" onclick="course_list({{$user2->id}},'faculty')"></a></span>

      </td>
      <td> <span style="font-size: 25px; color: Dodgerblue;"><a class="glyphicon glyphicon-eye-open  details" onclick="details({{$user2->id}},'details')"></a></span></td>
      </tr>

   
    @endforeach
    </tbody>
  </table>


   


    




</div>
</div>
</div>
</div>
</div>


<div id="id01" class="modal">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <div class="container">
        </div>
       <div class="container">
 <div class="col-md-11 " >




  <form action="allotcourse" method="POST" class="modal-content animate">
        {{csrf_field()}}
        <div id="faculty">
          <input type="hidden" name="faculty"  value="">
        </div>
                 
  <table  class="table table-condensed">
    <thead>
    <tr>
          
          <th></th>
          
        
       </tr>
  </thead>
  <tbody>   
   
       <tr>
        
       
        


        <td><select name="sem1" id="sem" class="input-lg dynamic1" data-dependent="course1">
       <option value="">Select Semester</option>
      @foreach($semester_list as $sem)
      <option value="{{ $sem->sem}}">{{ $sem->sem }}</option>
      @endforeach
       </select>
       <div class="form-group">
    <select name="course1" id="course1" class="form-control input-lg ">
     <option value="">Select Course</option>
    </select>
   </div> 

   <div><br></div>

        <select name="sem2" id="sem" class=" input-lg dynamic2" data-dependent="course2">
           <option value="">Select Semester</option>
            @foreach($semester_list as $sem)
           <option value="{{ $sem->sem}}">{{ $sem->sem }}</option>
            @endforeach
        </select>
         <div class="form-group">
    <select name="course2" id="course2" class="form-control input-lg ">
     <option value="">Select Course</option>
    </select>
   </div> 
</td>



  <td><select name="sem3" id="sem" class="input-lg dynamic3" data-dependent="course3">
       <option value="">Select Semester</option>
      @foreach($semester_list as $sem)
      <option value="{{ $sem->sem}}">{{ $sem->sem }}</option>
      @endforeach
       </select>
       <div class="form-group">
    <select name="course3" id="course3" class="form-control input-lg ">
     <option value="">Select Course</option>
    </select>
   </div> 

   <div><br></div>

        <select name="sem4" id="sem" class=" input-lg dynamic4" data-dependent="course4">
           <option value="">Select Semester</option>
            @foreach($semester_list as $sem)
           <option value="{{ $sem->sem}}">{{ $sem->sem }}</option>
            @endforeach
        </select>
         <div class="form-group">
    <select name="course4" id="course4" class="form-control input-lg ">
     <option value="">Select Course</option>
    </select>
   </div> 
</td>



<td><select name="sem5" id="sem" class="input-lg dynamic5" data-dependent="course5">
       <option value="">Select Semester</option>
      @foreach($semester_list as $sem)
      <option value="{{ $sem->sem}}">{{ $sem->sem }}</option>
      @endforeach
       </select>
       <div class="form-group">
    <select name="course5" id="course5" class="form-control input-lg ">
     <option value="">Select Course</option>
    </select>
   </div> 

   <div><br></div>

        <select name="sem6" id="sem" class=" input-lg dynamic6" data-dependent="course6">
           <option value="">Select Semester</option>
            @foreach($semester_list as $sem)
           <option value="{{ $sem->sem}}">{{ $sem->sem }}</option>
            @endforeach
        </select>
         <div class="form-group">
    <select name="course6" id="course6" class="form-control input-lg ">
     <option value="">Select Course</option>
    </select>
   </div> 
</td>


   
                    
        </tr>


      
 </tbody>

        
         </table>
  
      <center><button type="submit" class="btn btn-primary"> {{ __('Save') }}</button> &nbsp; &nbsp;<button type="button" onclick="document.getElementById('id01').style.display='none'" class="btn btn-danger"> {{ __('Cancel') }}</button></center><br>
    



</form>
</div>
</div>
</div>








<div id="details" class="modal">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <div class="container">
        </div>
       <div class="container">
 <div class="col-md-11 " >




  <form action="" method="POST" class="modal-content animate">
        {{csrf_field()}}
        <div id="faculty">
          <input type="hidden" name="faculty"  value="">
        </div>
                 
  <table  class="table table-condensed">
    <thead>
    <tr>
          
          <th></th>
          
        
       </tr>
  </thead>
  <tbody>   
   



      
 </tbody>

        
         </table>
  
      <center><button type="submit" class="btn btn-primary"> {{ __('Save') }}</button> &nbsp; &nbsp;<button type="button" onclick="document.getElementById('details').style.display='none'" class="btn btn-danger"> {{ __('Cancel') }}</button></center><br>
    



</form>
</div>
</div>
</div>





<script>


function  course_list(x,y)
{
  var id = x;
  var _token = $('input[name="_token"]').val();
  var dependent = y;
  //document.getElementById('id01').style.display='block';
$.ajax({

  url: '{{ route('select_course') }}',
  method:"POST",
  data: {id:id,  _token:_token, dependent:dependent },
   success:function(result)
    {
     $('#'+dependent).html(result);
     document.getElementById('id01').style.display='block';
    }




   })

}

/*
 function details(x,y)
 {
  var id = x;
   var _token = $('input[name="_token"]').val();
  var dependent = y;

  $.ajax({

  url: '',
  method:"POST",
  data: {id:id,  _token:_token, dependent:dependent },
   success:function(result)
    {
     $('#'+dependent).html(result);
     document.getElementById('details').style.display='block';
    }




   })
 }*/






$(document).ready(function(){

 $('.dynamic1').change(function(){

  if($(this).val() != '')
  {
   
   var select = $(this).attr("id");
   var value = $(this).val();
   var dependent = $(this).data('dependent');
   var _token = $('input[name="_token"]').val();
   $.ajax({
    
    url:"{{ route('fetch') }}",
    method:"POST",
    data:{select:select, value:value, _token:_token, dependent:dependent},
    success:function(result)
    {
     $('#'+dependent).html(result);
    }

   })
  }
  
 });

  $('#sem1').change(function(){
  $('#course1').val('');
  
 });

  $('.dynamic2').change(function(){

  if($(this).val() != '')
  {
   // alert($(this).val());
   var select = $(this).attr("id");
   var value = $(this).val();
   var dependent = $(this).data('dependent');
   var _token = $('input[name="_token"]').val();
   $.ajax({
    
    url:"{{ route('fetch') }}",
    method:"POST",
    data:{select:select, value:value, _token:_token, dependent:dependent},
    success:function(result)
    {
     $('#'+dependent).html(result);
    }

   })
  }
 });

   $('#sem2').change(function(){
  $('#course2').val('');
  
 });

    $('.dynamic3').change(function(){

  if($(this).val() != '')
  {
   // alert($(this).val());
   var select = $(this).attr("id");
   var value = $(this).val();
   var dependent = $(this).data('dependent');
   var _token = $('input[name="_token"]').val();
   $.ajax({
    
    url:"{{ route('fetch') }}",
    method:"POST",
    data:{select:select, value:value, _token:_token, dependent:dependent},
    success:function(result)
    {
     $('#'+dependent).html(result);
    }

   })
  }
 });

     $('#sem3').change(function(){
  $('#course').val('');
  
 });

  $('.dynamic4').change(function(){

  if($(this).val() != '')
  {
   // alert($(this).val());
   var select = $(this).attr("id");
   var value = $(this).val();
   var dependent = $(this).data('dependent');
   var _token = $('input[name="_token"]').val();
   $.ajax({
    
    url:"{{ route('fetch') }}",
    method:"POST",
    data:{select:select, value:value, _token:_token, dependent:dependent},
    success:function(result)
    {
     $('#'+dependent).html(result);
    }

   })
  }
 });

  


 $('#sem4').change(function(){
  $('#course4').val('');
  
 });


$('.dynamic5').change(function(){

  if($(this).val() != '')
  {
   
   var select = $(this).attr("id");
   var value = $(this).val();
   var dependent = $(this).data('dependent');
   var _token = $('input[name="_token"]').val();
   $.ajax({
    
    url:"{{ route('fetch') }}",
    method:"POST",
    data:{select:select, value:value, _token:_token, dependent:dependent},
    success:function(result)
    {
     $('#'+dependent).html(result);
    }

   })
  }
 });

  $('#sem5').change(function(){
  $('#course5').val('');
  
 });


  $('.dynamic6').change(function(){

  if($(this).val() != '')
  {
   
   var select = $(this).attr("id");
   var value = $(this).val();
   var dependent = $(this).data('dependent');
   var _token = $('input[name="_token"]').val();
   $.ajax({
    
    url:"{{ route('fetch') }}",
    method:"POST",
    data:{select:select, value:value, _token:_token, dependent:dependent},
    success:function(result)
    {
     $('#'+dependent).html(result);
    }

   })
  }
 });

  $('#sem6').change(function(){
  $('#course6').val('');
  
 });






});
  
 






</script>









@endsection


