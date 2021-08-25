<?php


class FavoriteController extends Controller
{

    public function getFavorites()
    {
        $favorite = new Favorite();

            if (isset($_SESSION['user'])) {

                $favorite->id = $_SESSION['user']['id'];

            }

        $this->data['favorites'] = $favorite->getAllFavorites();

        $this->returnView('favorites', $this->data);
    }



    public function addFavorites()
    {
        try {

                $favorite = new Favorite();

                $favorite->user_from = $_SESSION['user']['id'];
                $favorite->user_to = $_GET['userID'];

                $favorite->createdAT = date("Y-m-d H:i:s");

                $favorite->addFavorite();

                header("Location: favorites-contact");


        } catch (Exception $e) {

                 echo "An error occurred, please contact the administrator";

        }
    }



    public function kickFavorites()
    {

         try {

                  $favorite = new Favorite();

                  $favorite->id = $_GET['userID'];

                  $favorite->kickFavorite();

                  header("Location: favorites-contact");


         } catch (Exception $e) {

                  echo "An error occurred, please contact the administrator";

         }

    }





}