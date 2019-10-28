<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>
	</title>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

	<style type="text/css">
	




	</style>
</head>
<body>
	<center><h2><p>H.J.THIM TRUST'S</p></h2>
  <h1>THEEM COLLEGE OF ENGINEERING</h1>
  <h3><p>Village Betegaon, Boisar (E), Taluka & Dist -Palghar </p></h3></center>
  <hr>

  <center><h3><p><b>EXAM CONDUCTED ON BEHALF OF UNIVERSITY OF MUMBAI</b></p></h3></center>
  <center><h3><p><b>YEAR _____  SEM  {{$coursesem}} |  {{$department}} _____  NOV/MAY _____ EXAMINATION</b></p></h3></center>
  <center><h5><u>ORAL & PRACTICAL MARKLIST</u></h5></center>
  



<br><br>
  <b>SUBJECT :<u> {{$coursename}}</u> </b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>DATE:</b>
	<table class="table table-bordered">
  <thead>
    <tr>
      
      <th scope="col">NAME OF THE CANDIDATE</th>
      <th scope="col">EXAM SEAT NO.</th>
      <th scope="col">OR & PR ({{$orpr}})</th>
      
    </tr>
  </thead>
  <tbody>
   
    @for ($i = 0; $i < sizeof($student_id); $i++)

  <tr>
  
  <td>{{$student_id[$i]}}</td>
  <td>{{$seatno[$i]}}</td>
  <td>{{$oralpr[$i]}}</td>
 
  
 
     </tr>
   @endfor
 
    
  </tbody>
</table>
<br><br><br><br><br><br>

<div><b><p>INTERNAL EXAMINER SIGN &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;EXTERNAL EXAMINER SIGN</p></b></div>





	



</body>

</html>