<?php

namespace App\Utils;

class Validator {
    public $session;
    public $errors = [];
    public $listRules = [
        'required',
        'min',
        'max',
        'email',
        'date',
        'number',
        'boolean',
        'string',
    ];

    public function __construct() {
        $this->session = Session::getInstance();
    }

    public function validate(array $data, array $rules = ['key']['rule']) {
        foreach($rules as $key => $rules) {
            $arrayRules = explode('|', $rules);

            // Check rule
            foreach($arrayRules as $rule) {
                $oldKey = 'old_' . $key;
                $this->session->flash($oldKey, $data[$key]);
                match($rule) {
                    'required' => $this->required($key, $data[$key]),
                    'min' => $this->min($key, $data[$key], $arrayRules[1]),
                    'max' => $this->max($key, $data[$key], $arrayRules[1]),
                    'email' => $this->email($key, $data[$key]),
                    'date' => $this->date($key, $data[$key]),
                    'number' => $this->number($key, $data[$key]),
                    'boolean' => $this->boolean($key, $data[$key]),
                    'string' => $this->string($key, $data[$key]),
                    default => throw new \Exception('Rule ' . $rule . ' not found'),
                };
            }
        }

        if(count($this->errors) > 0) {
            $this->printErrors();

            return false;
        } else {
            return $this->data;
        }
    }

    public function printErrors() {
        foreach($this->errors as $key => $error) {
            $key = 'error_'.$key;
            $this->session->flash($key, $error);
        }
    }
    
    public function required(string $key, string $value) {
        if(empty($value)) {
            $this->errors[$key] = $key . ' is required';
        }
    }

    public function min(string $key, string $value, int $min) {
        if(strlen($value) < $min) {
            $this->errors[$key] = $key . ' minimum ' . $min . ' character';
        }
    }

    public function max(string $key, string $value, int $max) {
        if(strlen($value) > $max) {
            $this->errors[$key] = $key . ' maximum ' . $max . ' character';
        }
    }

    public function email(string $key, string $value) {
        if(filter_var($value, FILTER_VALIDATE_EMAIL) == false) {
            $this->errors[$key] = $key . ' invalid email';
        }
    }

    public function date(string $key, string $value) {
        if(!strtotime($value)) {
            $this->errors[$key] = $key . ' invalid date';
        }
    }

    public function number(string $key, string $value) {
        if(!is_numeric($value)) {
            $this->errors[$key] = $key . ' invalid number';
        }
    }

    public function string(string $key, string $value) {
        if(!is_string($value)) {
            $this->errors[$key] = $key . ' invalid string';
        }
    }

    public function boolean(string $key, string $value) {
        if(!is_bool($value)) {
            $this->errors[$key] = $key . ' invalid boolean';
        }
    }
}