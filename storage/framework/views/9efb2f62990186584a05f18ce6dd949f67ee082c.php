<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo e($course_name); ?></title>

	  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>

  <form action="<?php echo e(route('marksverify')); ?>" method="POST">
     <?php echo e(csrf_field()); ?>


     <input type="hidden" name="course_id" value="<?php echo e($course_id); ?>">
	<center><h4><?php echo e($course_name); ?>|| Verification Marks</h4></center>
	<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">SR NO.</th>
      <th scope="col">Name of the Student</th>
      <th scope="col">Seat No</th>
      <th scope="col">Test 1(<?php echo e($ia); ?>)</th>
      <th scope="col">Test 2(<?php echo e($ia); ?>)</th>
      <th scope="col">Avg(<?php echo e($ia); ?>)</th>
       <th scope="col">TW(<?php echo e($tw); ?>)</th>
      <th scope="col">OR/PR(<?php echo e($orpr); ?>)</th>

    </tr>
  </thead>
  <tbody>
  	<?php for($i = 0; $i <sizeof($studentdata) ; $i++): ?>
  		
  	
    <tr>
      <th scope="row"><?php echo e((1+$i)); ?></th>
      <td><?php echo e($studentdata[$i]->name); ?></td>
      <td><?php echo e($studentdata[$i]->seatno); ?></td>
      <td><?php echo e($marksia[$i]->Test1); ?></td>
      <td><?php echo e($marksia[$i]->Test2); ?></td>
      <td><?php echo e($roundavg[$i]); ?></td>
      <td><?php echo e($markstw[$i]->TW); ?></td>
      <td><?php echo e($marksorpr[$i]->ORPR); ?></td>
    </tr>
  <?php endfor; ?>
  </tbody>
</table>
<center><button type="submit" id="verify" class="btn btn-success" >Verify</button></form> <form action="<?php echo e(route('reedit')); ?>" method="POST">
  <?php echo e(csrf_field()); ?>

   <input type="hidden" name="course_id" value="<?php echo e($course_id); ?>">
  <br><button type="submit" id="redit" class="btn btn-danger" name="reedit"> Edit</button></form></center>
</body>
</html>