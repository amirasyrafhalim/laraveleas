<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1>All advertised events</h1>

        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Event Title</th>
                <th scope="col">Author</th>
                <th scope="col">View Event</th>
                <th scope="col">Action</th>
                <th scope="col">Request</th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <th scope="row"><?php echo e($loop->iteration); ?></th>
                    <td><?php echo e($event->title); ?></td>
                    <td><a href="/users/<?php echo e($event->author->id); ?>"><?php echo e($event->author->name); ?></a></td>
                    <td><a href="/<?php echo e($event->slugWithPrefix()); ?>" class="btn btn-primary">View</a></td>   
                    <td>
                        <form method="POST" action="/viewallevents/<?php echo e($event->id); ?>">
                            <?php echo csrf_field(); ?> <?php echo e(method_field("DELETE")); ?>

                            <button type="submit" class="btn btn-danger">
                                Delete
                            </button>
                        </form>
                    </td>
                    <?php if(!$event->verified_by_admin == 1): ?>
                    <td>
                        <form method="POST" action="/viewallevents/<?php echo e($event->id); ?>">
                            <?php echo csrf_field(); ?> <?php echo e(method_field("PATCH")); ?>

                            <button type="submit" class="btn btn-outline-success">
                                Approve
                            </button>
                        </form>
                    </td>
                    <?php else: ?>
                    <td><span class="badge badge-success">Approved</span></td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Ashra Iwan\Desktop\fyp eas latest update\EAS - Copy\resources\views/viewallevents/index.blade.php ENDPATH**/ ?>