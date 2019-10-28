<?php $__env->startSection('body'); ?>

             <div class="container">
    <div class="col-md-10 " >
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="container">
                <h2>Register Faculty</h2>
        </div>
      </div><br>
      <div class="panel-body">
                    <form method="POST" action="<?php echo e(route('register')); ?>">
                        <?php echo csrf_field(); ?>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Name')); ?></label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control<?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>" name="name" value="<?php echo e(old('name')); ?>" required autofocus>

                                <?php if($errors->has('name')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('name')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right"><?php echo e(__('E-Mail Address')); ?></label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" name="email" value="<?php echo e(old('email')); ?>" required>

                                <?php if($errors->has('email')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="designation" class="col-md-4 col-form-label text-md-right"><?php echo e(__('designation')); ?></label>

                            <div class="col-md-6">
                                 <select id="designation" type="text" class="form-control <?php echo e($errors->has('designation') ? ' is-invalid' : ''); ?>" name="designation" value="<?php echo e(old('designation')); ?>" required >
                                         <option value="HOD">HOD</option>
                                         <option value="Asst Professor">Asst Professor</option>
                                         <option value="Lecturer">Lecturer</option>
                                         <option value="Lab. Assistant">Lab. Assistant</option>
                                        <option value="Attendant">Attendant</option>
                                </select>
                                

                                <?php if($errors->has('designation')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('designation')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="department" class="col-md-4 col-form-label text-md-right"><?php echo e(__('department')); ?></label>

                            <div class="col-md-6">

                                  <select id="department" type="text" class="form-control<?php echo e($errors->has('department') ? ' is-invalid' : ''); ?>" name="department" value="<?php echo e(old('department')); ?>" required>

                                 <option value="Automobile">Automobile</option>
                                <opion value="Civil">Civil</option>
                                 <option value="Computer">Computer</option>
                                <option value="Electronics">Electronics</option>
                                 <option value="Electrical">Electrical</option>
                                 <option value="Electonics & Telecom">Electonics & Telecom</option>
                                 <option value="Infomation Technology">Infomation Technology</option>
                                 <option value="Mechanical">Mechanical</option>
                                 <option value="Humanities & Sciencs">Humanities & Sciencs</option>


                                </select>
                                

                                <?php if($errors->has('department')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('department')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Password')); ?></label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" name="password" required>

                                <?php if($errors->has('password')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Confirm Password')); ?></label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    <?php echo e(__('Register')); ?>

                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.adminapp', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>