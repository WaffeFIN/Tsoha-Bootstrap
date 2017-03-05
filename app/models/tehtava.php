<?php

class Tehtava extends BaseModel {

    public $id, $sarja_id, $tehtavananto, $tehtavanumero;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_tehtavananto', 'validate_tehtavanumero');
    }

    public static function tehtavatFromRows($rows) {
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

    public static function tehtavaFromRow($row) {
        if ($row) {
            $tehtava = new Tehtava(array(
                'id' => $row['id'],
                'sarja_id' => $row['sarja_id'],
                'tehtavanumero' => $row['tehtavanumero'],
                'tehtavananto' => $row['tehtavananto']
            ));

            return $tehtava;
        }

        return null;
    }

    public static function createDummyTehtava($sarja_id) {
        $tehtava = new Tehtava(array(
            'tehtavanumero' => "nro",
            'tehtavananto' => "tehtävänanto",
            'sarja_id' => $sarja_id
        ));
        return $tehtava;
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Tehtava');
        $query->execute();
        $rows = $query->fetchAll();
        $tehtavat = Tehtava::tehtavatFromRows($rows);

        return $tehtavat;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Tehtava WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        $tehtava = Tehtava::tehtavaFromRow($row);
        return $tehtava;
    }

    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Tehtava WHERE id = :id');
        $query->execute(array('id' => $this->id));
    }

    public function saveOrUpdate() {
        if ($this->id != 0) {
            $this->update();
        } else {
            $this->save();
        }
    }

    private function save() {
        $query = DB::connection()->prepare('INSERT INTO Tehtava (sarja_id, tehtavanumero, tehtavananto) VALUES(:sarja_id, :tehtavanumero, :tehtavananto) RETURNING id');
        $query->execute(array(
            'sarja_id' => $this->sarja_id,
            'tehtavanumero' => $this->tehtavanumero,
            'tehtavananto' => $this->tehtavananto));
        $row = $query->fetch();
        $this->id = $row['id'];
    }

    private function update() {
        $query = DB::connection()->prepare('UPDATE Tehtava SET tehtavanumero=:tehtavanumero, tehtavananto=:tehtavananto WHERE id=:id');
        $query->execute(array('id' => $this->id, 'tehtavanumero' => $this->tehtavanumero, 'tehtavananto' => $this->tehtavananto));
    }

    public static function oppituntiTehtavat($sarja_id) {
        $query = DB::connection()->prepare('SELECT * FROM Tehtava WHERE sarja_id=:sarja_id ORDER BY tehtavanumero ASC');
        $query->execute(array('sarja_id' => $sarja_id));
        $rows = $query->fetchAll();
        $tehtavat = Tehtava::tehtavatFromRows($rows);

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
        if ($this->validate_string($this->tehtavanumero)) {
            $errors[] = 'Tehtavanumero ei saa olla tyhjä!';
        } else if ($this->validate_string_length($this->tehtavanumero, 0, 6)) {
            $errors[] = 'Tehtavanumeron pituus saa olla enintään 6 merkkiä!';
        } else {
            $query = DB::connection()->prepare('SELECT * FROM Tehtava WHERE sarja_id=:sarja_id AND tehtavanumero=:tnro');
            $query->execute(array('sarja_id' => $this->sarja_id, 'tnro' => $this->tehtavanumero));
            $rows = $query->fetchAll();
            $tehtavat = Tehtava::tehtavatFromRows($rows);
            if (count($tehtavat) > 0) {
                $temp = $tehtavat[0];
                if ($temp->id != $this->id) {
                    $errors[] = 'Tehtavanumero pitää olla ainutlaatuinen!';
                }
            }
        }
        return $errors;
    }

}
