<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <?php echo e($applicant->name); ?> wants to join your event! 
            </div>
            
                <div class="card-footer">
                    <form action="/events/<?php echo e($event->id); ?>/applicant/<?php echo e($applicant->id); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn-outline-primary float-right">Accept</button>
                    </form>
                </div>
            
        </div>

    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Ashra Iwan\Desktop\fyp eas latest update\EAS - Copy\resources\views/events/application/show.blade.php ENDPATH**/ ?>