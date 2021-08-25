<?php


class MessageValidation
{

    private $data;
    private $errors = [];
    private static $field = ['content'];


    public function __construct($post_data)
    {

        $this->data = $post_data;

    }



    public function validateForm()
    {
        foreach (self::$field as $field)  {

            if (!array_key_exists($field,$this->data)) {

                trigger_error("$field is not present in data");
                return;
            }
        }

        $this->validateContent();

        return $this->errors;
    }



    private function validateContent()
    {

        $val = trim($this->data['content']);

        if (empty($val)) {

            $this->addError('content', 'Message is required');

        } else {

            if (!preg_match('/^[a-zA-Z0-9\s]{2,1000}$/',$val)) {

                $this->addError('content', 'Message must be 2-1000 chars and alphanumberic');
            }
        }
    }



    private function addError($kev,$val)
    {

        $this->errors[$kev] = $val;

    }
}