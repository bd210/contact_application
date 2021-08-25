<?php


class Img
{
    private $src;
    private static $img = null;


    private function __construct()
    {

    }


    public static function getInstanceOfImg()
    {

        if (is_null(self::$img)) {

            self::$img = new Img();

        }

        return self::$img;

    }



    public function upload($filePicture, $maxSize, $path, $allowedExt = array())
    {

        $file = $filePicture;

        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileError = $file['error'];
        $fileSize = $file['size'];

        $fileExt = explode('.',$fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = $allowedExt;

            if (!in_array($fileActualExt, $allowed)) {

                echo "You cannot upload files of this type!";

            }  else {

                    if ($fileError != 0 ) {

                        echo "There was an error uploading your file!";

                    }
                    else{

                            if ($fileSize > $maxSize) {

                                echo "Your file is too big!";

                            } else {

                                $fileNewName = time()."_".$fileName;

                                $this->src = $path.$fileNewName;

                                $fileDestination = "public/".$path.$fileNewName;


                                move_uploaded_file($fileTmpName,$fileDestination);

                            }


                    }

            }

    }


    public function getSrc()
    {

        return $this->src;

    }
}