<?php

require 'app/models/kurssi.php';
require 'app/models/oppitunti.php';

class KurssiController extends BaseController {

    public static function index($aihe_id) {
        $kurssit = Kurssi::allAihe($aihe_id);
        View::make('kurssilista_kv.html', array('aihe_id' => $aihe_id, 'kurssit' => $kurssit));
    }

    public static function index_old($aihe_id) { //TO BE DELETED
        $kurssit = Kurssi::allAihe($aihe_id);
        View::make('kurssilista_op.html', array('aihe_id' => $aihe_id, 'kurssit' => $kurssit));
    }

    public static function show($id) {
        $kurssi = Kurssi::find($id);
        $oppitunnit = Oppitunti::kurssiOppitunnit($id);
        View::make('kurssi.html', array(
            'kurssi' => $kurssi,
            'oppitunnit' => $oppitunnit
        ));
    }

    public static function destroy() {
        $params = $_POST;

        $kurssi = Kurssi::find($params['kurssi_id']);
        $kurssi->destroy();

        Redirect::to('/kurssit/' . $params['aihe_id'], array('message' => 'Kurssi on poistettu onnistuneesti!'));
    }

    public static function publish($id) {
        $kurssi = Kurssi::find($id);
        $kurssi->publish();
        Redirect::to('/kurssit/' . $kurssi->aihe_id, array('message' => 'Kurssi ' . ($kurssi->nimi) . ' on julkaistu!'));
    }

    public static function store() {
        $params = $_POST;

        $attributes = array(
            'nimi' => $params['nimi'],
            'aihe_id' => $params['aihe_id'],
            'kurssivastaava_id' => $params['kurssivastaava_id']
        );
        $kurssi = new Kurssi($attributes);
        $errors = $kurssi->errors();


        if (count($errors) == 0) {
            $kurssi->save();

            Redirect::to('/kurssi/' . $kurssi->id, array('message' => 'Kurssi lisätty!'));
        } else {
            $aihe_id = 1;
            $kurssit = Kurssi::allAihe($aihe_id);
            View::make('kurssilista_kv.html', array(
                'aihe_id' => $aihe_id,
                'kurssit' => $kurssit,
                'errors' => $errors));
        }
    }

}
