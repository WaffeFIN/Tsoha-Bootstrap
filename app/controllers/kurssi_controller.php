<?php

require 'app/models/kurssi.php';
require 'app/models/oppitunti.php';

class KurssiController extends BaseController {

    public static function index($aihe_id) {
        $kurssit = Kurssi::allAihe($aihe_id);
        View::make('kurssilista_kv.html', array('aihe_id' => $aihe_id, 'kurssit' => $kurssit));
    }

    public static function show($id) {
        $kurssi = Kurssi::find($id);
        if ($kurssi == null) {
            Redirect::to('/', array('message' => 'Kurssia ei löytynyt id:llä ' . $id));
        } else {
            $oppitunnit = Oppitunti::kurssiOppitunnit($id);
            View::make('kurssi.html', array(
                'kurssi' => $kurssi,
                'oppitunnit' => $oppitunnit
            ));
        }
    }

    public static function destroy() {
        self::check_logged_in();
        $params = $_POST;

        $kurssi = Kurssi::find($params['kurssi_id']);
        $kurssi->destroy();

        Redirect::to('/kurssit/' . $params['aihe_id'], array('message' => 'Kurssi poistettiin onnistuneesti!'));
    }

    public static function publish() {
        self::check_logged_in();
        $params = $_POST;
        $kurssi = Kurssi::find($params['kurssi_id']);
        $kurssi->publish();
        Redirect::to('/kurssit/' . $kurssi->aihe_id, array('message' => 'Kurssi ' . ($kurssi->nimi) . ' on julkaistu!'));
    }

    public static function hide() {
        self::check_logged_in();
        $params = $_POST;
        $kurssi = Kurssi::find($params['kurssi_id']);
        $kurssi->hide();
        Redirect::to('/kurssi/' . $kurssi->id, array('message' => 'Kurssi ' . ($kurssi->nimi) . ' on piillotettu!'));
    }

    public static function store() {
        self::check_logged_in();
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
            $aihe_id = $params['aihe_id'];
            $kurssit = Kurssi::allAihe($aihe_id);
            View::make('kurssilista_kv.html', array(
                'aihe_id' => $aihe_id,
                'kurssit' => $kurssit,
                'errors' => $errors));
        }
    }

}
