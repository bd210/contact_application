<?php
$now = date("Y-m-d H:i:s");

if (isset ($data['userProfile']) && $data['userProfile'] != null) :

    $userID = $data['userProfile']['userID'];

         if (isset ($_SESSION['user']) && $_SESSION['user']['role_name'] == 'Admin') :
    ?>
    <form action="ban-user?userID=<?= $userID?>" method="post">
        <input type="number" placeholder="in minutes" name="ban">
        <input type="submit" value="Ban user" name="submitBan" class="alert-dark">
    </form><br/><br/>
    <div class="alert-danger">
        <?php
        if (isset( $_SESSION['banErrors'])) {

            foreach ( $_SESSION['banErrors'] as $error) {

                echo $error . "<br/>";

            }
        }
        ?>
    </div>
        <?php
         endif;
        ?>
    <h6>REGISTERED SINCE : </h6> <p style="color: blue;"><?= date("F jS Y ", strtotime($data['userProfile']['created_at'])) ?></p>
    <?php
            if ($data['userProfile']['ban'] && $data['userProfile']['ban'] > $now ) {

                echo "<p style='color: red;'>User has ban until : " . date("F jS Y h:i:s A", strtotime($data['userProfile']['ban'])) ." <a href='user-profile?userID=".$data['userProfile']['bannedFrom']."'>by admin</a></p><br/>";

                echo "<form action='unban-user?userID=$userID' method='post'> <input type='submit' value='Unban' class='btn-primary'> </form><BR/>";
            }

    ?>

    <?php if ($data['userProfile']['src'] != null) : ?>

        <img src="public/<?= $data['userProfile']['src']?>" alt="<?= $data['userProfile']['alt']?>"  width="200px;" height="200px;"/>

    <?php

         else :
    ?>
         <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRD1Y3-bjRgfyWDgfLqeP3fWc2wSIcluuxHIw&usqp=CAU" alt="user picture"  width="200px;" height="200px;" />
    <?php

        endif;
    ?>
    <h6>Username : </h6> <p class="ppp"><?= $data['userProfile']['user_name'] ?></p>
    <h6>Organization : </h6> <p class="ppp"><?= $data['userProfile']['organization'] ?></p>
    <h6>Email : </h6> <p class="ppp"><?= $data['userProfile']['email'] ?></p>
    <h6>Number : </h6> <p class="ppp"><?= $data['userProfile']['number'] ?></p>
    <h6>Notes : </h6> <p class="ppp"><?= $data['userProfile']['notes'] ?></p>
    <h6>Country : </h6> <p class="ppp"><?= $data['userProfile']['country_name'] ?></p>
    <h6>Role : </h6> <p class="ppp"><?= $data['userProfile']['role_name'] ?></p>
<?php

else:

    echo "<h2>USER DOES NOT EXIST</h2>";

endif;


unset($_SESSION['banErrors']);
?>
