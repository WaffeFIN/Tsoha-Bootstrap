<?php

require 'app/models/kurssi.php';
require 'app/models/oppitunti.php';
require 'app/models/tehtava.php';

class TehtavaController extends BaseController {

    public static function edit() {
        self::check_logged_in();
        $params = $_POST;
        $id = $params['id'];
        $sarja_id = $params['sarja_id'];
        $sarja = Oppitunti::find($sarja_id);

        $errors = array();
        if ($sarja == null) {
            $errors[] = 'Tehtäväsarjaa ei löytynyt!';
            Kint::dump($params);
            Kint::dump($id);
            Kint::dump($sarja_id);
        }
        $kurssi_id = $sarja->kurssi_id;
        $kurssi = Kurssi::find($kurssi_id);

        $tehtava = TehtavaController::getOrCreateTehtava($id, $sarja_id);

        if (count($errors) == 0) {
            //redirect to tehtava_uusi with tehtava, sarja and kurssi
            View::make('tehtava_uusi.html', array(
                'tehtava' => $tehtava,
                'sarja' => $sarja,
                'kurssi' => $kurssi
            ));
        } else {
            Redirect::to('/kurssi/' . $kurssi->id);
        }
    }

    public static function getOrCreateTehtava($id, $sarja_id) {
        if ($id == 0) {
            $attributes = array(
                'tehtavanumero' => "nro",
                'tehtavananto' => "tehtävänanto",
                'sarja_id' => $sarja_id
            );
            $tehtava = new Tehtava($attributes);
            return $tehtava;
        } else {
            $tehtava = Tehtava::find($id);
            return $tehtava;
        }
    }

    public static function store() {
        self::check_logged_in();
        $params = $_POST;

        $attributes = array(
            'id' => $params['id'],
            'tehtavanumero' => $params['tehtavanumero'],
            'tehtavananto' => $params['tehtavananto'],
            'sarja_id' => $params['sarja_id']
        );
        $tehtava = new Tehtava($attributes);
        $errors = $tehtava->errors();

        if (count($errors) == 0) {
            $tehtava->saveOrUpdate();
            Redirect::to('/oppitunti/' . $tehtava->sarja_id, array('message' => 'Tehtävä lisätty!'));
        } else {
            if ($tehtava)
                Redirect::to('/oppitunti/' . $tehtava->sarja_id, array('errors' => $errors));
            else
                Redirect::to('/', array('errors' => $errors));
        }
    }

}
