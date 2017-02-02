<?php

$routes->get('/', function() {
HelloWorldController::index();
});

$routes->get('/hiekkalaatikko', function() {
HelloWorldController::sandbox();
});

$routes->get('/aiheet', function() {
HelloWorldController::index();
});

$routes->get('/kurssit', function() {
HelloWorldController::kurssi_lista();
});

$routes->get('/kurssit_kv', function() {
HelloWorldController::kurssi_lista_kv();
});

$routes->get('/kurssi/:id', function($id) {
KurssiController::show($id);
});

$routes->get('/login', function() {
HelloWorldController::login();
});
