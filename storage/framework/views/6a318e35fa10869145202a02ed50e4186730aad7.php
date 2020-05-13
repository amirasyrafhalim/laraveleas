<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="jumbotron">
            <h1 class="display-3 text-center">Welcome to Event Advertisement System</h1>
            <p class="text-center">Event Advertisement System provides a center for your events to be advertised</p>
        </div>

        <div class="card mb-4 shadow-sm">
            <div class="card-header">
                <h4 class="my-0 font-weight-normal">Latest Events...</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php $__empty_1 = true; $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php if($event->verified_by_admin == 1): ?>
                        <div class="col-md-4 mt-3">
                            <div class="card" style="width: 18rem;">
                                <img src="<?php echo e($event->default_image_path); ?>" class="card-img-top img-fluid" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><a href="/events/<?php echo e($event->slug()); ?>"><?php echo e($event->title); ?></a></h5>
                                    <h6 class="card-title"><?php echo e($event->created_at->diffForHumans()); ?> by <a href="/users/<?php echo e($event->author->id); ?>"><?php echo e($event->author->name); ?></a></h6>
                                    <h6 class="card-title">Date of event : <?php echo e($event->parsedEventDate); ?></h6>
                                    <?php if($event->price == 0): ?>
                                    <h6 class="card-title">Price: Free</h6>
                                    <?php else: ?>
                                    <h6 class="card-title">Price: <?php echo e($event->price ? 'RM' . $event->price : ''); ?>

                                     <?php endif; ?>
                                     <h6 class="card-title"><h6>Official Website:<a href="https://<?php echo e(($event->website)); ?>"> <?php echo e($event->website); ?> </a></h6></h6>
                                    <a href="/events/<?php echo e($event->slug()); ?>" class="btn btn-outline-primary">Learn More</a>
                                </div>
                            </div>
                        </div>
                     <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p>No events found</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Ashra Iwan\Desktop\fyp eas latest update\EAS - Copy\resources\views/home.blade.php ENDPATH**/ ?>