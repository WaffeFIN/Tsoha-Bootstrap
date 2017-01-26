<?php

class HelloWorldController extends BaseController {

    public static function index() {
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        //View::make('home.html');
        View::make('aiheet.html');
    }

    public static function sandbox() {
        // Testaa koodiasi täällä
        View::make('login.html');
    }

    public static function kurssi_lista() {
        View::make('kurssilista_op.html');
    }
    
    public static function kurssi_lista_kv() {
        View::make('kurssilista_kv.html');
    }

    public static function kurssi() {
        View::make('kurssi.html');
    }

    public static function login() {
        View::make('login.html');
    }

}
