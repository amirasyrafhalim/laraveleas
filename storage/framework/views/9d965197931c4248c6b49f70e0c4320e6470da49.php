<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1>Message with <?php echo e($receiver->name); ?></h1>
        <div class="row">
            <div class="col-md-12">
                <div class="flex-column">
                    <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($message->sender_id == auth()->user()->id): ?>
                            <div class="card mt-3">
                                <div class="card-header">
                                    You said...
                                </div>
                                <div class="card-body">
                                    <p class="text-left mb-0"><?php echo e($message->body); ?></p>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="card mt-3">
                                <div class="card-header">
                                    <p class="text-right mb-0"><?php echo e($message->sender->name); ?> said...</p>
                                </div>

                                <div class="card-body">
                                    <div class="flex-row">
                                        <p class="text-right"><?php echo e($message->body); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Send message
                    </div>
                    <div class="card-body">
                        <div class="flex-row">
                            <form action="/messages/<?php echo e($receiver->id); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <textarea name="body" class="form-control" placeholder="Type your message..."></textarea>
                                <button class="btn btn-outline-primary float-right mt-2">Send</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Ashra Iwan\Desktop\fyp eas latest update\EAS - Copy\resources\views/messages/show.blade.php ENDPATH**/ ?>