<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1>Your advertised events</h1>

        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Event Title</th>
                <th scope="col">View Applicants</th>
                <th scope="col">Status</th>
                <th scope="col">Approval</th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <th scope="row"><?php echo e($loop->iteration); ?></th>
                    <td><a href="/<?php echo e($event->slugWithPrefix()); ?>"><?php echo e($event->title); ?></a></td>
                    <?php if($event->isRequired()): ?>
                    <td><a href="/<?php echo e($event->slugWithPrefix()); ?>/applications">Applicants</a></td>
                    <?php elseif($event->isOpen()): ?>
                    <td>This is an open event</td>
                    <?php endif; ?>
                    <td><span class="badge badge-success"><?php echo e(\App\Event::STATUS_TYPE[$event->status]); ?></span></td>
                    <?php if($event->verified_by_admin == 1): ?>
                    <td><span class="badge badge-success">Approved</span></td>
                    <?php elseif(!$event->verified_by_admin == 1): ?>
                    <td><span class="badge badge-danger">Waiting</span></td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Ashra Iwan\Desktop\fyp eas latest update\EAS - Copy\resources\views/advertised_event/index.blade.php ENDPATH**/ ?>