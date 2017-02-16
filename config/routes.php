<?php

$routes->get('/', function() {
    UserController::login();
});

$routes->post('/login', function() {
    UserController::handle_login();
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
    OppituntiController::uusi(0, $id);
});

$routes->get('/uusi_ts/:id', function($id) {
    OppituntiController::uusi(1, $id);
});

$routes->post('/julkaise', function() {
    KurssiController::publish();
});

$routes->post('/piillota', function() {
    KurssiController::hide();
});

$routes->get('/kurssi/:id', function($id) {
    KurssiController::show($id);
});

$routes->post('/kurssi', function() {
    KurssiController::store();
});

$routes->get('/oppitunti/:id', function($id) {
    OppituntiController::show($id);
});
