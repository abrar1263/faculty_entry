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
  <center><h3><p><b>YEAR _____  SEM  <?php echo e($coursesem); ?> |  <?php echo e($department); ?> _____  NOV/MAY _____ EXAMINATION</b></p></h3></center>
  <center><h5><u>TEST MARKLIST</u></h5></center>
	



<br><br>
  <b>SUBJECT : <?php echo e($coursename); ?> </b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>DATE:</b> 
	<table class="table table-bordered">
  <thead>
    <tr>
      
      <th width="200">NAME OF THE CANDIDATE</th>
      <th scope="col">EXAM SEAT NO.</th>
      <th scope="col">TEST-I(<?php echo e($ia); ?>)</th>
      <th scope="col">TEST-II(<?php echo e($ia); ?>)</th>
      <th scope="col">AVG(<?php echo e($ia); ?>)</th>
     
    </tr>
  </thead>
  <tbody>


    <?php for($i = 0; $i < sizeof($student_id); $i++): ?>

  <tr>
  
  <td><?php echo e($student_id[$i]); ?></td>
  <td><?php echo e($seatno[$i]); ?></td>
  <td><?php echo e($test1[$i]); ?></td>
  <td><?php echo e($test2[$i]); ?></td>
  <td><?php echo e($avg[$i]); ?></td>
 
  
 
     </tr>
   <?php endfor; ?>
    
  </tbody>
</table><br><br><br><br><br>
<b><p>INTERNAL EXAM CO-ORDINATOR</p></b>



	



</body>

</html>