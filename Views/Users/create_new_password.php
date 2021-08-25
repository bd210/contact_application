<?php

    $selector = $_GET['selector'];
    $validator = $_GET['validator'];

    if (empty($selector) || empty($validator)) {

        echo "Could not validate your request";

    } else {

            if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false) {

            ?>
     <form action="create-new-password" method="POST">

         <input type="hidden" value="<?= $selector ?>" name="selector">
         <input type="hidden" value="<?= $validator ?>" name="validator">
         <input type="password" name="pwd" placeholder="Enter a new password">
         <input type="password" name="pwd2" placeholder="Confirm new password">

         <button type="submit" name="reset-password-submit" class="btn-dark">Reset password</button>

     </form>

<?php

        }

    }

?>