<?php

class Ilmoittautuminen extends BaseModel {

    public $kayttaja_id, $kurssi_id, $paivays;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_kayttaja', 'validate_kurssi');
    }

    public static function ilmoittautumisetFromRows($rows) {
        $ilmoittautumiset = array();

        foreach ($rows as $row) {
            $ilmoittautumiset[] = new Ilmoittautuminen(array(
                'kayttaja_id' => $row['kayttaja_id'],
                'kurssi_id' => $row['kurssi_id'],
                'paivays' => $row['paivays']
            ));
        }
        return $ilmoittautumiset;
    }

    public static function ilmoittautuminenFromRow($row) {
        if ($row) {
            $ilmoittautuminen = new Ilmoittautuminen(array(
                'kayttaja_id' => $row['kayttaja_id'],
                'kurssi_id' => $row['kurssi_id'],
                'paivays' => $row['paivays']
            ));

            return $ilmoittautuminen;
        }

        return null;
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Ilmoittautuminen');
        $query->execute();
        $rows = $query->fetchAll();
        $ilmoittautumiset = Ilmoittautuminen::ilmoittautumisetFromRows($rows);
        return $ilmoittautumiset;
    }

    public static function allKayttaja($kayttaja_id) {
        $query = DB::connection()->prepare('SELECT * FROM Ilmoittautuminen WHERE kayttaja_id = :kayttaja_id');
        $query->execute(array('kayttaja_id' => $kayttaja_id));
        $rows = $query->fetchAll();
        $ilmoittautumiset = Ilmoittautuminen::ilmoittautumisetFromRows($rows);
        return $ilmoittautumiset;
    }

    public static function allKurssi($kurssi_id) {
        $query = DB::connection()->prepare('SELECT * FROM Ilmoittautuminen WHERE kurssi_id = :kurssi_id');
        $query->execute(array('kurssi_id' => $kurssi_id));
        $rows = $query->fetchAll();
        $ilmoittautumiset = Ilmoittautuminen::ilmoittautumisetFromRows($rows);
        return $ilmoittautumiset;
    }

    public static function find($kayttaja_id, $kurssi_id) {
        $query = DB::connection()->prepare('SELECT * FROM Ilmoittautuminen WHERE kayttaja_id = :kayttaja_id AND kurssi_id = :kurssi_id LIMIT 1');
        $query->execute(array('kayttaja_id' => $kayttaja_id, 'kurssi_id' => $kurssi_id));
        $row = $query->fetch();
        $ilmoittautuminen = Ilmoittautuminen::ilmoittautuminenFromRow($row);
        return $ilmoittautuminen;
    }

    public function validate_kayttaja() {
        $errors = array();
        return $errors;
    }

    public function validate_kurssi() {
        $errors = array();
        return $errors;
    }

    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Ilmoittautuminen WHERE kayttaja_id = :kayttaja_id AND kurssi_id = :kurssi_id');
        $query->execute(array('kayttaja_id' => $this->kayttaja_id, 'kurssi_id' => $this->kurssi_id));
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Ilmoittautuminen (kayttaja_id, kurssi_id, paivays) VALUES(:kayttaja_id, :kurssi_id, :paivays)');
        $query->execute(array(
            'kayttaja_id' => $this->kayttaja_id,
            'kurssi_id' => $this->kurssi_id,
            'paivays' => $this->paivays));
    }

}
