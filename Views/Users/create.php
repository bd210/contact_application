<?php
    if (isset ($_POST['country'])) {

        $cntID = $_POST['country'];

    }

?>
<?php if (!isset ($_SESSION['user'])) : ?>
    <h2>Create account</h2>
    <form action="store" method="POST" enctype="multipart/form-data">

        <div class="form-group">
            <label>Username : </label>
            <input type="text" name="username" class="form-control" value="<?= isset ($data['createParams']['username']) ? $data['createParams']['username']:"" ?>" >
        </div>
        <div class="form-group">
            <label>Organization : </label>
            <input type="text" name="organization" class="form-control" value="<?= isset ($data['createParams']['organization']) ? $data['createParams']['organization']:"" ?>">
        </div>
        <div class="form-group">
            <label>Number : </label>
            <input type="text" name="number" class="form-control" value="<?= isset ($data['createParams']['number']) ? $data['createParams']['number']:"" ?>">
        </div>
        <div class="form-group">
            <label>Email : </label>
            <input type="text" name="email" class="form-control" value="<?= isset ($data['createParams']['email']) ? $data['createParams']['email']:"" ?>">
        </div>
        <div class="form-group">
            <label>Password : </label>
            <input type="password" name="password" class="form-control" value="<?= isset ($data['createParams']['pass']) ? $data['createParams']['pass']:"" ?>">
        </div>
        <div class="form-group">
            <label>Notes : </label>
            <textarea name="notes" rows="5" cols="30" > <?= isset ($data['createParams']['notes']) ? $data['createParams']['notes']:"" ?></textarea>
        </div>
        <div class="form-group">
            <label>Picture : </label>
            <input type="file" name="file" class="form-control">
        </div>
        <div class="form-group">
            <label>Country : </label>
            <select name="country">
                <option value="<?= isset ($data['createParams']['country']) ? $data['createParams']['country']: 0 ?>"><?= isset($data['createParams']['country']) && $cntID != 0  ? $data['country_name'][1] : 'Choose country...'?></option>
                <?php

                if (isset ($data['countries'])) :

                    foreach ($data['countries'] as $country) :
                        ?>
                        <option value="<?=$country['id'] ?>"> <?= $country['country_name']  ?></option>
                    <?php
                    endforeach;
                endif;
                ?>
            </select>
        </div>
        <div class="alert-danger">
            <?php
            if (isset($data['errors'])) {

                foreach ($data['errors'] as $error) {

                    echo $error. "<br/>";
                }
            }
            ?>
        </div>
        <input type="submit" value="Create" class="btn-dark" name="submitCreateUser">
    </form>
<?php

else :
    echo "<h1>You are already logined</h1>";

endif;
?>
