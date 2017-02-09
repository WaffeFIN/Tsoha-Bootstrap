<?php

require 'app/models/aihe.php';

class AiheController extends BaseController {
    
    //TODO: change to MainController, index => login, aihe => aihe

    public static function index() {
        $aiheet = Aihe::all();
        View::make('aiheet.html', array('aiheet' => $aiheet));
    }

}
