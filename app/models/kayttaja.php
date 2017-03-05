<?php

class Kayttaja extends BaseModel {

    public $id, $nimi, $oikeudet;

//  id SERIAL PRIMARY KEY,
//  nimi TEXT NOT NULL,
//  tunnus VARCHAR(60) NOT NULL,
//  salasana VARCHAR(60) NOT NULL,
//  oikeudet INTEGER DEFAULT 0

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $kayttaja = new Kayttaja(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'oikeudet' => $row['oikeudet']
            ));

            return $kayttaja;
        }
        return null;
    }
    

    public static function authenticate($kayttajatunnus, $salasana) {
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE kayttajatunnus = :kayttajatunnus AND salasana = :salasana LIMIT 1');
        $query->execute(array('kayttajatunnus' => $kayttajatunnus, 'salasana' => $salasana));
        $row = $query->fetch();

        if ($row) {
            $kayttaja = new Kayttaja(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'oikeudet' => $row['oikeudet']
            ));

            return $kayttaja;
        }

        return null;
    }

}
