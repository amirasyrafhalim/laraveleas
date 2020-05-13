<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1>Messages</h1>
        <ul>
            <?php $__currentLoopData = $chattedUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><a href="/messages/<?php echo e($user->id); ?>"><?php echo e($user->name); ?></a></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Ashra Iwan\Desktop\fyp eas latest update\EAS - Copy\resources\views/messages/index.blade.php ENDPATH**/ ?>