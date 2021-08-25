<?php


class FrontendController extends Controller
{

    public function index()
    {

        $user = new User();
        $contact = new Contact();

            if (isset($_SESSION['user'])) {

                $id = $_SESSION['user']['id'];
                $user->id = $id;
                $contact->id = $id;

                $this->data['countRequest'] =  $contact->getCountRequest();

            }

            if (isset($_GET['search'])) {

                $user->keyWord = $_GET['search'];

            }

        $this->data['users'] = $user->searchUsers();

        $this->returnView('home',$this->data);

    }



    public function usersCache()
    {

        $user = new User();

        $this->data['usersCache'] = $user->getUsersForCache();

        $this->returnView('users-cache', $this->data);

    }



    public function obs()
    {

        $this->returnView('observer', $this->data);

    }


}