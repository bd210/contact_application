<?php

error_reporting(E_ALL);

spl_autoload_register(function ($name)
{

    $ext = ".php";
    $basicFolderClass = "Classes/";
    $modelClass = "Models/";
    $validationClass = $basicFolderClass."Validation/";
    $basicFolderController = "Controllers/";

    $directories = array($basicFolderClass,$basicFolderController,$validationClass."UserValidation/",
        $basicFolderClass."Images/", $validationClass."MessageValidation/", $modelClass);


            foreach ($directories as $directory)
            {

                $full_path = $directory.$name.$ext;

                    if(file_exists($full_path))

                        include_once $full_path;

            }

});