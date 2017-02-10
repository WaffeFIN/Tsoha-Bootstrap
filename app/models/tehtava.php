<?php

class Tehtava extends BaseModel {

    public $id, $sarja_id, $tehtavananto, $tehtavanumero;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_tehtavananto', 'validate_tehtavanumero');
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Tehtava');
        $query->execute();
        $rows = $query->fetchAll();
        $tehtavat = array();

        foreach ($rows as $row) {
            $tehtavat[] = new Tehtava(array(
                'id' => $row['id'],
                'sarja_id' => $row['sarja_id'],
                'tehtavananto' => $row['tehtavananto'],
                'tehtavanumero' => $row['tehtavanumero']
            ));
        }

        return $tehtavat;
    }

    public static function oppituntiTehtavat($sarja_id) {
        $query = DB::connection()->prepare('SELECT * FROM Tehtava WHERE sarja_id=:sarja_id');
        $query->execute(array('sarja_id' => $sarja_id));
        $rows = $query->fetchAll();
        $tehtavat = array();

        foreach ($rows as $row) {
            $tehtavat[] = new Tehtava(array(
                'id' => $row['id'],
                'sarja_id' => $row['sarja_id'],
                'tehtavananto' => $row['tehtavananto'],
                'tehtavanumero' => $row['tehtavanumero']
            ));
        }

        return $tehtavat;
    }

    public function validate_tehtavananto() {
        $errors = array();
        if ($this->validate_string($this->tehtavananto)) {
            $errors[] = 'Tehtavananto ei saa olla tyhjä!';
        }
        return $errors;
    }

    public function validate_tehtavanumero() {
        $errors = array();
        if ($this->validate_string($this->otsikko)) {
            $errors[] = 'Tehtavanumero ei saa olla tyhjä!';
        }
        if ($this->validate_string_length($this->otsikko, 1, 6)) {
            $errors[] = 'Tehtavanumeron pituus on oltava vähintään yksi (1) merkki ja enintään 6 merkkiä!';
        }
        return $errors;
    }

}
