<?php

require 'app/models/kayttaja.php';

class BaseController {

    public static function get_user_logged_in() {
        if (isset($_SESSION['kayttaja'])) { //avain
            $kayttaja_id = $_SESSION['kayttaja'];
            $kayttaja = Kayttaja::find($kayttaja_id);

            return $kayttaja;
        }
        return null;
    }

    public static function check_logged_in() {
        if (!isset($_SESSION['kayttaja'])) {
            Redirect::to('/', array('message' => 'Kirjaudu ensin sisään!'));
        }
    }

}
