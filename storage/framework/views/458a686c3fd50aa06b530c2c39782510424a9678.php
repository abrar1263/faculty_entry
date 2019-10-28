<!DOCTYPE html>
<html  lang="en">
<head>
	<meta charset="UTF-8">
	<title>Admin Dashboard</title>

	
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>



<body>
	<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="<?php echo e(url('/')); ?>">Online Marks Entry System || Admin Dashboard</a>
      
    </div>
              
         <ul class="nav navbar-nav navbar-right" type="button" data-toggle="dropdown" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="<?php echo e(__('Toggle navigation')); ?>">
            <span class="navbar-toggler-icon"></span>
             </ul>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        
                      <li> <a href="<?php echo e(url('/home')); ?>">Home</a></li>
                           <li><a href="<?php echo e(route('register')); ?>">create user</a></li>
                         <li><a href="<?php echo e(route('adminshowmarks')); ?>"> Show submitted marks</a></li>
                         <li><a href="<?php echo e(route('addstudent')); ?>">Add Student</a></li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <?php echo e(Auth::user()->name); ?> <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <?php echo e(__('Logout')); ?>

                                    </a>

                                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                        <?php echo csrf_field(); ?>
                                    </form>
                                </div>
                            </li>
                     
                    </ul>
                </div>
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


      