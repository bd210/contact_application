<?php

    if (isset($data['contacts']) && $data['contacts'] != null) :

?>
<table>
    <tr>

        <th>Username</th>
        <th>Number</th>
        <th>Email</th>
        <th>Picture</th>
        <th>Contact from</th>
        <th>View profile</th>
        <th>Message</th>
        <th>Favorite</th>
        <th>Kick</th>
    </tr>
        <?php foreach ($data['contacts'] as $contact) :  ?>
    <tr>

        <td> <?= $contact['user_name'] ?></td>
        <td> <?= $contact['number'] ?></td>
        <td> <?= $contact['email'] ?></td>
        <td>
            <?php if ($contact['src'] != null) : ?>
                <img src="public/<?= $contact['src'] ?>" alt="<?= $contact['alt'] ?>"  width="50px;" height="50px;" />
            <?php else: ?>
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRD1Y3-bjRgfyWDgfLqeP3fWc2wSIcluuxHIw&usqp=CAU" alt="user picture"  width="50px;" height="50px;" />
            <?php endif;?>

        </td>
        <td><?= date("F jS Y , H:i:s", strtotime($contact['createdAT'])) ?></td>
        <td> <a href="user-profile?userID=<?=$contact['userID']?>"> <input type="submit" value="View" class="btn-primary"></a></td>
        <td><a href="messages-view?userID=<?=$contact['userID']?>"><input type="submit" value="Send" class="btn-primary"></a> </td>
        <td> <a href="add-favorites?userID=<?=$contact['userID']?>"> <input type="submit" value="Add" class="btn-primary"></a></td>
        <td> <a href="kick-contacts?userID=<?=$contact['userID']?>"> <input type="submit" value="Kick" class="alert-danger"></a></td>

    </tr>
    <?php endforeach; ?>

</table>


<?php

else:

    echo "<h1>You dont have any contact yet!</h1>";

endif;
?>
