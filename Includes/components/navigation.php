<!-- Navigacija -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="index.php">Start Bootstrap</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <?php if(!isset($_SESSION['user'])): ?>
                <li class="nav-item">
                    <a class="nav-link" href="create">Registration</a>
                </li>


                <?php endif; ?>


                <?php if(isset($_SESSION['user'])): ?>
                    <?php
                        if($_SESSION['user']['role_name'] == 'Admin' || $_SESSION['user']['role_name'] == 'Operator'):
                    ?>
                            <li class="nav-item ">
                                <a class="nav-link" href="control-view">Control</a>
                            </li>
                        <?php endif;?>
                    <li class="nav-item">
                        <a class="nav-link" href="contacts-all">My Contacts</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="requests-all">Requests</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="favorites-contact">Favorites Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="update-from">Update profile</a>
                    </li>
                    <li class="nav-item">
                         <a class="nav-link" href="logout">Logut</a>
                    </li>


                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<!--// Navigacija -->