<?php
/**
 * Created by PhpStorm.
 * User: tomek
 * Date: 06.11.17
 * Time: 11:30
 */

class Baza
{
    /**
     * @var mysqli
     */
    private $mysqli; //uchwyt do BD

    /**
     * Baza constructor.
     * @param $serwer
     * @param $user
     * @param $pass
     * @param $baza
     */



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

    /**
     *
     */
    function __destruct()
    {
        $this->mysqli->close();
    }

    /**
     * @param $sql
     * @param $pola
     * @return string
     */
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

    /**
     * @param $sql
     * @return bool
     */
    public function insert($sql): bool
    {
        $result = $this->mysqli->query($sql);
        return $result;
    }

    /**
     * @param $sql
     */
    public function delete($sql)
    {
        // uzupełnij zapytanie – i zwróć true lub false
    }

    public function prepareData($escapestr) {
        return $this->mysqli->real_escape_string($escapestr);
    }

    public function executeQuery($statement){
        return $this->mysqli->query($statement);
    }




}