<?php

    if (isset($data['favorites']) && $data['favorites'] != null) :
        $number = 1;
?>
<table>
    <tr>
        <th>Num</th>
        <th>Username</th>
        <th>Number</th>
        <th>Email</th>
        <th>Picture</th>
        <th>Country</th>
        <th>View profile</th>
        <th>Kick</th>
    </tr>
     <?php foreach ($data['favorites'] as $favorite) : ?>
    <tr>
        <td><?= $number++?></td>
        <td><?= $favorite['user_name'] ?></td>
        <td><?= $favorite['number'] ?></td>
        <td><?= $favorite['email'] ?></td>
        <td>
            <?php if ($favorite['src'] != null) : ?>
                <img src="public/<?= $favorite['src'] ?>" alt="<?= $favorite['alt'] ?>"  width="50px;" height="50px;" />
            <?php else: ?>
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRD1Y3-bjRgfyWDgfLqeP3fWc2wSIcluuxHIw&usqp=CAU" alt="user picture"  width="50px;" height="50px;" />
            <?php endif;?>
        </td>
        <td><?= $favorite['country_name'] ?></td>
        <td> <a href="user-profile?userID=<?=$favorite['userID']?>"> <input type="submit" value="View" class="btn-primary"></a></td>
        <td><a href="kick-favorites?userID=<?= $favorite['userID2']?>"><input type="submit" value="Kick" CLASS="alert-danger"/></a> </td>
    </tr>
        <?php endforeach; ?>
</table>
<?php

else:

    echo "<h1>You dont have any favorite contact yet!</h1>";

endif;
?>
