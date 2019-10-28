@extends('layout.adminapp')

@section('body')




<div class="container">
  <div class="col-xs-20 " >
    <div class="panel panel-primary">
      <div class="panel-heading">
        <div class="container">
          <h2>Student Marks</h2>
        </div> 
      </div><br>

      <div class="container">
 <div class="col-md-11 " >
<form>
	{{csrf_field()}}
 	<div class="form-group col-md-3">
      <label for="department">Department</label> 
      <select id="department" class="form-control" name="department">
          <option selected value="">Select pattern</option>
        
      
               <option value="AUTO">Automobile</option>
               <option value="CIV">Civil</option>
               <option value="COMP">Computer</option>
               <option value="EJ">Electronics</option>
               <option value="EL">Electrical</option>
               <option value="EXTC">Electonics & Telecom</option>
               <option value="IT">Infomation Technology</option>
               <option value="MECH">Mechanical</option>
    
      
      </select>
    </div>

    <div class="form-group col-md-3">
      <label for="pattern">Pattern</label> 
      <select id="pattern" class="form-control" name="pattern">
         <option selected value="">Select pattern</option>
        @foreach($pattern as $pattern)
      <option value="{{ $pattern->pattern}}">{{ $pattern->pattern }}</option>
      @endforeach
      </select>
    </div>

    <div class="form-group col-md-3">
      <label for="semester">Semester</label>
      <select id="semester" class="form-control" name="semester" >
        <option selected value="">Select Semester</option>

        @foreach($semester as $semester)
      <option value="{{ $semester->sem}}">{{ $semester->sem }}</option>
      @endforeach
      </select>
    </div><br>
   
    <div class="form-group col-md-3">
    
<button type="button" onclick="admindetailstatus()" class="btn btn-primary btn-md form-control">Search</button> </div>

</form>




<div id="adminmarks" class="modal" style="overflow-y: scroll">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <div class="container">
        </div>
       <div class="container">
 <div class="col-md-11 " >
    </div>
  <form  method="POST" class="modal-content animate">
        {{csrf_field()}}
         
                


 
<div id="showmarks">
  
</div>


        
        <center>
          <button type="button" onclick="document.getElementById('adminmarks').style.display='none'" class="btn btn-danger">Cancel</button></center><br>
    </form>
</div>
 
</div>

   


    



</div>
</div>
</div>
</div>
</div>
@endsection

<script type="text/javascript">
  
function admindetailstatus()
{
  var department = document.getElementById("department").value;
  var pattern = document.getElementById("pattern").value;
  var semester = document.getElementById("semester").value;
  var dependent = "showmarks";
  var _token = $('input[name="_token"]').val();

  if (department == '') {
    swal("please select department");
  
    return;

  } 

  else if(pattern ==  '') {
    swal("please select pattern"); 
   
    return;

  }

  else if(semester == '')
 { 
    swal("please select semester");
    
    return;
  }

  else
  {
     $.ajax({
    
    url:"{{ route('admin_studentstatus') }}",
    method:"POST",
    data:{pattern:pattern ,department:department ,semester:semester, _token:_token, dependent:dependent},
    success:function(result)
    {
      
    document.getElementById('adminmarks').style.display='block';
    $('#'+dependent).html(result);
     console.log(result);

    },
    error:function()
    {
      alert('error');
      
      
    }


   })

  
}
}




</script>