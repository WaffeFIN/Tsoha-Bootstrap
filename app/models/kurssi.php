<?php
class Kurssi extends BaseModel{
  public $id, $aihe_id, $kurssivastaava_id, $nimi, $julkaistu, $lisays_pvm;

  public function __construct($attributes){
    parent::__construct($attributes);
  }
  
  public static function all(){
    $query = DB::connection()->prepare('SELECT * FROM Kurssi');
    $query->execute();
    $rows = $query->fetchAll();
    $kurssit = array();

    foreach($rows as $row){
      $kurssit[] = new Kurssi(array(
        'id' => $row['id'],
        'aihe_id' => $row['aihe_id'],
        'kurssivastaava_id' => $row['kurssivastaava_id'],
        'nimi' => $row['nimi'],
        'julkaistu' => $row['julkaistu'],
        'lisays_pvm' => $row['lisays_pvm']
      ));
    }

    return $kurssit;
  }
  
  public static function find($id){
    $query = DB::connection()->prepare('SELECT * FROM Kurssi WHERE id = :id LIMIT 1');
    $query->execute(array('id' => $id));
    $row = $query->fetch();

    if($row){
      $kurssi = new Kurssi(array(
        'id' => $row['id'],
        'aihe_id' => $row['aihe_id'],
        'kurssivastaava_id' => $row['kurssivastaava_id'],
        'nimi' => $row['nimi'],
        'julkaistu' => $row['julkaistu'],
        'lisays_pvm' => $row['lisays_pvm']
      ));

      return $kurssi;
    }

    return null;
  }
}