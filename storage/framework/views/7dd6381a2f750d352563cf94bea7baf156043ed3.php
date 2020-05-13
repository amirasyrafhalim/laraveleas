<?php $__env->startSection('content'); ?>
        <div class="container">
            <h1>Edit Profile</h1>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="/userprofile" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?> <?php echo e(method_field("PATCH")); ?>

                                <!-- name field -->
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                                    <div class="col-md-6">
                                        <input id="name" name="name" placeholder="<?php echo e($user->name); ?>" type="text" class="form-control">
                                    </div>
                                </div>

                                <!-- phoneNum field -->
                                <div class="form-group row">
                                    <label for="phoneNum" class="col-md-4 col-form-label text-md-right">Phone Number</label>

                                    <div class="col-md-6">
                                        <input id="phoneNum" name="phoneNum" placeholder="<?php echo e($user->phoneNum); ?>" type="text"  class="form-control">
                                    </div>
                                </div>

                                
                                <!-- address field -->
                                <div class="form-group row">
                                    <label for="address" class="col-md-4 col-form-label text-md-right">Address</label>

                                    <div class="col-md-6">
                                        <input id="address" name="address" placeholder="<?php echo e($user->address); ?>" type="text"  class="form-control">
                                    </div>
                                </div>


                                <!-- profPic field -->
                                <div class="form-group row">
                                    <label for="profPic" class="col-md-4 col-form-label text-md-right">Upload Profile Picture</label>

                                    <div class="col-md-6">
                                        <input type="file" name="avatar">
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col text-center">
                                        <button type="submit" class="btn btn-primary">
                                            Save
                                        </button>
                                    </div>

                                    <div class="col text-center">
                                        <a href="/userprofile/" class="btn btn-default">Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Ashra Iwan\Desktop\fyp eas latest update\EAS - Copy\resources\views/userprofile/edit.blade.php ENDPATH**/ ?>