<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Are you sure you want to join <?php echo e($event->title); ?> ?</div>
                    <div class="card-body">
                        <form method="POST" action="/<?php echo e($event->slugWithPrefix()); ?>/apply">
                            <?php echo csrf_field(); ?>
                            <div class="form-group row mb-0">
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-lg btn-primary">
                                        Yes
                                    </button>
                                </div>
                            </div>
                        </form>
                        <p></p><p></p>
                        <form class="input-group mb-3" method="GET" action="/home">
                            <button type="submit" class="btn  btn-lg  btn-danger">No</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Ashra Iwan\Desktop\fyp eas latest update\EAS - Copy\resources\views/events/application/create.blade.php ENDPATH**/ ?>