<?php

class Validation {

    private $data,
            $errors = [];

    private static $fields = ['email', 'password', 'password2'];

    public function __construct($post_data) {
        $this->data = $post_data;
    }

    public function validateForm() {
        foreach(self::$fields as $field) {
            if(!array_key_exists($field, $this->data)) {
                trigger_error("$field is not present in data");
                return;
            }
        }

        // $this->validateName();
        // $this->validateLastname();
        $this->validateFields();
        $this->validatePassword();

        return $this->errors;
    }


    // private function validateName() {

    //     $value = trim($this->data['name']);

    //     if(empty($value)) {
    //         $this->addError('name', 'Vardas negali būti tuščias!');
    //     }
    // }


    // private function validateLastname() {

    //     $value = trim($this->data['lastname']);

    //     if(empty($value)) {
    //         $this->addError('lastname', 'Pavarde negali būti tuščias!');
    //     }
    // }


    private function validateFields() {

        $values = array(trim($this->data['email'] && $this->data['password'] && $this->data['password2']));
        foreach($values as $value) {
            if(empty($value)) {
                $this->addError('email' || 'password' || 'password2', 'Laukai negali būti tušti!');
            }
        }
    }


    private function validatePassword() {

        $value = trim($this->data['password']);
        $value2 = trim($this->data['password2']);

        if(empty($value)) {
            $this->addError('password', 'Slaptažodis negali būti tuščias!');
        } else {
            if($value != $value2) {
                $this->addError('password', 'Ivesti slaptazodziai nesutampa!');
            }
            // if($this->checkPassword(md5($value))) {
            //     $this->addError('password', 'Slaptažodis įvestas neteisingas');
            // }
        } 
    }

    private function addError($key, $value) {
        $this->errors[$key] = $value;
    }

}