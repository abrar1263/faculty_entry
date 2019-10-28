<?php $__env->startSection('body'); ?>

<?php echo $__env->make('sweet::alert', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>


<div class="container">
  <div class="col-xs-20 " >
    <div class="panel panel">
      <div class="panel-heading">
        <div class="container">
          <h2>Add Student</h2>
        </div>
      </div><br>

      <div class="container">
 <div class="col-md-11 " >
<form>
  <?php echo e(csrf_field()); ?>

  <div class="form-group col-md-3">
      <label for="department">Department</label> 
      <select id="department" class="form-control" name="department">
          <option selected value="">Select department</option>
        
      
               <option value="AUTO">Automobile</option>
               <option value="CIV">Civil</option>
               <option value="COMP">Computer</option>
               <option value="EJ">Electronics</option>
               <option value="EL">Electrical</option>
               <option value="EXTC">Electonics & Telecom</option>
               <option value="IT">Infomation Technology</option>
               <option value="MECH">Mechanical</option>
    
      
      </select>
    </div>

    <div class="form-group col-md-2">
      <label for="pattern">Pattern</label> 
      <select id="pattern" class="form-control" name="pattern">
         <option selected value="">Select pattern</option>
        <?php $__currentLoopData = $pattern; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pattern): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <option value="<?php echo e($pattern->pattern); ?>"><?php echo e($pattern->pattern); ?></option>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </select>
    </div>





    <div class="form-group col-md-2">
      <label for="semester">Semester</label>
      <select name="sem1" id="sem1" class="form-control dynamic1" data-dependent="course1">
        <option selected value="">Select Semester</option>

      <?php $__currentLoopData = $semester; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <option value="<?php echo e($sem->sem); ?>"><?php echo e($sem->sem); ?></option>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       </select>
    </div>

 
  <div class="form-group col-md-3">
      <label for="semester">Subject</label>
      <select name="course1" id="course1" class="form-control">
        <option selected value="">Select Subject</option>

        
      <option value=""></option>
     
      </select>
    </div>
    <br>




     







   
    <div class="form-group col-md-2">
    
<button type="button" id="check" onclick="detail_status()" class="btn btn-default btn-md form-control">Check</button></div>

</form><br>








</div>
</div>
</div>
</div>
</div> 




        <div id="import_file" class="modal" style="overflow-y: scroll">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <div class="container">
            </div>
        <div class="container">
         <div class="col-md-11 " >
           </div>
        <form action="addstudent/upload" method="POST" enctype="multipart/form-data" class="modal-content animate">
          <?php echo e(csrf_field()); ?>

         
           <h3>Please select Excel file to import the student details in database</h3>     

<br><br><br>
 
        <div id="upload">
        </div>


  
        <br><center><button type="button" onclick="document.getElementById('import_file').style.display='none'" class="btn btn-danger">Cancel</button></center><br>
        </form>
        </div>
 
          </div>




<script>



  function detail_status()
  {
    var department =  $('select[name="department"]').val();
    var pattern = $('select[name="pattern"]').val();
    var semester = $('select[name="sem1"]').val();
    var course = $('select[name="course1"]').val();
    var _token = $('input[name="_token"]').val();
    var dependent = "upload";

    
    if (department == '') {

    
    swal("please select department");
    return;
    }
    else if(pattern == '')
   {
    
    swal("please select pattern");
    return;
    } 
    else if(semester == '')
    {
   
    swal("please select semester"); 
    return;
    }
    else if(course == '') {
      
      swal("please select course");
      return;

    
    }

    else{

    $.ajax({
    url:"<?php echo e(route('check')); ?>",
    method:"POST",
    data:{department:department, pattern:pattern,semester:semester, _token:_token, course:course},
    success:function(result)
    {
      document.getElementById('import_file').style.display='block';
     $('#'+dependent).html(result);
     
    },
    error:function()
    {
      alert('error');
      
      }

   });


    


}
}


  
$(document).ready(function(){

 $('.dynamic1').change(function(){
  if($(this).val() != '')
  {
   var department = $('select[name="department"]').val();
   var pattern = $('select[name="pattern"]').val();
   var select = $(this).attr("id");
   var value = $(this).val();
   var dependent = $(this).data('dependent');
   var _token = $('input[name="_token"]').val();

   if (department == '') {

    
    swal("please select department");
    return;
   }
  else if(pattern == '')
  {

    swal("please select pattern");
  } 

    else {


   
   $.ajax({
    url:"<?php echo e(route('coursefetch')); ?>",
    method:"POST",
    data:{select:select, value:value,department:department, _token:_token, dependent:dependent},
    success:function(result)
    {
    console.log(result);
     $('#'+dependent).html(result);
    },
    error:function()
    {
      alert('error');
      
      }

   })
  }
}
 });

  $('#sem1').change(function(){
  $('#course1').val('');
 });

    $('#department').change(function(){
  $('#sem1').val('');
  $('#pattern').val('');
 });








});


 




</script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.adminapp', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>