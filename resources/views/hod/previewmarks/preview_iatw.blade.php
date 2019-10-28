<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>{{$course_name}}</title>

	  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
  <form action="{{ route('marksverify') }}" method="POST">
     {{csrf_field()}}

     <input type="hidden" name="course_id" value="{{$course_id}}">
	<center><h4>{{$course_name}}|| Verification Marks</h4></center>
	<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">SR NO.</th>
      <th scope="col">Name of the Student</th>
      <th scope="col">Seat No</th>
      <th scope="col">Test 1({{$ia}})</th>
      <th scope="col">Test 2({{$ia}})</th>
      <th scope="col">Avg({{$ia}})</th>
      <th scope="col">TW({{$tw}})</th>

    </tr>
  </thead>
  <tbody>
  	@for ($i = 0; $i <sizeof($studentdata) ; $i++)
  		
  	
    <tr>
      <th scope="row">{{(1+$i)}}</th>
      <td>{{$studentdata[$i]->name}}</td>
      <td>{{$studentdata[$i]->seatno}}</td>
      <td>{{$marksia[$i]->Test1}}</td>
      <td>{{$marksia[$i]->Test2}}</td>
      <td>{{$roundavg[$i]}}</td>
      <td>{{$markstw[$i]->TW}}</td>
    </tr>
  @endfor
  </tbody>
</table>
<center><button type="submit" id="verify" class="btn btn-success" >Verify</button></form> <form action="{{ route('reedit') }}" method="POST">
  {{csrf_field()}}
   <input type="hidden" name="course_id" value="{{$course_id}}">
  <br><button type="submit" id="redit" class="btn btn-danger" name="reedit"> Edit</button></form></center>
       
</body>
</html>