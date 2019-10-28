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
	<center><h2><p>H.J.THIM TRUST'S </p></h2>
	<h1>THEEM COLLEGE OF ENGINEERING</h1>
	<h3><p>Village BeteGaon, Boisar (E), Taluka palghar, District -Thane</p></h3></center>
	<hr>

	<center><h4><p>EXAM CONDUCTED ON BEHALF OF UNIVERSITY OF MUMBAI</p></h4></center>

	



<br><br><br>

	<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name of the Candidate</th>
      <th scope="col">Exam Seat no</th>
      <th scope="col">Test 1</th>
      <th scope="col">Test 2</th>
      <th scope="col">Avg</th>
      <th scope="col">TW</th>
    </tr>
  </thead>
  <tbody>


    <?php for($i = 0; $i < sizeof($student_id); $i++): ?>

  <tr>
  <td><?php echo e(1+$i); ?></td>
  <td><?php echo e($student_id[$i]); ?></td>
  <td><?php echo e($seatno[$i]); ?></td>
  <td><?php echo e($test1[$i]); ?></td>
  <td><?php echo e($test2[$i]); ?></td>
  <td><?php echo e($avg[$i]); ?></td>
  <td><?php echo e($termwork[$i]); ?></td>
  
 
     </tr>
   <?php endfor; ?>
    
  </tbody>
</table>




	



</body>

</html>



 <?php $__currentLoopData = $student_id; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $studentname): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
 <?php $__currentLoopData = $seatno; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seat_no): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
 <?php $__currentLoopData = $test1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $test_1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
 <?php $__currentLoopData = $test2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $test_2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
 <?php $__currentLoopData = $avg; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $average): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
 <?php $__currentLoopData = $termwork; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $term_work): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>