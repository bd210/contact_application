<?php

    if (isset ($data['details']) && $data['details'] != null) :

?>

<h2>Update your profile</h2>
<form action="update-profile" method="POST" enctype="multipart/form-data">

    <div class="form-group">
        <label>Username : </label>
        <input type="text" name="username" class="form-control" value="<?= $data['details']['user_name'] ?>">
    </div>
    <div class="form-group">
        <label>Organization : </label>
        <input type="text" name="organization" class="form-control" value="<?= $data['details']['organization'] ?>">
    </div>
    <div class="form-group">
        <label>Number : </label>
        <input type="text" name="number" class="form-control" value="<?= $data['details']['number'] ?>">
    </div>
    <div class="form-group">
        <label>Email : </label>
        <input type="text" name="email" class="form-control" value="<?= $data['details']['email'] ?>">
    </div>

    <div class="form-group">
        <label>Notes : </label>
        <textarea name="notes" rows="5" cols="30" > <?= $data['details']['notes'] ?>   </textarea>
    </div>
    <div class="form-group">
        <label>Picture : </label>

        <?php if ($data['details']['src'] != null) : ?>
            <img src="public/<?= $data['details']['src'] ?>" alt="<?= $data['details']['alt'] ?>"  width="200px;" height="200px;" />
        <?php
          else :

              echo "You dont have profile picture!";

        endif;
        ?>

        <input type="hidden" name="hiddenPicture" value="<?= $data['details']['src']?>">
        <input type="file" name="file" class="form-control">
    </div>
    <div class="form-group">
        <label>Country : </label>
        <select name="country">
            <option value="<?= $data['details']['countryID'] ?>"><?= $data['details']['country_name'] ?></option>

        <?php  if (isset ($data['countries'])) :
                foreach ($data['countries'] as $country) :
        ?>
                    <option value="<?= $country['id'] ?>"><?= $country['country_name'] ?></option>

        <?php
          endforeach;

            else : echo "No country exists";

          endif;
         ?>
        </select>
    </div>
    <a href="update-password-form?userID=<?= $data['details']['userID'] ?>">Update password</a> <br/>



    <input type="submit" value="Update" class="btn-dark" name="submitUpdateUser"> <br/>

    <div class="alert-danger">
        <?php
            if (isset ($data['errors'])) {

                foreach ($data['errors'] as $error)  {

                    echo $error. "<br/>";

                }
            }
        ?>
    </div>
</form>

<?php

    else :

        echo "YOU ARE NOT LOGINED";

    endif;

?>