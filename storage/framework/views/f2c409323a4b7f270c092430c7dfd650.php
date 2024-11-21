<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($post->title); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo e(asset('/css/style.css')); ?>" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <div class="d-flex justify-content-end">
        <a href="<?php echo e(url()->previous()); ?>" class="btn btn-secondary">&larr; Back</a>
    </div>

    <h1 class="text-primary"><?php echo e($post->title); ?></h1>
    <p class="text-secondary"><?php echo e($post->content); ?></p>

    <h2 class="mt-4">Comments</h2>
    <?php $__currentLoopData = $post->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="card my-3">
            <div class="card-body">
                <p class="card-text"><?php echo e($comment->content); ?></p>
            </div>
            <?php $__currentLoopData = $comment->replies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="card mx-4 my-2">
                    <div class="card-body bg-light">
                        <p class="card-text"><?php echo e($reply->content); ?></p>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <h3 class="mt-4">Add Comment</h3>
    <form action="<?php echo e(route('comments.store', $post)); ?>" method="POST" class="mt-3">
        <?php echo csrf_field(); ?>
        <div class="mb-3">
            <textarea name="content" class="form-control" rows="4" placeholder="Write your comment..." required></textarea>
        </div>
        <input type="hidden" name="post_id" value="<?php echo e($post->id); ?>">
        <input type="hidden" name="parent_comment_id" value="<?php echo e(old('parent_comment_id')); ?>">
        <button type="submit" class="btn btn-primary">Submit Comment</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\comment-system\resources\views/posts/show.blade.php ENDPATH**/ ?>