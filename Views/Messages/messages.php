<?php

$userTo= $_GET['userID'];
$sessionID= $_SESSION['user']['id'];
$session = $_SESSION['user'];
$now = date("Y-m-d H:i:s");

    if (isset($data['userBan'])) {

        $ban = $data['userBan']['ban'];
    }
?>
    <br/><h2>Messeges with <a href="user-profile?userID=<?= $data['with']['withID'] ?>"> <?= $data['with']['user_name'] ?></a></h2><br/><br/>
<?php
        if (isset($data['messages'])) :

            if ($data['messages'] != null) : ?>


  <div class="card my-4">

         <?php foreach ($data['messages'] as $message) :  ?>

      <div class="media mb-4">

             <?php if ($message['src']!= null) : ?>

                 <img class="d-flex mr-3 rounded-circle" src="public/<?= $message['src'] ?>" alt="<?= $message['alt'] ?>" width="50px;" height="50px;">
            <?php else : ?>
                 <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRD1Y3-bjRgfyWDgfLqeP3fWc2wSIcluuxHIw&usqp=CAU" alt="user picture"  width="50px;" height="50px;" />
            <?php endif; ?>

          <div class="media-body">
                 <h5 class="mt-0"><a href="user-profile?userID=<?= $message['userID'] ?>"><?= $message['user_name'] ?></a></h5> <p><?= date("F jS Y , H:i", strtotime($message['createdAT'])) ?></p>

                 <p>"<?= $message['content'] ?>" </p> <p style="color: blue"> <?= (isset($message['updatedAT'])) ? "Edited : ".date("F jS Y , H:i", strtotime($message['updatedAT'])) : ''  ?></p>
              <?php  if ($message['seen']) : ?>

                  <p style="color: red;">seen</p>

              <?php endif; ?>

              <?php  if($_SESSION['user']['id'] == $message['user_from']) : ?>

                 <a href="update-message-form?messageID=<?= $message['messageID'] ?>&userID=<?=$userTo ?>"><input type="submit" value="Edit" class="btn-primary"></a>
                 <a href="delete-message?messageID=<?= $message['messageID']?>&userID=<?=$userTo ?>"><input type="submit" value="Delete" class="btn-primary"></a>

            <?php endif;

                         if ($_SESSION['user']['role_name'] == "Operator") : ?>

                             <a href=""><input type="submit" value="Ban" class="btn-primary"></a>

                        <?php
                        endif;
                        ?>
          </div>
      </div>

    <?php

    endforeach;

    else:

        echo "<h2>You dont have any message yet</h2>";

   endif;
    ?>
        <h5 class="card-header">Leave a Message:</h5>
        <div class="card-body">

            <form action="<?= isset ($_SESSION['oneMessage']) ? 'update-message?userID='.$userTo.'&messageID='.$_SESSION['oneMessage']['id']  : 'send-message?userID='.$userTo?> " method="POST">

                <div class="form-group">
                    <textarea class="form-control" rows="3" name="content">

                        <?= isset($_SESSION['oneMessage']) ? $_SESSION['oneMessage']['content'] : ''  ?>
                    </textarea>
                </div>
                <?php if ($ban <= $now || $ban == null) : ?>

                     <input type="submit" value="<?= isset($_SESSION['oneMessage']) ? 'Update message' : 'Send message'  ?>" name="submitInsertUpdate" class="btn-primary"/>
                <?php
                     else :
                     echo "You cant send message, beacuse you have a ban until : " . date("F jS Y , H:i:s", strtotime($data['userBan']['ban']));
                     endif;
                ?>

            </form>

        </div>

</div>
        <div class="alert-danger">
            <?php
            if (isset($_SESSION['messageErrors'])) {

                foreach ($_SESSION['messageErrors'] as $error) {

                    echo $error. "<br/>";
                }
            }
            ?>
        </div>

<?php
    else :

        echo "<h2>You dont have any messages yet</h2>";

   endif;

unset($_SESSION['oneMessage']);
unset($_SESSION['messageErrors']);
?>