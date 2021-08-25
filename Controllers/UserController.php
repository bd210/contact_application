<?php


class UserController extends  Controller
{


    public  function create()
    {

        $country = new Country();

        $this->data['countries'] = $country->getAllCountries();

        $this->returnView('create', $this->data);


    }



    public function verification()
    {
        $user = new User();

         if (isset($_GET['v_key'])) {

             $user->v_key = $_GET['v_key'];
         }

         $this->data['v_key'] = $user->getVerificationKey();

        $this->returnView('verification', $this->data);

    }



    public function confirmVerification()
    {
        $user = new User();
        $user->v_key = $_GET['v_key'];
        $user->setVerifacionkey();

        $this->data['success'] = "Successfully! You can now login";

        $this->returnView('home', $this->data);
    }



    public  function updateForm()
    {

        $country = new Country();
        $user = new User();

        $this->data['countries'] = $country->getAllCountries();

            if (isset($_SESSION['user'])) {

                $user->id = $_SESSION['user']['id'];

            }

        $this->data['details'] = $user->getMyData();

        $this->returnView('updateForm', $this->data);


    }


    public function userProfile()
    {

        $user = new User();

        $user->id = $_GET['userID'];

        $this->data['userProfile'] = $user->viewProfile();

        $this->returnView('view-profile', $this->data);


    }



    public function updatePasswprdForm()
    {

        $this->returnView('updatePassword',$this->data);

    }


    public function controlView()
    {

        $user = new User();

        $this->data['control'] = $user->getUsersControl();

        $this->returnView('view-control', $this->data);


    }



    public function store()
    {

        try {


             $countryModel = new Country();
             $img = Img::getInstanceOfImg();
             $user = new User();

             $this->data['countries'] = $countryModel->getAllCountries();

                if (isset($_POST['submitCreateUser'])) {

                    $username = $_POST['username'];
                    $organization = $_POST['organization'];
                    $number = $_POST['number'];
                    $email = $_POST['email'];
                    $pass = md5($_POST['password']);
                    $notes = $_POST['notes'];
                    $country = $_POST['country'];
                    $role = 2;
                    $verified = 0;
                    $v_key = md5(time().$username);

                    $validation = new UserValidation($_POST);
                    $this->data['errors'] = $validation->validateForm();

                        if (count($this->data['errors']) > 0) {

                            $countryModel->id = $country;
                            $this->data['country_name'] = $countryModel->getOneCountry();

                            $this->data['createParams'] = ['username' => $username, 'organization' => $organization, 'number' => $number,
                            'email' => $email, 'pass' => $pass, 'notes' => $notes, 'country' => $country];

                            $this->returnView('create', $this->data);

                        } else {


                    $file = $_FILES['file'];
                    $fileTMP = $file['tmp_name'];

                             if (is_uploaded_file($fileTMP)) {

                                 $ext = array('jpg', 'jpeg', 'png');
                                 $maxSize = 1000000;
                                 $path = "images/users/";
                                 $alt = "user picture";
                                 $img->upload($file, $maxSize, $path, $ext);
                                 $src = $img->getSrc();

                             } else {

                                 $alt = null;
                                 $src = null;

                             }

                    $params = array($username, $organization, $number, $email, $pass, $notes, $src, $alt, $country, $role, $verified, $v_key);

                    $user->insertUsers($params);

                        $to = $email;
                        $subject = "Email verification";
                        $message = "Confirm your account ";
                        $message .= "http://localhost/application/confirm?v_key=$v_key";
                        $headers = "From : Boris Dmitrovic <testingforintership@gmail.com";
                        $headers .= "Content-Type: text/html;charset=utf8";

                        mail($to, $subject, $message, $headers);

                    $this->data['success'] = "Check your email to confirm registration";

                    $this->returnView('home', $this->data);

                    }

                } else {

                     echo "You dont have permission";

                }

            } catch (Exception $e) {

                echo "An error occurred, please contact the administrator";

            }


    }


    public function updateProfile()
    {

        try {

            $img = Img::getInstanceOfImg();
            $user = new User();

                if (isset($_POST['submitUpdateUser'])) {

                    $validation = new UserUpdateValidation($_POST);
                    $this->data['errors'] = $validation->validateForm();

                        if (count($this->data['errors']) > 0) {

                            $user->id = $_SESSION['user']['id'];
                            $this->data['details'] = $user->getMyData();

                            $this->returnView('updateForm', $this->data);

                        } else {

                                $user->id = $_SESSION['user']['id'];
                                $user->countryID = $_POST['country'];
                                $user->notes = $_POST['notes'];
                                $user->email = $_POST['email'];
                                $user->number = $_POST['number'];
                                $user->organization = $_POST['organization'];
                                $user->username = $_POST['username'];
                                $user->updatedAT = date("Y-m-d H:i:s");

                                $file = $_FILES['file'];
                                $fileTMP = $file['tmp_name'];

                                    if (is_uploaded_file($fileTMP)) {

                                        $file = $_FILES['file'];
                                        $ext = array('jpg', 'jpeg', 'png');
                                        $maxSize = 1000000;
                                        $path = "images/users/";

                                        $img->upload($file, $maxSize, $path, $ext);

                                        $user->src = $img->getSrc();



                                    } else {

                                        $user->src = $_POST['hiddenPicture'];

                                    }

                                      if (!$user->src == null) {

                                         $user->updateMyProfile();
                                         $this->data['success'] = "You have successfuly updated data";
                                         $this->returnView('home', $this->data);

                                      }


                        }

                } else {

                    echo "You dont have permission";

                }
            } catch (Exception $e)  {

            echo "An error occurred, please contact the administrator";

            }


    }



    public function sendRequest()
    {

        try {

                $user = new User();

                $user_from = $_SESSION['user']['id'];
                $user_to = $_GET['userID'];
                $status = false;

                $params = array($user_from,$user_to,$status);

                $user->sendRequestUsers($params);


                header("Location: index.php");


            } catch (Exception $e) {

                echo "An error occurred, please contact the administrator";

            }

    }



    public function updatePassword()
    {

        try {
                $user = new User();

                $userPassword = $_SESSION['user']['password'];

                $currentPassword = md5($_POST['currentPassword']);

                    if ($currentPassword != $userPassword) {

                        echo "Current password is incorrect";


                    } else {

                        $newPassword = $_POST['newPassword'];
                        $confirmNewPassword = $_POST['confirmNewPassword'];

                            if ($newPassword != $confirmNewPassword) {

                                echo "New password and confirm new password have to be same";


                            } else {

                                if ($newPassword == "") {

                                    echo "New password is required";


                                } else {

                                    $user->pass = md5($newPassword);
                                    $user->id = $_SESSION['user']['id'];

                                    $user->updatePassword();
                                    $this->data['success'] = "Password has been updated";
                                    $this->returnView('home', $this->data);


                                }

                            }

                    }

        } catch (Exception $e) {

             echo "An error occurred, please contact the administrator";

        }

    }



    public function banUser()
    {

        try {

                $user = new User();

                    if (isset($_POST['submitBan']))  {

                        $userID = $_GET['userID'];

                        $banValidation = new BanValidation($_POST);
                        $this->data['errors']  = $banValidation->validateForm();

                            if (count($this->data['errors']) > 0) {

                                $_SESSION['banErrors'] = $this->data['errors'];

                                header("Location: user-profile?userID=$userID");


                            } else {

                                 if (isset($_SESSION['user'])) {

                                     $user->bannedFrom = $_SESSION['user']['id'];

                                 }

                                    $banTime = time() + 60 * $_POST['ban'];
                                    $user->id =$userID;
                                    $user->ban = date("Y-m-d H:i:s",$banTime);

                                    $user->banUser();

                                    header("Location: user-profile?userID=$userID");

                            }

                    } else {

                        echo "You have to ban user by submit clik";

                    }

            } catch (Exception $e)  {

                echo "An error occurred, please contact the administrator";

            }


    }



    public function unbunUser()
    {

        try {

                $user = new User();

                $userID = $_GET['userID'];
                $user->id = $userID;
                $user->unbanUser();

                header("Location: user-profile?userID=$userID");

           } catch (Exception $e) {

                echo "An error occurred, please contact the administrator";

           }

    }





}