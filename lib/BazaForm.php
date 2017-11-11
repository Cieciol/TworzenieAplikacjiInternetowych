<?php
/**
 * Created by PhpStorm.
 * User: tomek
 * Date: 06.11.17
 * Time: 11:30
 */

class BazaForm
{
    private $mysqli; //uchwyt do BD

    public function __construct($serwer, $user, $pass, $baza)
    {
        $this->mysqli = new mysqli($serwer, $user, $pass, $baza);
        /* sprawdz połączenie */
        if ($this->mysqli->connect_errno) {
            printf("Nie udało sie połączenie z serwerem: %s\n",
                $this->mysqli->connect_error);
            exit();
        }
        /* zmien kodowanie na utf8 */
        if ($this->mysqli->set_charset("utf8")) {
            //udało sie zmienić kodowanie
        }
    } //koniec funkcji konstruktora

    function __destruct()
    {
        $this->mysqli->close();
    }

    public function select($sql, $pola)
    {
        //parametr $sql – łańcuch zapytania select
        //parametr $pola - tablica z nazwami pol w bazie
        //Wynik funkcji – kod HTML tabeli z rekordami (String)
        $tresc = "";
        if ($result = $this->mysqli->query($sql)) {
            $ilepol = count($pola); //ile pól
            $ile = $result->num_rows; //ile wierszy
            // pętla po wyniku zapytania $results
            $tresc .= "<table><thead><td>$pola[0]</td><td>$pola[1]</td></thead><tbody>";
            while ($row = $result->fetch_object()) {
                $tresc .= "<tr>";
                for ($i = 0; $i < $ilepol; $i++) {
                    $p = $pola[$i];
                    $tresc .= "<td>" . $row->$p . "</td>";
                }
                $tresc .= "</tr>";
            }
            $tresc .= "</table></tbody>";
            $result->close(); /* zwolnij pamięć */
        }
        return $tresc;
    }

    public function insert($values): bool
    {
        $sql = "INSERT INTO klienci.Klienci(Nazwisko, Wiek, Panstwo, Email, Zamowienie, Platnosc) VALUES ";
            $valuesArr = array();
            $nazwisko = $this->mysqli->real_escape_string($values['nazwisko'] );
            $wiek = $this->mysqli->real_escape_string($values['wiek'] );
            $panstwo = $this->mysqli->real_escape_string($values['panstwo'] );
            $email = $this->mysqli->real_escape_string($values['email'] );
        $zamowienie = $this->handle_array($values['tutorial']);
        $platnosc = $this->mysqli->real_escape_string($values['zaplata'] );
            $valuesArr[] = "('$nazwisko', '$wiek', '$panstwo', '$email', $zamowienie, '$platnosc')";

        $sql .= implode(',', $valuesArr);
        $result = $this->mysqli->query($sql);
        return $result;
    }

    public function delete($sql)
    {
        // uzupełnij zapytanie – i zwróć true lub false
    }

    /**
     * @param $values
     * @return mixed
     */
    private function handle_array($array_values)
    {
        $returned_string = "";
        if(is_array($array_values)){
            $returned_string.="('";
            foreach ($array_values as $value){
                $returned_string.=$this->mysqli->real_escape_string($value).", ";
            }
            $returned_string.="')";
        }else $returned_string = $array_values;

        return $returned_string;
    }
}