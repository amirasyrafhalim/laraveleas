<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1>Events</h1>
        <div class="row">
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <div class="card-header">
                        Filter results
                    </div>
                    <div class="card-body">
                        <form class="input-group mb-5 flex-column" method="GET" action="/events">
                            <div>
                                <span>Search Anything...</span>
                                <input type="text" name="description" class="form-control" value="<?php echo e(Request::input('description')); ?>">
                            </div>
                            <div>
                                <span>By Title</span>
                                <input type="text" name="title" class="form-control" value="<?php echo e(Request::input('title')); ?>">
                            </div>
                                <div>
                                    <span>By Location</span>
                                    <select name="location" class="form-control" id="inlineFormCustomSelect">
                                    <option value="" selected>---Location---</option>
                                    <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option  <?php echo e($locations == $code ? 'selected' : ''); ?> value="<?php echo e($code); ?>"><?php echo e($name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div>
                                    <span>By Category</span>
                                    <select name="category_id" class="form-control" id="inlineFormCustomSelect">
                                    <option value="" selected>---Category---</option>
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option  <?php echo e($categories == $category ? 'selected' : ''); ?> value="<?php echo e($category->id); ?>"><?php echo e($category->title); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            <div class="mt-2">
                                <span>By Price</span>
                                <div class="flex-row">
                                    <input type="radio" name="price" id="price_asc" value="asc" <?php echo e(Request::input('price') == 'asc' ? 'checked' : ''); ?>>
                                    <label for="price_asc">Ascending</label>
                                </div>
                                <div class="flex-row">
                                    <input type="radio" name="price" id="price_desc" value="desc" <?php echo e(Request::input('price') == 'desc' ? 'checked' : ''); ?>>
                                    <label for="price_desc">Descending</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-outline-primary mt-2">Filter</button>
                        </form>
                    </div>
                    <form class="input-group mb-3 flex-column" method="GET" action="/events">
                        <button type="submit" class="btn btn-outline-primary mt-2">Reset</button>
                    </form>
                </div>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <?php $__empty_1 = true; $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php if($event->verified_by_admin == 1): ?>
                        <div class="col-md-6 mb-3">
                            <div class="card" style="width: 18rem;">
                                <img src="<?php echo e($event->default_image_path); ?>" class="card-img-top img-fluid" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><a href="/events/<?php echo e($event->slug()); ?>"><?php echo e($event->title); ?></a></h5>
                                    <h6 class="card-title"><?php echo e($event->created_at->diffForHumans()); ?> by <a href="/users/<?php echo e($event->author->id); ?>"><?php echo e($event->author->name); ?></a></h6>
                                    <h6 class="card-title">Date of event : <?php echo e($event->parsedEventDate); ?></h6>
                                    <h6 class="card-title">Category: <?php echo e($event->category->title); ?></h6>
                                    <?php if($event->price == 0): ?>
                                    <h6 class="card-title">Price: Free</h6>
                                    <?php else: ?>
                                    <h6 class="card-title">Price: <?php echo e($event->price ? 'RM' . $event->price : ''); ?>

                                     <?php endif; ?>
                                    <h6 class="card-title">Location: <?php echo e($event->location); ?></h6>
                                    <h6 class="card-title">Description: <?php echo e($event->description); ?></h6>
                                    <h6 class="card-title">Official Website: <?php echo e($event->website); ?></h6>
                                    <a href="/events/<?php echo e($event->slug()); ?>" class="btn btn-primary">Learn More</a>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p>No event found</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Ashra Iwan\Desktop\fyp eas latest update\EAS - Copy\resources\views/events/index.blade.php ENDPATH**/ ?>