<?php

require 'app/models/kurssi.php';
require 'app/models/oppitunti.php';

class OppituntiController extends BaseController {

    public static function uusi_oppitunti($id) {
        $kurssi = Kurssi::find($id);
        View::make('oppitunti_uusi.html', array('kurssi' => $kurssi));
    }

    public static function uusi_tehtavasarja($id) {
        $kurssi = Kurssi::find($id);
        View::make('oppitunti_uusi_ts.html', array('kurssi' => $kurssi));
    }

    public static function store() {
        $params = $_POST;

        $attributes = array(
            'otsikko' => $params['otsikko'],
            'materiaali' => $params['materiaali'],
            'kurssi_id' => $params['kurssi_id'],
            'tyyppi' => $params['tyyppi']
        );
        $oppitunti = new Oppitunti($attributes);
        $errors = $oppitunti->errors();
        
        $id = $params['kurssi_id'];
        $kurssi = Kurssi::find($id);

        if (count($errors) == 0) {
            $oppitunti->save();
            $oppitunnit = Oppitunti::kurssiOppitunnit($kurssi->id);
            Redirect::to('/kurssi/' . $kurssi->id, array(
                'kurssi' => $kurssi,
                'oppitunnit' => $oppitunnit));
        } else {
            $oppitunnit = Oppitunti::kurssiOppitunnit($kurssi->id);
            Redirect::to('/kurssi/' . $kurssi->id, array(
                'kurssi' => $kurssi,
                'oppitunnit' => $oppitunnit,
                'errors' => $errors));
        }
    }

}
