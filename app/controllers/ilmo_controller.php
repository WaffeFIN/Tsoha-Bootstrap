<?php

require 'app/models/kurssi.php';
require 'app/models/ilmo.php';

class IlmoController extends BaseController {

    public static function destroy() {
        self::check_logged_in();
        $params = $_POST;
        $kurssi = Kurssi::find($params['kurssi_id']);
        $kayttaja = self::get_user_logged_in();

        $ilmo = Ilmoittautuminen::find($kayttaja->id, $kurssi->id);
        $ilmo->destroy();

        Redirect::to('/kayttaja', array('message' => 'Ilmoittautuminen kurssille ' . $kurssi->nimi . ' peruttu!'));
    }

    public static function signup() {
        self::check_logged_in();
        $params = $_POST;
        $kurssi = Kurssi::find($params['kurssi_id']);
        $kayttaja = self::get_user_logged_in();
        $pvm = date('Y-m-d');

        $attributes = array(
            'kayttaja_id' => $kayttaja->id,
            'kurssi_id' => $kurssi->id,
            'paivays' => $pvm
        );

        $ilmo = new Ilmoittautuminen($attributes);
        $errors = $ilmo->errors();

        if (count($errors) == 0) {
            $ilmo->save();

            Redirect::to('/kurssit/' . $kurssi->aihe_id, array('message' => 'Olet ilmoittautunut kurssille ' . $kurssi->nimi));
        } else
            Redirect::to('/kurssit/' . $kurssi->aihe_id, array('errors' => $errors));
    }

}
