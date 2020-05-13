<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1><?php echo e($user->name); ?></h1>
            </div>
            <div class="col-md-12 media border px-3 py-3 d-flex">
                <div class="col-md-3">
                    <img src="<?php echo e($user->getAvatar()); ?>"  alt="<?php echo e($user->name); ?>" class="img-fluid img-thumbnail">
                    <?php if(Auth::user()): ?>
                        <?php if(Auth::user()->id == $user->id): ?>
                            <a href="/userprofile/edit" class="btn btn-outline-primary mt-3">Edit Profile</a>
                        <?php else: ?>
                            <a href="/messages/<?php echo e($user->id); ?>" class="btn btn-outline-success mt-3">Message</a>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                <div class="col-md-9">
                    <h4>Name : </h4>
                    <p> <?php echo e($user->name); ?></p>
                    <?php if($user->phoneNum): ?>
                    <h4>Phone Number :</h4>
                        <p><?php echo e($user->phoneNum); ?></p>
                    <?php else: ?>
                    <h4>Phone Number :</h4>
                        Phone number is not provided.
                    <?php endif; ?>
                    <?php if($user->address): ?>
                        <h4>Address :</h4>
                        <p><?php echo e($user->address); ?></p>
                     <?php else: ?>
                     <p></p>
                     <h4>Address :</h4>
                        <p>Address is not provided</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Ashra Iwan\Desktop\fyp eas latest update\EAS - Copy\resources\views/userprofile/show.blade.php ENDPATH**/ ?>