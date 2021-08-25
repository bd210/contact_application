<?php

    if (isset($data['requests']) and $data['requests'] != null) :
        $number = 1;
?>

    <h3>My requests for contact</h3>
    <table>
        <tr>
            <th>Num</th>
            <th>Username</th>
            <th>Organization</th>
            <th>Number</th>
            <th>Email</th>
            <th>Picture</th>
            <th>Country</th>
            <th>View profile</th>
            <th>Accept/Decline</th>
        </tr>

         <?php foreach ($data['requests'] as $request) :  ?>
            <tr>
                <td><?= $number++ ?></td>
                <td><?= $request['user_name'] ?></td>
                <td><?= $request['organization'] ?></td>
                <td><?= $request['number'] ?></td>
                <td><?= $request['email'] ?></td>
                <td>
                    <?php if ($request['src'] != null) : ?>
                        <img src="public/<?= $request['src'] ?>" alt="<?= $request['alt'] ?>"  width="50px;" height="50px;" />
                    <?php else: ?>
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRD1Y3-bjRgfyWDgfLqeP3fWc2wSIcluuxHIw&usqp=CAU" alt="user picture"  width="50px;" height="50px;" />
                    <?php endif;?>
                </td>
                <td><?= $request['country_name'] ?></td>
                <td> <a href="user-profile?userID=<?=$request['userID']?>"> <input type="submit" value="View" class="btn-primary"></a></td>
                <td>
                    <a href="add-contact?userID=<?=$request['userID']?>&requestID=<?=$request['pendingID'] ?>"><input type="submit" value="Accept" name="submitAccept" style="background-color: blue;" /></a>
                    <a href="decline?requestID=<?= $request['pendingID'] ?>"><input type="submit" value="Decline" name="submitDecline"style="background-color: red;" /></a>
                </td>
            </tr>
            <?php endforeach;?>
    </table>


<?php

else:

    echo "<h1>You dont have any request yet!</h1>";

endif;
?>