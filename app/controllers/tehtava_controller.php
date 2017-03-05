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

//        $errors = array();
//        if ($sarja == null) {
//            $errors[] = 'Tehtäväsarjaa ei löytynyt!';
//            Kint::dump($params);
//            Kint::dump($id);
//            Kint::dump($sarja_id);
//        }
        $kurssi_id = $sarja->kurssi_id;
        $kurssi = Kurssi::find($kurssi_id);

        $tehtava = TehtavaController::getOrCreateTehtava($id, $sarja_id);

//        if (count($errors) == 0) {
            //redirect to tehtava_uusi with tehtava, sarja and kurssi
            $isUusi = ($id == 0);
            View::make('tehtava_uusi.html', array(
                'tehtava' => $tehtava,
                'sarja' => $sarja,
                'kurssi' => $kurssi,
                'isUusi' => $isUusi
            ));
//        } else {
//            Redirect::to('/kurssi/' . $kurssi->id);
//        }
    }

    public static function getOrCreateTehtava($id, $sarja_id) {
        //if a tehtava with $id is found, return it, else return new tehtava
        if ($id == 0) {
            $tehtava = self::createTehtava($sarja_id);
            return $tehtava;
        } else {
            $tehtava = Tehtava::find($id);
            if ($tehtava == null) {
                $tehtava = self::createTehtava($sarja_id);
            }
            return $tehtava;
        }
    }

    private static function createTehtava($sarja_id) {
        $attributes = array(
            'tehtavanumero' => "nro",
            'tehtavananto' => "tehtävänanto",
            'sarja_id' => $sarja_id
        );
        $tehtava = new Tehtava($attributes);
        return $tehtava;
    }
    
    
    public static function destroy() {
        self::check_logged_in();
        $params = $_POST;

        $tehtava = Tehtava::find($params['id']);
        $tehtava->destroy();

        Redirect::to('/oppitunti/' . $params['sarja_id'], array('message' => 'Tehtävä poistettu!'));
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
            Redirect::to('/oppitunti/' . $tehtava->sarja_id, array('message' => 'Tehtävä tallennettu!'));
        } else {
            if ($tehtava)
                Redirect::to('/oppitunti/' . $tehtava->sarja_id, array('errors' => $errors));
            else
                Redirect::to('/', array('errors' => $errors));
        }
    }

}
