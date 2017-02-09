<?php

class Oppitunti extends BaseModel {

    public $id, $kurssi_id, $otsikko, $materiaali, $rivi, $tyyppi;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_otsikko');
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Oppitunti');
        $query->execute();
        $rows = $query->fetchAll();
        $oppitunnit = array();

        foreach ($rows as $row) {
            $oppitunnit[] = new Oppitunti(array(
                'id' => $row['id'],
                'kurssi_id' => $row['kurssi_id'],
                'otsikko' => $row['otsikko'],
                'materiaali' => $row['materiaali'],
                'rivi' => $row['rivi'],
                'tyyppi' => $row['tyyppi']
            ));
        }

        return $oppitunnit;
    }

    public static function allKurssi($kurssi_id) {
        $query = DB::connection()->prepare('SELECT * FROM Oppitunti WHERE kurssi_id = :kurssi_id');
        $query->execute(array('kurssi_id' => $kurssi_id));
        $rows = $query->fetchAll();
        $oppitunnit = array();

        foreach ($rows as $row) {
            $oppitunnit[] = new Oppitunti(array(
                'id' => $row['id'],
                'kurssi_id' => $row['kurssi_id'],
                'otsikko' => $row['otsikko'],
                'materiaali' => $row['materiaali'],
                'rivi' => $row['rivi'],
                'tyyppi' => $row['tyyppi']
            ));
        }

        return $oppitunnit;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Oppitunti WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $oppitunti[] = new Oppitunti(array(
                'id' => $row['id'],
                'kurssi_id' => $row['kurssi_id'],
                'otsikko' => $row['otsikko'],
                'materiaali' => $row['materiaali'],
                'rivi' => $row['rivi'],
                'tyyppi' => $row['tyyppi']
            ));

            return $oppitunti;
        }

        return null;
    }

    public static function kurssiOppitunnit($kurssi_id) {
        $query = DB::connection()->prepare('SELECT * FROM Oppitunti WHERE kurssi_id = :kurssi_id');
        $query->execute(array('kurssi_id' => $kurssi_id));
        $rows = $query->fetchAll();
        $oppitunnit = array();

        foreach ($rows as $row) {
            $oppitunnit[] = new Oppitunti(array(
                'id' => $row['id'],
                'kurssi_id' => $row['kurssi_id'],
                'otsikko' => $row['otsikko'],
                'materiaali' => $row['materiaali'],
                'rivi' => $row['rivi'],
                'tyyppi' => $row['tyyppi']
            ));
        }

        return $oppitunnit;
    }

    public function validate_otsikko() {
        $errors = array();
        if ($this->validate_string($this->otsikko)) {
            $errors[] = 'Kurssin nimi ei saa olla tyhjä!';
        }
        if ($this->validate_string_length($this->otsikko, 2, 60)) {
            $errors[] = 'Kurssin nimen pituus on oltava vähintään kaksi merkkiä ja enintään 60 merkkiä!';
        }
        return $errors;
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Oppitunti (otsikko, kurssi_id, materiaali, tyyppi) VALUES(:otsikko, :kurssi_id, :materiaali, :tyyppi) RETURNING id');
        $query->execute(array(
            'otsikko' => $this->otsikko,
            'kurssi_id' => $this->kurssi_id,
            'materiaali' => $this->materiaali,
            'tyyppi' => $this->tyyppi));
        $row = $query->fetch();
        $this->id = $row['id'];
    }

}
