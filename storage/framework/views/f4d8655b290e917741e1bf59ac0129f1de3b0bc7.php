<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1>Events You Have Liked</h1>

        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Event Title</th>
                <th scope="col">View</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <th scope="row"><?php echo e($loop->iteration); ?></th>
                    <td><?php echo e($event->title); ?></td>
                    <td><a href="/<?php echo e($event->slugWithPrefix()); ?>">View</a></td>
                    <td>
                        <form method="POST" action="/liked-events/<?php echo e($event->id); ?>">
                            <?php echo csrf_field(); ?> <?php echo e(method_field("DELETE")); ?>

                            <button type="submit" class="btn btn-danger">
                               Unlike
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Ashra Iwan\Desktop\fyp eas latest update\EAS - Copy\resources\views/liked_event/index.blade.php ENDPATH**/ ?>