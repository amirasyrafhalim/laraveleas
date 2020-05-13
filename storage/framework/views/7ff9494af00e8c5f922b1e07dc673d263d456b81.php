<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h1><?php echo e($event->title); ?></h1>
                <p>By <a href="/users/<?php echo e($event->author->id); ?>"><?php echo e($event->author->name); ?></a><small><?php echo $event->isOwner() ? "- <a href=\"/events/" . $event->id . "/edit/\">Edit Event</a>" : ''; ?></small>
                    <?php if($event->isOwner()): ?>
                        <span class="badge badge-pill badge-info"><?php echo e(\App\event::STATUS_TYPE[$event->status]); ?></span>
                    <?php endif; ?>
                </p>
                <h4>
                    Category: <?php echo e($event->category->title); ?>

                </h4>
                <?php if($event->price == 0): ?>
                <h4>
                   Price: Free
                </h4>
                <?php else: ?>
                <h4>
                    Price: <?php echo e($event->price ? 'RM' . $event->price : ''); ?>

                </h4>
                 <?php endif; ?>
                <h4>
                    Date of event: <?php echo e($event->parsedEventDate); ?>

                </h4>
                    <h4>Official Website:<a href="https://<?php echo e(($event->website)); ?>"> <?php echo e($event->website); ?> </a></h4>
                <div class="row">
                    <img class="img-fluid" src="<?php echo e($siteurl . $event->getDefaultImage()); ?>" alt="">
                </div>
               
                <h2>All images</h2>
                <div class="row">
                    <?php $__currentLoopData = $imageArr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-6">
                            <img src="<?php echo e($siteurl .  $image->path); ?>" class="img-fluid" alt="">
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

           <?php if(Auth::check() && !Auth::user()->user_type == 1): ?>
            <div class="col-md-4">
                <h3>Join event</h3>
                <?php if($event->isPublished()): ?>
                    <?php if(!$event->isOwner()): ?>
                        <?php if(!Auth::user()->hasAppliedEvent($event) && $event->isRequired()): ?>
                            <a href="/<?php echo e($event->slugWithPrefix()); ?>/apply" class="btn btn-outline-success">Join</a>    
                        <?php elseif(Auth::user()->hasAppliedEvent($event)): ?>
                            You are joining the event
                        <?php elseif(!$event->isRequired()): ?>
                            <h5>This is an open event. Anyone who is interested to go for the event can either message or contact the author of the event</h5>
                        <?php endif; ?>   
                     <?php elseif($event->isOwner()): ?>
                        You are the owner of the event      
                    <?php endif; ?>
                <?php elseif($event->isClosed()): ?>
                    <?php if(!$event->isOwner()): ?>
                    Event will not accepting participants anymore
                    <?php elseif($event->isOwner()): ?>
                    You are the owner of the event
                    <?php endif; ?>
                <?php else: ?>
                    Event has been cancelled
                <?php endif; ?>
            <?php endif; ?>
            <?php if(Auth::check() && !Auth::user()->user_type == 1): ?>
            <div>
                <p></p>
                <h3>Favourite Event</h3>
                <?php if($event->isPublished()): ?>
                    <?php if(!$event->isOwner()): ?>
                        <?php if(!Auth::user()->hasLikedEvent($event)): ?>
                        <form method="POST" action="/<?php echo e($event->slugWithPrefix()); ?>/like">
                            <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn btn-outline-primary">
                                       Like
                                    </button>

                        </form>   
                        <?php else: ?>
                            You have liked the event
                        <?php endif; ?>   
                     <?php elseif($event->isOwner()): ?>
                        You are the owner of the event      
                    <?php endif; ?>
                <?php elseif($event->isClosed()): ?>
                    <?php if(!$event->isOwner()): ?>
                    <h3></h3>
                    <?php elseif($event->isOwner()): ?>
                    You are the owner of the event
                    <?php endif; ?>
                <?php else: ?>
                    Event has been cancelled
                <?php endif; ?>
            <?php endif; ?>
            <div class="col-md-4">
            <?php if(Auth::guest() && $event->isRequired()): ?>
            <h3>Join event</h3>
            Please <a href="/login">sign in</a> or <a href="/register">register</a> to join the event.
            <?php elseif($event->isOpen() && Auth::guest() ): ?>
            <h3>This is an open event. Please <a href="/login">sign in</a> or <a href="/register">register</a> for more. </h3>
            <?php endif; ?>
            </div>
            </div>
            
          
           
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Ashra Iwan\Desktop\fyp eas latest update\EAS - Copy\resources\views/events/show.blade.php ENDPATH**/ ?>