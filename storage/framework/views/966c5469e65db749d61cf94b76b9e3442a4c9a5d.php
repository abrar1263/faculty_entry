<?php $__env->startSection('body'); ?>

<div class="container">
  <div class="col-md-12 " >
    <div class="panel panel-primary">
      <div class="panel-heading">
        <div class="container">
          <h2>Your Alloted Course</h2>
        </div>
      </div><br>

       <div class="container">
         <div class="col-md-11 ">
        <p><strong><Red>Note:</Red></strong>You Have Not alloted Any Course Please Contacy Your Head Of Department</p>
</div>
       </div>
     </div>
   </div>
 </div>

    



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.facultyapp', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>