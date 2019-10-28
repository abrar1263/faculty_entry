@extends('layout.hodapp')

@section('body')

@include('sweet::alert')

<div class="container">
  <div class="col-xs-12 " >
    <div class="panel panel-primary">
      
      <div class="panel-heading">
        <div class="container">
          <h2>Status of Every Subjects</h2>
        </div>
      </div><br>

      <div class="container">
 <div class="col-md-11 " >
<form>
	{{csrf_field()}}
 	<div class="form-group col-md-4">
      <label for="pattern">Pattern</label> 
      <select id="pattern" class="form-control" name="pattern">
         <option selected value="">Select pattern</option>
        @foreach($pattern as $pattern)
      <option value="{{ $pattern->pattern}}">{{ $pattern->pattern }}</option>
      @endforeach
      </select>
    </div>

    <div class="form-group col-md-4">
      <label for="semester">Semester</label>
      <select id="semester" class="form-control" name="semester" >
        <option selected value="">Select Semester</option>

        @foreach($semester as $semester)
      <option value="{{ $semester->sem}}">{{ $semester->sem }}</option>
      @endforeach
      </select>
    </div>
    <br><div class="form-group col-md-2">
    
<button type="button" onclick="detailstatus()" class="btn btn-primary btn-md form-control">Search</button> </div>

</form>




<div id="detailstatus" class="modal" style="overflow-y: scroll">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <div class="container">
        </div>
       <div class="container">
 <div class="col-md-11 " >
    </div>
  <form action="home/marksIA" method="POST" class="modal-content animate">
        {{csrf_field()}}
         
                


 
<div id="detaildata">
</div>


        <center><button type="button" onclick="document.getElementById('detailstatus').style.display='none'" class="btn btn-danger">Cancel</button></center><br>
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
	
 function detailstatus()

  {
 	var pattern = $('select[name="pattern"]').val();
 	var semester = $('select[name="semester"]').val();
 	var dependent = "detaildata";
 	var _token = $('input[name="_token"]').val();

 	if (pattern == '') {
    swal("please select pattern");
 		 
 		return;

 	} 

 	else if(semester ==  '') {
    swal("please select semester");
 		
 		return;

 	}

 	else
 	{
 	$.ajax({
    
    url:"{{ route('detail_status') }}",
    method:"POST",
    data:{select:pattern, value:semester, _token:_token, dependent:dependent},
    success:function(result)
    {
      
    document.getElementById('detailstatus').style.display='block';
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
