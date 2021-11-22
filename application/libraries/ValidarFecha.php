<?php

    class ValidarFecha extends CI_Form_validation 
    {
        public function __construct($rules = array()) {
            parent::__construct($rules);
        }

        public function date($date) {
            $d = DateTime::createFromFormat('d-m-Y', $date);
            return $d && $d->format('d-m-Y') === $date;
        }
    }

?>