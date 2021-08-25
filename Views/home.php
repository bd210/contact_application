<?php

if (isset ($data['success'])) : ?>

<div class="alert-success"><?= $data['success'] ?></div>

<?php elseif (isset ($data['unsuccess'])) : ?>

<div class="alert-danger"><?= $data['unsuccess'] ?></div>
<?php
endif;
if (isset ($_SESSION['user'])) :

    if (isset ($data['countRequest']) && $data['countRequest'] != null )

    echo "<h3 style='color: red'>You have <a href='requests-all'>". count($data['countRequest']). " " ."request/s</a> for contact! </h3>";

   include_once "Includes/components/search.php";

    if (isset ($data['users']) && $data['users'] != null) :

        if (isset ($_GET['search']) && strlen($_GET['search']) != 0) :
?>
<br/>

<table>
    <tr>
            <th>Username</th>
            <th>Organization</th>
            <th>Number</th>
            <th>Picture</th>
            <th>Country</th>
            <th>Add</th>
            <th>View profile</th>
    </tr>
        <?php foreach ($data['users'] as $user) :  ?>
    <tr>

            <td><?= $user['user_name'] ?> </td>
            <td><?= $user['organization'] ?> </td>
            <td><?= $user['number'] ?> </td>

            <td>
                <?php if ($user['src'] != null) : ?>
                    <img src="public/<?= $user['src'] ?>" alt="<?= $user['alt'] ?>"  width="50px;" height="50px;" />
                <?php else : ?>
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRD1Y3-bjRgfyWDgfLqeP3fWc2wSIcluuxHIw&usqp=CAU" alt="user picture"  width="50px;" height="50px;" />
                <?php endif;?>
            </td>
            <td><?= $user['country_name'] ?></td>
            <td><a href="send-request?userID=<?=$user['userID'] ?>"><input type="submit" value="Add" class="btn-primary"></a> </td>
            <td><a href="user-profile?userID=<?=$user['userID'] ?>"><input type="submit" value="View Profile" class="btn-primary"></a> </td>
    </tr>
    <?php endforeach; ?>
</table>

<?php
    else :
        echo "<h1>FIND USERS BY USERNAME, EMAIL OR NUMBER</h1>";
    endif;


        else :
                echo "<h1>THERE ARE NO RESULTS</h1>";

        endif;
else :
        echo "<h1>In order to find and add users, you have to login first</h1>";
endif;
?>

