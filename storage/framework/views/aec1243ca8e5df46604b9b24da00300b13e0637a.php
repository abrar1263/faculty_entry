<!DOCTYPE html>
<html oncontextmenu="return false" lang="en">
<head>
	<meta charset="UTF-8">
	<title> <?php echo $__env->yieldContent('title'); ?></title>

	<meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

 

</head>
<body>


	<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="<?php echo e(route('index')); ?>">Online Marks Entry System</a>
    </div>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="<?php echo e(route('index')); ?>">Home</a></li>
      
      <li><a href="<?php echo e(route('login')); ?>">Login</a></li>
     
    </ul>
  </div>
</nav>
<?php $__env->startSection('body'); ?>

<?php echo $__env->yieldSection(); ?>
<footer>
  <p>Copyright © 2018 Theem college of Engineering . All rights reserved.</p>

</footer>
	
</body>
<style>
	
footer {
  position: absolute;
  right: 0;
  bottom: 0;
  left: 0;
  padding: 1rem;
  background-color: #efefef;
  text-align: center;
}


</style>

</html>