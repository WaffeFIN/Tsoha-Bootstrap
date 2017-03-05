<?php

require 'app/models/kurssi.php';

class UserController extends BaseController {

    public static function index() {
        self::check_logged_in();
        $kayttaja = BaseController::get_user_logged_in();
        $kurssit = null;
        if ($kayttaja->oikeudet == 0) {
            $kurssit = Kurssi::allIlmoittautuimset($kayttaja->id);
        } else {
            $kurssit = Kurssi::allKurssivastaava($kayttaja->id);
        }
        View::make('kayttaja.html', array('kayttaja' => $kayttaja, 'kurssit' => $kurssit));
    }

    public static function login() {
        if (self::get_user_logged_in() != null) {
            Redirect::to('/aiheet');
        } else {
            View::make('login.html');
        }
    }

    public static function logout() {
        $_SESSION['kayttaja'] = null;
        Redirect::to('/', array('message' => 'Olet kirjautunut ulos!'));
    }

    public static function handle_login() {
        $params = $_POST;

        $kayttaja = Kayttaja::authenticate($params['kayttajatunnus'], $params['salasana']);

        if (!$kayttaja) {
            View::make('login.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'kayttajatunnus' => $params['kayttajatunnus']));
        } else {
            $_SESSION['kayttaja'] = $kayttaja->id;

            Redirect::to('/aiheet', array('message' => 'Tervetuloa takaisin ' . $kayttaja->nimi . '!'));
        }
    }

}
