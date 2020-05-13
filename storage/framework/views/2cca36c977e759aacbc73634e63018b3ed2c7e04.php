<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1>Who are going to join <a href="/<?php echo e($event->slugWithPrefix()); ?>"><?php echo e($event->title); ?> </a>event!</h1>

        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Status</th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $event->applicants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $applicant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <th scope="row"><?php echo e($loop->iteration); ?></th>
                    <td><a href="/users/<?php echo e($applicant->id); ?>"><?php echo e($applicant->name); ?></a> </td>
                    <td><span class="badge badge-success">Joining</span></td>  
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Ashra Iwan\Desktop\fyp eas latest update\EAS - Copy\resources\views/events/application/index.blade.php ENDPATH**/ ?>