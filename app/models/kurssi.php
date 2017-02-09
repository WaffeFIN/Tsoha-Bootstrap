<?php

class Kurssi extends BaseModel {

    public $id, $aihe_id, $kurssivastaava_id, $nimi, $yhteenveto, $julkaistu, $lisays_pvm;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_nimi');
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Kurssi');
        $query->execute();
        $rows = $query->fetchAll();
        $kurssit = array();

        foreach ($rows as $row) {
            $kurssit[] = new Kurssi(array(
                'id' => $row['id'],
                'aihe_id' => $row['aihe_id'],
                'kurssivastaava_id' => $row['kurssivastaava_id'],
                'nimi' => $row['nimi'],
                'yhteenveto' => $row['yhteenveto'],
                'julkaistu' => $row['julkaistu'],
                'lisays_pvm' => $row['lisays_pvm']
            ));
        }

        return $kurssit;
    }

    public static function allAihe($aiheid) {
        $query = DB::connection()->prepare('SELECT * FROM Kurssi WHERE aihe_id = :aiheid');
        $query->execute(array('aiheid' => $aiheid));
        $rows = $query->fetchAll();
        $kurssit = array();

        foreach ($rows as $row) {
            $kurssit[] = new Kurssi(array(
                'id' => $row['id'],
                'aihe_id' => $row['aihe_id'],
                'kurssivastaava_id' => $row['kurssivastaava_id'],
                'nimi' => $row['nimi'],
                'yhteenveto' => $row['yhteenveto'],
                'julkaistu' => $row['julkaistu'],
                'lisays_pvm' => $row['lisays_pvm']
            ));
        }

        return $kurssit;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Kurssi WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $kurssi = new Kurssi(array(
                'id' => $row['id'],
                'aihe_id' => $row['aihe_id'],
                'kurssivastaava_id' => $row['kurssivastaava_id'],
                'nimi' => $row['nimi'],
                'yhteenveto' => $row['yhteenveto'],
                'julkaistu' => $row['julkaistu'],
                'lisays_pvm' => $row['lisays_pvm']
            ));

            return $kurssi;
        }

        return null;
    }

    public function validate_nimi() {
        $errors = array();
        if ($this->validate_string($this->nimi)) {
            $errors[] = 'Kurssin nimi ei saa olla tyhjä!';
        }
        if ($this->validate_string_length($this->nimi, 6, 120)) {
            $errors[] = 'Kurssin nimen pituus on oltava vähintään kuusi merkkiä ja enintään 120 merkkiä!';
        }
        return $errors;
    }

    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Kurssi WHERE id = :id');
        $query->execute(array('id' => $this->id));
    }

    public function publish() {
        $query = DB::connection()->prepare('UPDATE Kurssi SET julkaistu=:true WHERE id=:id');
        $query->execute(array('id' => $this->id, 'true' => 'TRUE'));
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Kurssi (nimi, aihe_id, kurssivastaava_id, lisays_pvm) VALUES (:nimi, :aihe_id, :kurssivastaava_id, NOW()) RETURNING id');
        $query->execute(array('nimi' => $this->nimi, 'aihe_id' => $this->aihe_id, 'kurssivastaava_id' => $this->kurssivastaava_id));
        $row = $query->fetch();
        $this->id = $row['id'];
    }

}
