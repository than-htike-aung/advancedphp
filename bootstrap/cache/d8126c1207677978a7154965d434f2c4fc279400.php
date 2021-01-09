<?php $__env->startSection('title', 'User Login'); ?>

<?php $__env->startSection('content'); ?>

    <div class="container my-5">
        <div class="col-md-8 offset-md-2">
            <h1 class="mb-5 text-center text-info english">User Login</h1>

            <?php if(\App\classes\Session::has("success_message")): ?>
                <?php echo e(\App\classes\Session::flash("success_message")); ?>

            <?php endif; ?>

            <?php if(\App\classes\Session::has("error_message")): ?>
                <?php echo e(\App\classes\Session::flash("error_message")); ?>

            <?php endif; ?>

            <form action="/user/login"method="post">
                  <input type="hidden" name="token" value="<?php echo e(\App\Classes\CSRFToken::__token()); ?>">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <div class="row justify-content-between no-gutters">
                    <a href="/user/register">Not member yet! Please Register Here!</a>
                    <span>
                        <button class="btn btn-outline-warning btn-sm">Cancel</button>
                        <button class="btn btn-primary btn-sm">Login</button>
                    </span>
                </div>
            </form>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>