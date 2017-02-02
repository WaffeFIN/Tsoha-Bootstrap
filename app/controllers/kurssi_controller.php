<?php
class KurssiController extends BaseController{
  public static function index(){
    $kurssit = Kurssi::all();
    View::make('kurssilista_op.html', array('kurssit' => $kurssit));
  }
}
