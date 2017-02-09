<?php

class Aihe extends BaseModel {

    public $id, $nimi;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Aihe');
        $query->execute();
        $rows = $query->fetchAll();
        $aiheet = array();

        foreach ($rows as $row) {
            $aiheet[] = new Aihe(array(
                'id' => $row['id'],
                'nimi' => $row['nimi']
            ));
        }

        return $aiheet;
    }

}
