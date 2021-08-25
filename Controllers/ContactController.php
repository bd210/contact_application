<?php


class ContactController extends Controller
{

    public function requests()
    {

        $contact = new Contact();

            if (isset($_SESSION['user'])) {

                $contact->id = $_SESSION['user']['id'];

            }

        $this->data['requests'] = $contact->getRequestContact();

        $this->returnView('requests', $this->data);
    }


    public function declineRequest()
    {
        try {

                $contact = new Contact();

                $contact->id = $_GET['requestID'];

                $contact->declineRequest();

                header("Location: requests-all");


        } catch (Exception $e) {

                echo "An error occurred, please contact the administrator";

        }

    }



    public function getAllContacts()
    {

        $contact = new Contact();

            if (isset($_SESSION['user'])) {

                $contact->id = $_SESSION['user']['id'];

            }

        $this->data['contacts'] = $contact->getAllContacts();

        $this->returnView('contacts',$this->data);

    }



    public function addContact()
    {
        try {
                $contact = new Contact();

                $contact->createdAT = date("Y-m-d H:i:s");

                $contact->user_id = $_SESSION['user']['id'];
                $contact->user_id_to = $_GET['userID'];
                $contact->id = $_GET['requestID'];

                $contact->addContact();
                $contact->declineRequest();

                header("Location: requests-all");

        } catch (Exception $e) {

                echo "An error occurred, please contact the administrator";

        }
    }



    public function kickContact()
    {
        try {

                $contact = new Contact();

                $contact->id = $_SESSION['user']['id'];
                $contact->user_id_to = $_GET['userID'];

                $contact->kickContact();

                header("Location: contacts-all");

        } catch (Exception $e) {

                 echo "An error occurred, please contact the administrator";

        }
    }






}