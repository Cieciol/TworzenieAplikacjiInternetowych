<?php
define("HTML_EOL", "<br/>");

/**
 * Class User
 */
class User
{

    const STATUS_USER = 1;
    const STATUS_ADMIN = 2;

    protected $user_name;
    protected $passwd;
    protected $full_name;
    protected $email;
    protected $date;
    protected $status;

    /**
     * @return string
     */
    public function getPasswd(): string
    {
        return $this->passwd;
    }

    /**
     * @return mixed
     */
    public function getFullName()
    {
        return $this->full_name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return DateTime
     */
    public function getDate(): DateTime
    {
        return $this->date;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * User constructor.
     * @param $user_name
     * @param $password
     * @param $full_name
     * @param $email
     */
    public function __construct($user_name, $full_name, $email, $password)
    {
        $this->user_name = $user_name;
        $this->passwd = hash('md5', $password);
        $this->full_name = $full_name;
        $this->email = $email;
        $this->status = User::STATUS_USER;
        $this->date = new DateTime();
    }

    /**
     * @param $userName
     * @param $password
     * @param $fullName
     * @param $email
     * @return User
     */
    public static function chcekForm($userName, $password, $fullName, $email)
    {
        $userName = filter_var($userName, FILTER_SANITIZE_STRING);
        $fullName = filter_var($fullName, FILTER_SANITIZE_STRING);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        if (!empty($userName) && !empty($password) && !empty($fullName) && !empty($email)) {
            return new static($userName, $fullName, $email, $password);
        } else return null;
    }

    /**
     * @return string
     */
    public function getUserName()
    {
        return $this->user_name;
    }

    /**
     * @param string $user_name
     */
    public function setUserName(string $user_name)
    {
        $this->user_name = $user_name;
    }

    public function show()
    {
        echo 'users name: ' . $this->user_name . HTML_EOL;
        echo 'users fullname: ' . $this->full_name . HTML_EOL;
        echo 'users email: ' . $this->email . HTML_EOL;
        echo 'join date: ' . $this->date->format('d-m-Y'). HTML_EOL;
        echo 'users status: ';
        echo $this->status == 1 ? "USER" . HTML_EOL : "ADMIN" . HTML_EOL;
    }
    public function save(){
        $xml = simplexml_load_file('users.xml');
        //dodajemy nowy element user i tworzymy uchwyt do tego elementu:
        $xmlCopy=$xml->addChild("user");
        //do elementu dodajemy dziecko o określonej nazwie i treści
        $xmlCopy->addChild("username", $this->user_name);
        //uzupełnij pozostałe właściwości
        $xmlCopy->addChild("passwd", $this->passwd);
        $xmlCopy->addChild("fullname", $this->full_name);
        $xmlCopy->addChild("email", $this->email);
        $xmlCopy->addChild("date", $this->date->format('d-m-Y'));
        $xmlCopy->addChild("status", $this->status);
        //zapisujemy zmodyfikowany XML do pliku:
        $xml->asXML('users.xml');
    }
    public static function getAllUsers(){
        $allUsers = simplexml_load_file('users.xml');
        echo "<ul>";
        foreach ($allUsers as $user):
            $userName=$user->username;
            $date=$user->date;
            echo "<li>$userName, $date</li>";
        endforeach;
        echo "</ul>";
    }


}