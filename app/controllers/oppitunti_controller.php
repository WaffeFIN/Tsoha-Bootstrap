<?php

require 'app/models/kurssi.php';
require 'app/models/oppitunti.php';
require 'app/models/tehtava.php';

class OppituntiController extends BaseController {

    public static function show($id) {
        $oppitunti = Oppitunti::find($id);
        if ($oppitunti->tyyppi != 0) {
            self::check_logged_in();
        }
        $kurssi = Kurssi::find($oppitunti->kurssi_id);
        $tehtavat = Tehtava::oppituntiTehtavat($id);
        View::make('oppitunti.html', array(
            'kurssi' => $kurssi,
            'oppitunti' => $oppitunti,
            'tehtavat' => $tehtavat
        ));
    }

    public static function uusi($tyyppi, $id) {
        self::check_logged_in();
        $kurssi = Kurssi::find($id);
        View::make('oppitunti_uusi.html', array('tyyppi' => $tyyppi, 'kurssi' => $kurssi));
    }

    public static function store() {
        self::check_logged_in();
        $params = $_POST;
        $materiaali = $params['materiaali'];
        $kurssi_id = $params['kurssi_id'];
        $tyyppi = $params['tyyppi'];

        $attributes = array(
            'otsikko' => $params['otsikko'],
            'materiaali' => $materiaali,
            'kurssi_id' => $kurssi_id,
            'tyyppi' => $tyyppi
        );
        $oppitunti = new Oppitunti($attributes);
        $errors = $oppitunti->errors();

        $kurssi = Kurssi::find($kurssi_id);
        if (count($errors) == 0) {
            $oppitunti->save();
            Redirect::to('/kurssi/' . $kurssi_id, array('message' => '' . $oppitunti->otsikko . ' lisätty!')); //, array('kurssi' => $kurssi, 'oppitunnit' => $oppitunnit));
        } else {
            View::make('oppitunti_uusi.html', array('tyyppi' => $tyyppi, 'materiaali' => $materiaali, 'kurssi' => $kurssi, 'errors' => $errors));
        }
    }

}
