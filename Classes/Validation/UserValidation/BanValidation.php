<?php


class BanValidation
{


    private $data;
    private $errors = [];
    private static $field = ['ban'];

    public function __construct($post_data)
    {

        $this->data = $post_data;

    }



    public function validateForm()
    {

        foreach (self::$field as $field) {

            if (!array_key_exists($field,$this->data)) {

                trigger_error("$field is not present in data");
                return;

            }

        }

        $this->validateBan();

        return $this->errors;

    }



    private function validateBan()
    {
        $val = trim($this->data['ban']);

        if (empty($val)) {

            $this->addError('ban', 'Minutes are required');

        }
    }



    private function addError($kev,$val)
    {

        $this->errors[$kev] = $val;

    }

}