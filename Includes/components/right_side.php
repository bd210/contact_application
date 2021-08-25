<!-- Desna strana -->

<div class="col-md-4">
<?php if(!isset($_SESSION['user'])): ?>
   <div class="card-group">
       <div class="card my-4">
           <h5 class="card-header">Login</h5>
           <form action="login" method="POST">

               <div class="form-group">
                   <label>Email :</label>
                   <input type="text" name="email" value="<?= isset($_COOKIE['email'])? $_COOKIE['email'] : "" ?>" />
               </div>
               <div class="form-group">
                   <label>Password:</label>
                   <input type="password" name="password" value="<?= isset($_COOKIE['email'])? $_SESSION['pwd']['password'] : "" ?>"/>
               </div>
               <input type="checkbox" name="remember" <?= isset($_COOKIE['email'])? 'checked' : "" ?>>  Remember me  <br/>
               <a href="reset-password-form">  Forgot password? </a> <br/>
               <input type="submit" value="Login" class="btn-primary" >
           </form>


       </div>
   </div>
    <?php endif; ?>


    <div class="card my-4">
        <h5 class="card-header">Categories</h5>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                    <ul class="list-unstyled mb-0">
                        <li>
                            <a href="#">Web Design</a>
                        </li>
                        <li>
                            <a href="#">HTML</a>
                        </li>
                        <li>
                            <a href="#">Freebies</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <ul class="list-unstyled mb-0">
                        <li>
                            <a href="#">JavaScript</a>
                        </li>
                        <li>
                            <a href="#">CSS</a>
                        </li>
                        <li>
                            <a href="#">Tutorials</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="card my-4">
        <h5 class="card-header">Side Widget</h5>
        <div class="card-body">
            You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!
        </div>
    </div>

</div>
<!--// Desna strana -->
