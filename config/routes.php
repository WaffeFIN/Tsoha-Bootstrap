<?php

$routes->get('/', function() {
    UserController::login();
});

$routes->post('/login', function() {
    UserController::handle_login();
});

$routes->get('/hiekkalaatikko', function() {
    MainController::sandbox();
});

$routes->get('/aiheet', function() {
    AiheController::index();
});

$routes->post('/poisto', function() {
    KurssiController::destroy();
});

$routes->get('/kurssit/:aiheid', function($aiheid) {
    KurssiController::index($aiheid);
});

$routes->get('/kurssit_old/:aiheid', function($aiheid) {
    KurssiController::index_old($aiheid);
});

$routes->post('/uusi', function() {
    OppituntiController::store();
});

$routes->get('/uusi_ot/:id', function($id) {
    OppituntiController::uusi_oppitunti($id);
});

$routes->get('/uusi_ts/:id', function($id) {
    OppituntiController::uusi_tehtavasarja($id);
});


$routes->get('/kurssi/:id/julkaise', function($id) {
    KurssiController::publish($id);
});

$routes->get('/kurssi/:id', function($id) {
    KurssiController::show($id);
});

$routes->post('/kurssi', function() {
    KurssiController::store();
});
