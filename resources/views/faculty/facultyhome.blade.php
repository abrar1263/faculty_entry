@extends('layout.facultyapp')
@section('body')

@include('sweet::alert')

<div class="container">
  <div class="col-md-12 " >
    <div class="panel panel-primary">
      <div class="panel-heading">
        <div class="container">
          <h2>Alloted Course</h2>
        </div> 
      </div><br>

      <div class="container">
 <div class="col-md-11 " >
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Subject Name</th>
          <th scope="col">Internal Assesment</th>
          <th scope="col">Term work</th>
          <th scope="col">Oral/Practical</th>
          <th scope="col">IA</th>
          <th scope="col">TW</th>
          <th scope="col">Oral&Practical</th>
          <!-- <th scope="col">Signature</th> -->
        </tr>
      </thead>
      <tbody>
         @foreach ($courses as $data)
        <tr>
         
          <td>{{$data->course_name}}</td>
          <td><input id="id1" name="id1" type="hidden" value="{{$data->IA}}" required>
            <a onclick="course_IA({{$data->id}},{{$data->IA}},'internal1')">{{$data->IA}}</a></td>
          
          <td><input id="id2" name="id2" type="hidden" value="{{$data->TW}}" required>
          <a onclick="course_TW({{$data->id}},{{$data->TW}},'studenttermwork')">{{$data->TW}}</a></td>

          
          <td><input id="id3" name="id3" type="hidden" value="{{$data->OR_PR}}" required>
            <a onclick="course_OR({{$data->id}},{{$data->OR_PR}},'studentoral')">{{$data->OR_PR}}</a></td>

          <td><span style="font-size: 25px; color: Dodgerblue;"><a onclick="IA_verification({{$data->id}},{{$data->IA}},'iamarks')" class="far fa-file-pdf"></a></span></td>
          <td><span style="font-size: 25px; color: Dodgerblue;"><a onclick="TW_verification({{$data->id}},{{$data->TW}},'twmarks')" class="far fa-file-pdf"></a></span></td>
          <td><span style="font-size: 25px; color: Dodgerblue;"><a onclick="ORPR_verification({{$data->id}},{{$data->OR_PR}},'orprmarks')" class="far fa-file-pdf"></a></span></td>
          <!-- <td><span style="font-size: 25px; color: Dodgerblue;"><a href="" class="far fa-file-pdf"></a></span></td> -->
           
        </tr>
         @endforeach
      </tbody>
    </table>
</div>
</div>
</div>
</div>
</div>

<!-- internal marks start here -->

<div id="internal" class="modal" style="overflow-y: scroll">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <div class="container">
        </div>
       <div class="container">
 <div class="col-md-11 " >
    </div>
  <form action="home/marksIA" method="POST" class="modal-content animate">
        {{csrf_field()}}
         
                


 
<div id="internal1"> 
</div>


  
        <center><button type="button" onclick="document.getElementById('internal').style.display='none'" class="btn btn-danger">Cancel</button></center><br>
    </form>
</div>
 
</div>

<!-- internal marks ends here -->

<!-- term work marks start here -->
<div id="termwork" class="modal"  style="overflow-y: scroll" >
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <div class="container">
        </div>
       <div class="container">
 <div class="col-md-11 " >
    </div>
  <form action="home/marksTW" method="POST" class="modal-content animate">
        {{csrf_field()}} 
        
                    
  
  <div id="studenttermwork">
</div>
      <center><button type="button" onclick="document.getElementById('termwork').style.display='none'" class="btn btn-danger"> {{ __('Cancel') }}</button></center><br>
    </form>
</div>
</div>

<!-- term works marks end here -->

<!-- oral& practical marks start here -->
<div id="oral" class="modal" style="overflow-y: scroll" >
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <div class="container">
        </div>
       <div class="container">
 <div class="col-md-11 " >
    </div>
  <form action="home/marksORPR" method="POST" class="modal-content animate">
        {{csrf_field()}}
        
                   

  <div id="studentoral">
</div>
  
        <center><button type="button" onclick="document.getElementById('oral').style.display='none'" class="btn btn-danger"> {{ __('Cancel') }}</button></center><br>
    </form>
</div>
</div>

<!-- oral& practical marks end here -->




<!-- Internal  marks verification start here  --> 


<div id="marksia" class="modal" style="overflow-y: scroll">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <div class="container">
        </div>
       <div class="container">
 <div class="col-md-11 " >
    </div>
  <form action="home/pdfIa" method="POST" class="modal-content animate">
        
         {{csrf_field()}}
                


 
<div id="iamarks">
</div>


      
        <center><button type="button" onclick="document.getElementById('marksia').style.display='none'" class="btn btn-danger"> {{ __('Cancel') }}</button><br><br></center>
    </form>
</div>
 
</div><br>

<!-- Internal  marks verification end here  -->\



<!-- term work  marks verification start here  -->


<div id="markstw" class="modal" style="overflow-y: scroll">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <div class="container">
        </div>
       <div class="container">
 <div class="col-md-11 " >
    </div>
  <form action="home/pdftw" method="POST" class="modal-content animate">
        
         {{csrf_field()}}
                


 
<div id="twmarks">
</div>


     
       <center><button type="button" onclick="document.getElementById('markstw').style.display='none'" class="btn btn-danger"> {{ __('Cancel') }}</button><br><br></center>
    </form>
</div>
 
</div><br>

<!--  termwork marks verification end here  -->

<!-- oral and practical marks verification start here -->
<div id="marksorpr" class="modal" style="overflow-y: scroll" >
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <div class="container">
        </div>
       <div class="container">
 <div class="col-md-11 " >
    </div>
  <form action="home/pdforpr" method="POST" class="modal-content animate">
        {{csrf_field()}}
        
                   

  <div id="orprmarks">
          
</div>

          
          
         
       <center><button type="button" onclick="document.getElementById('marksorpr').style.display='none'" class="btn btn-danger"> {{ __('Cancel') }}</button><br><br></center>
    </form>
</div>
</div>
<!-- oral and practical marks verification end here -->





<script type="text/javascript">

  function course_IA(id,data,depend) {
    var select = id;
    var value = data;
    var dependent = depend;
    var _token = $('input[name="_token"]').val();
    
   if(value == 0)
    {
      
      swal("No need to submit marks");
    }
    else
    {

    $.ajax({
    
    url:"{{ route('studentIA') }}",
    method:"POST",
    data:{select:select, value:value, _token:_token, dependent:dependent},
    success:function(result)
    {
      
    document.getElementById('internal').style.display='block';
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

  

  function course_TW(id,data,depend) {
    var select =id;
    var value = data;
    var dependent = depend;
    var _token = $('input[name="_token"]').val();
     
  if(value == 0)
    {
      swal("No need to submit marks");
    }
    else
    {
       $.ajax({
    
    url:"{{ route('studentTW') }}",
    method:"POST",
    data:{select:select, value:value, _token:_token, dependent:dependent},
    success:function(result)
    {
     $('#'+dependent).html(result);
     document.getElementById('termwork').style.display='block';
    },
    error:function()
    {
      alert('error');
      
    }

   })
    }
 
}


  function course_OR(id,data,depend) {
   var select =id;
    var value = data;
    var dependent = depend;
    var _token = $('input[name="_token"]').val();
    
     if(value == 0)
    
    {
      swal("No need to submit marks");
    }
    else
    {
       $.ajax({
    
    url:"{{ route('studentOR') }}",
    method:"POST",
    data:{select:select, value:value, _token:_token, dependent:dependent},
    success:function(result)
    {
     $('#'+dependent).html(result);
     document.getElementById('oral').style.display='block';
    },
    error:function()
    {
      alert('error');
      
    }

   })


    }
}





function IA_verification(id,data,depend)
{




  
   var select =id;
    var value = data;
    var dependent = depend;
    var _token = $('input[name="_token"]').val();

 if(value == 0)
    {
      swal("This Course doesn't have Internal Assesment");
     
    }
    else
    {


    $.ajax({
    
    url:"{{ route('iaverification') }}", 
    method:"POST",
    data:{select:select, value:value, _token:_token, dependent:dependent},
    success:function(result)
    {
      console.log(result);
     $('#'+dependent).html(result);
     document.getElementById('marksia').style.display='block';
    },
    error:function()
    {
      alert('error');
      
    }

   })
}

    
}


function TW_verification(id,data,depend)
{




  
   var select =id;
    var value = data;
    var dependent = depend;
    var _token = $('input[name="_token"]').val();

 if(value == 0)
    {
      swal("This Course doesn't have Term Work");
      
    }
    else
    {


    $.ajax({
    
    url:"{{ route('twverification') }}",
    method:"POST",
    data:{select:select, value:value, _token:_token, dependent:dependent},
    success:function(result)
    {
      console.log(result);
     $('#'+dependent).html(result);
     document.getElementById('markstw').style.display='block';
    },
    error:function()
    {
      alert('error');
      
    }

   })
}

    
}





function ORPR_verification(id,data,depend)

{
   var select =id;
    var value = data;
    var dependent = depend;
    var _token = $('input[name="_token"]').val();

    if(value == 0)
    {
      swal("This Course doesn't have oral and practical");
    }
    else
    {

    
      $.ajax({
    
    url:"{{ route('orprverification') }}",
    method:"POST",
    data:{select:select, value:value, _token:_token, dependent:dependent},
    success:function(result)
    {
      //console.log(result);
     $('#'+dependent).html(result);
     document.getElementById('marksorpr').style.display='block';
    },
    error:function()
    {
      alert('error');
      
    }

   })

}
    
}
  



// validation marks start  here

function average(){


    a = parseInt(document.getElementById("test1").value);
    b = parseInt(document.getElementById("test2").value);
    
    var final= ((a+b)/2);
        document.getElementById('avg').value = final;
    }

/*$(document).keydown(function(e){
    if(e.which === 123){
       return false;
    }
});*/




</script>




@endsection