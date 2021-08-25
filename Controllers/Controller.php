<?php


class Controller
{
    protected $data= [];

    public function returnView($view_name, $data = array())
    {

        $ext = ".php";
        $basic = "Views/";

        $direcotries = array($basic, $basic."Contacts/",$basic."Users/",$basic."Groups/", $basic."Errors/", $basic."Messages/" );

            foreach ($direcotries as $direcotry) {

                $full_path = $direcotry.$view_name.$ext;

                    if(file_exists($full_path))

                        include_once $full_path;

            }

    }



}