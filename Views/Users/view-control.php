<?php

    $number= 1;
    if (isset ($data['control']) && $data['control'] != null):

?>
<h2>Control spam</h2>

<table >

    <?php
        if (isset ( $_SESSION['banErrors'])) {

            foreach ( $_SESSION['banErrors'] as $error) {

                echo $error . "<br/>";

            }
        }
    ?>
    <tr>
        <th>Number</th>
        <th>Username</th>
        <th>Sent messages</th>
        <th>Received Messages </th>
        <th>Ban</th>
    </tr>

        <?php

        foreach ($data['control'] as $control) :

        ?>
    <tr>
        <td><?= $number++ ?></td>
        <td><a href="user-profile?userID=<?=$control['userID']?>"><?= $control['user_name']  ?></a> </td>
        <td><?= $control['userFrom']?></td>
        <td><?= $control['userTo']?></td>
        <td><a href="user-profile?userID=<?=$control['userID']?>"> <input type="submit" name="submitBan" class="btn-primary" value="Go Ban"/></a></td>
    </tr>

      <?php
        endforeach;
       ?>

</table>

    <?php
    endif;
    ?>