<?php

class BaseModel {

    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators;

    public function __construct($attributes = null) {
        // Käydään assosiaatiolistan avaimet läpi
        foreach ($attributes as $attribute => $value) {
            // Jos avaimen niminen attribuutti on olemassa...
            if (property_exists($this, $attribute)) {
                // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
                $this->{$attribute} = $value;
            }
        }
    }

    public static function validate_string($string) {
        if ($string == null || $string == '') {
            return true;
        } else {
            return false;
        }
    }

    public static function validate_string_length($string, $min, $max) {
        $len = strlen($string);
        if ($len >= $min && $len <= $max) {
            return false;
        } else {
            return true;
        }
    }

    public function errors() {
        $errors = array();

        foreach ($this->validators as $validator) {
            $validator_errors = $this->{$validator}();
            $errors = array_merge($errors, $validator_errors);
        }

        return $errors;
    }

}
