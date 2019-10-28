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

  <table class="table table-borderless">
  <thead>
    
     <tr>
      <th scope="col">SR NO.</th>
      <th scope="col">STUDENT ID</th>
      <th scope="col">NAME OF THE CANDIDATE</th>
      <th scope="col">EXAM SEAT NO.</th>
      <th scope="col">ESE (<?php echo e($course_ESE); ?>)</th>
      <th scope="col">IA (<?php echo e($course_IA); ?>)</th>
      <th scope="col">PR OR (<?php echo e($course_ORPR); ?>)</th>
      <th scope="col">TW (<?php echo e($course_TW); ?>)</th>
      
      

    </tr>
    
    </tr>
  </thead>
  <tbody>
    <?php for($i = 0; $i < sizeof($studentdata) ; $i++): ?>

        
    <tr>
      <th scope="row"><?php echo e(1+$i); ?></th>
      <td><?php echo e($studentdata[$i]->students_id); ?></td>
      <td><?php echo e($studentdata[$i]->name); ?></td>
      <td><?php echo e($studentdata[$i]->seatno); ?></td>
      <td></td>
      <td><?php echo e($roundavg[$i]); ?></td>
      <td><?php echo e($marksorpr[$i]->ORPR); ?></td>
      <td><?php echo e($markstw[$i]->TW); ?></td>
    </tr>
    <?php endfor; ?>
  </tbody>
</table>
<center><button type="button" class="btn btn-success ">Export In EXcel</button></center>
</body>
</html>




