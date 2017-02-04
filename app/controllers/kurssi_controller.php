<?php
require 'app/models/kurssi.php';
class KurssiController extends BaseController{
  public static function index(){
    $kurssit = Kurssi::all();
    View::make('kurssilista_op.html', array('kurssit' => $kurssit));
  }
  public static function show($id){
    $kurssi = Kurssi::find($id);
    View::make('kurssi.html', array('kurssi' => $kurssi));
  }
}
