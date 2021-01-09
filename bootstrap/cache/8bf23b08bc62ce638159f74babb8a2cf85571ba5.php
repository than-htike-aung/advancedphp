
<div class="container-fluid bg-dark">

    <nav class="container navbar navbar-expand-lg navbar-light bg-faded">
        <a class="navbar-brand english text-white" href="/">
                <img src="<?php echo e(asset("images/coder.jpg")); ?>" style="width: 30px" height="30px" class="rounded"/>
                <span class="ml-3">Online Shopping</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fa fa-list text-white"></i>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav  ml-auto">
            <li class="nav-item active">
              <a class="nav-link english text-white" href="/">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link english text-white" href="/admin">Admin Panel</a>
            </li>
            <li class="nav-item">
              <a class="nav-link english text-white" href="/cart">
                Cart
                <span class="badge badge-danger badge-pill" style="position: relative; top:-10px; left:-5px" id="cart-count">0</span>
              </a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle english text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <?php if(\App\classes\Auth::check()): ?>
                      <?php echo e(\App\classes\Auth::user()->name); ?>

                  <?php else: ?>
                      Member
                  <?php endif; ?>
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <?php if(\App\classes\Auth::check()): ?>
                      <a class="dropdown-item english" href="/user/logout">Logout</a>
                  <?php else: ?>
                      <a class="dropdown-item english" href="/user/login">Login</a>
                      <a class="dropdown-item english" href="/user/register">Register</a>
                  <?php endif; ?>




              </div>
            </li>
            
          </ul>
         
        </div>
      </nav>

</div>

