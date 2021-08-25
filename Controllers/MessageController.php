<?php


class MessageController extends Controller
{



    public function messages()
    {

        $user = new User();
        $message = new Message();

            if (isset($_SESSION['user'])) {

                $message->userFrom = $_SESSION['user']['id'];
                $user->id = $_SESSION['user']['id'];

            }

        $message->userTo = $_GET['userID'];

        $this->data['messages'] = $message->getMessages();
        $this->data['with'] = $message->typeWith();
        $this->data['userBan'] = $user->getUserForBan();

        $this->returnView('messages', $this->data);

    }



    public function sendMessage()
    {

        try {

             $message = new Message();

                if (isset($_POST['submitInsertUpdate'])) {

                    $userTo = $_GET['userID'];
                    $validation = new MessageValidation($_POST);

                    $this->data['errors'] = $validation->validateForm();

                    $_SESSION['messageErrors'] = $this->data['errors'];

                        if (count($this->data['errors']) > 0) {

                            header("Location: messages-view?userID=$userTo");

                        } else {

                                if (isset($_SESSION['user'])) {

                                    $message->userFrom = $_SESSION['user']['id'];

                                }

                                $message->userTo = $userTo;
                                $message->createdAT = date("Y-m-d H:i:s");
                                $message->content = $_POST['content'];
                                $message->seen = null;

                                $message->sendMessage();

                                header("Location: messages-view?userID=$userTo");


                        }

                }  else {

                    echo "You have to click send button";

                }

        } catch (Exception $e) {

            echo "An error occurred, please contact the administrator" . $e->getMessage();

        }

    }



    public function deleteMessage()
    {

        try {

            $message = new Message();

            $userTo = $_GET['userID'];

                if (isset($_SESSION['user'])) {

                    $message->userFrom = $_SESSION['user']['id'];

                }

            $message->id = $_GET['messageID'];

            $message->deleteMessage();

            header("Location: messages-view?userID=$userTo");



           } catch (Exception $e) {

            echo "An error occurred, please contact the administrator";

           }

    }



    public function showCommentForEdit()
    {

            $message = new Message();

            $userTo = $_GET['userID'];
            $message->id = $_GET['messageID'];

            $_SESSION['oneMessage'] = $message->getOne();

            header("Location: messages-view?userID=$userTo");

    }



    public function updateMessage()
    {

        try {

                $message = new Message();

                    if (isset($_POST['submitInsertUpdate'])) {

                        $userTo = $_GET['userID'];

                        $validation = new MessageValidation($_POST);
                        $this->data['errors'] = $validation->validateForm();

                        $_SESSION['messageErrors'] = $this->data['errors'];

                            if (count($this->data['errors']) > 0) {

                                 header("Location: messages-view?userID=$userTo");

                            } else {

                                $message->id = $_GET['messageID'];
                                $message->content = $_POST['content'];
                                $message->updatedAT = date("Y-m-d H:i:s");


                                $message->updateMessage();

                                header("Location: messages-view?userID=$userTo");

                            }

                    } else {

                        echo "You have to click update button";

                    }

        } catch (Exception $e) {

            echo "An error occurred, please contact the administrator";

        }

    }






}