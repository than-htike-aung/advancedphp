<?php $__env->startSection('title', 'User Register'); ?>

<?php $__env->startSection('content'); ?>

    <div class="container my-5">
        <div class="col-md-8 offset-md-2">
            <h1 class="mb-5 text-center text-info english">User Register</h1>
            <?php if(\App\classes\Session::has("error_message")): ?>
                <?php echo e(\App\classes\Session::flash("error_message")); ?>

            <?php endif; ?>
            <form action="/user/register" method="post">
                <input type="hidden" name="token" value="<?php echo e(\App\Classes\CSRFToken::__token()); ?>">
                <div class="form-group">
                    <label for="email">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                </div>

                <div class="row justify-content-between no-gutters">
                    <a href="/user/login">Already register! please login here</a>
                    <span>
                        <button class="btn btn-outline-warning btn-sm">Cancel</button>
                        <button class="btn btn-primary btn-sm">Register</button>
                    </span>
                </div>
            </form>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>