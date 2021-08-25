<?php


class LoginController extends Controller
{

    public function login()
    {
        try {

                $user = new User();

                    if (isset($_COOKIE['email'])) {

                        $user->email = $_COOKIE['email'];

                        $user->pass = $user->getPwdUser()['password'];

                        $_SESSION['pwd'] = $user->pass;

                            if (!isset($_POST['remember'])) {

                                setcookie('email', '', time() - 3600, null, null, true, false);
                                unset($_SESSION['pwd']);

                            }

                    } else {

                        $email = $_POST['email'];
                        $pass = $_POST['password'];

                        $user->email = $email;
                        $user->pass = md5($pass);

                        $expires = time() + 3600 * 24 * 30;

                            if (isset($_POST['remember'])) {

                                setcookie('email', $email, $expires, null, null, true, false);

                            }

                        }

                $result = $user->login();

                    if ($result) {

                        $_SESSION['user'] = $result;

                        header("Location:index.php");

                    } else {

                        $this->data['unsuccess'] = "Email or password is incorrect";
                        $this->returnView('home', $this->data);

                    }

            } catch (Exception $e) {

                echo "An error occurred, please contact the administrator";

            }

    }


    public function logout()
    {

        unset($_SESSION['user']);
        header("Location: index.php");


    }


    public function resetPasswordForm()
    {

        $this->returnView('reset-password');

    }


    public function resetNewPasswordForm()
    {

        $this->returnView('create_new_password');

    }


    public function resetPassword()
    {
        try {

                if (isset($_POST['reset-request-submit'])) {

                        $user = new User();

                        $selector = bin2hex(random_bytes(8));
                        $token = random_bytes(32);


                        $url = "localhost/application/reset_new_password_form?selector=".$selector.
                        "&validator=".bin2hex($token) ;

                        $expires = time() + 1800;

                        $email = $_POST['emailReset'];

                        $user->deleteResetPwd($email);

                        $hashedToken = password_hash($token, PASSWORD_DEFAULT);

                        $user->email = $email;
                        $user->token = $hashedToken;
                        $user->selector = $selector;
                        $user->expires = $expires;

                        $user->insertResetPwd();

                        $to = $email;
                        $subject = "Reset your password";

                        $message = "<p>We recieved a password reset request. 
                        The link for reset your password make this request
                        , you can ingore this email  </p>";

                        $message .= "<p>Here is your password link : <br/>";
                        $message .= "<a href='".$url."'>'".$url."'</a></p>";

                        $headers = "From : boris <boris.dmitrovic.17.09@gmail.com>\r\n";

                        $headers .= "Replay to : boris.dmitrovic.17.09@gmail.com \r\n";
                        $headers .= "Content-type : text/html\r\n";

                        $send =  mail($to,$subject, $message,$headers);


                           if ($send) {

                               $this->data['success'] = "Check your mail";

                           }  else {

                               $this->data['unsuccess'] = "An error occurred";

                           }

                    $this->returnView('home', $this->data);


                } else {

                        $this->data['unsuccess'] = "You dont have permission";

                        $this->returnView('home', $this->data);

                }

        } catch (Exception $e) {

            echo "An error occurred, please contact the administrator";

        }

    }


    public function createNewPassword()
    {
        try {

                $user = new User();

                    if (isset($_POST['reset-password-submit'])) {

                        $selector = $_POST['selector'];

                        $pass = $_POST['pwd'];
                        $pass2 = $_POST['pwd2'];

                            if (empty($pass) || empty($pass2)) {

                                echo "New and Confirm password are required";
                                exit();

                            } elseif ($pass != $pass2) {

                                echo "New and Confirm password must be same!";
                                exit();

                            }


                        $currentDate = time();

                        $user->selector = $selector;
                        $user->expires = $currentDate;

                        $userOne = $user->selectResetPwd();


                                if ($selector === $user->selector) {

                                    $tokenEmail = $userOne['email'];

                                    $result = $user->selectUsersResetPwd($tokenEmail);


                                        if (!$result) {

                                            echo "There was an error";

                                        } else {

                                            $newPwdHash = md5($pass);

                                            $user->updateUsersResetPwd($newPwdHash,$tokenEmail);

                                            $user->deleteResetPwd($tokenEmail);

                                            $this->data['success'] = "You have successfuly updated your password";


                                            self::returnView('home', $this->data);


                                        }

                                }

                    } else {

                        $this->data['unsuccess'] = "You dont have permission";

                        self::returnView('home', $this->data);

                    }

        } catch (Exception $e)  {

                echo "An error occurred, please contact the administrator";

        }

    }
}