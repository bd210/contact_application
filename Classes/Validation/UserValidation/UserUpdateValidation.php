<?php


class UserUpdateValidation
{

    private $data;
    private $errors = [];
    private static  $fields = ['username', 'email','organization','number', 'notes', 'country'];


    public function __construct($post_data)
    {

        $this->data = $post_data;

    }



    public function validateForm()
    {

        foreach (self::$fields as $field) {

            if (!array_key_exists($field,$this->data)) {

                trigger_error("$field is not present in data");
                return;

            }
        }

        $this->validateUsername();
        $this->validateOrganization();
        $this->validateNumber();
        $this->validateEmail();
        $this->validateNotes();
        $this->validateCountry();


        return $this->errors;

    }




    private function validateUsername()
    {
        $val = trim($this->data['username']);

        if (empty($val))  {

            $this->addError('username', 'Username is required');

        } else {

            if (!preg_match('/^[a-zA-Z0-9]{4,15}$/', $val)) {

                $this->addError('username', 'username must be 4-15 chars and alphanumeric');
            }
        }
    }



    private function validateEmail()
    {
        $val = trim($this->data['email']);

        if (empty($val)) {

            $this->addError('email', 'Email is required');

        } else {

            if (!filter_var($val,FILTER_VALIDATE_EMAIL)) {

                $this->addError('email', 'Email must be a valid email');

            }
        }

    }



    private function validateOrganization()
    {

        $val = trim($this->data['organization']);

        if (empty($val)) {

            $this->addError('organization', 'Organization is required');

        } else {

            if (!preg_match('/^[a-zA-Z0-9]{4,15}$/', $val)) {

                $this->addError('organization', 'Organization must be 4-15 chars and alphanumeric');

            }
        }
    }



    private function validateNumber()
    {

        $val = trim($this->data['number']);

         if (empty($val)) {

            $this->addError('number', 'Number is required');
         } else {

            if (!preg_match('/^[0-9]{9,13}$/', $val)) {

                $this->addError('number', 'Number must be 9-13 alphanumeric');
            }
         }
    }



    private function validateNotes()
    {
        $val = trim($this->data['notes']);

        if (empty($val)) {

            $this->addError('notes', 'Notes is required');

        } else {

            if (!preg_match('/^[a-zA-Z0-9\s]{3,100}$/', $val)) {

                $this->addError('notes', 'Notes must be 3-100 chars and alphanumeric');

            }
        }
    }



    private function validateCountry()
    {
        $val = trim($this->data['country']);

        if (empty($val)) {

            $this->addError('country', 'Country is required');

        }

    }



    private function addError($key, $val)
    {

        $this->errors[$key] = $val;

    }
}