<?php

require_once '../lib/Repository.php';

/**
 * Das UserRepository ist zuständig für alle Zugriffe auf die Tabelle "user".
 *
 * Die Ausführliche Dokumentation zu Repositories findest du in der Repository Klasse.
 */
class AccessRepository extends Repository
{
    /**
     * Diese Variable wird von der Klasse Repository verwendet, um generische
     * Funktionen zur Verfügung zu stellen.
     */
    protected $tableName = 'access_user';

    /**
     * Erstellt einen neuen benutzer mit den gegebenen Werten.
     *
     * Das Passwort wird vor dem ausführen des Queries noch mit dem SHA1
     *  Algorythmus gehashed.
     *
     * @param $username Wert für die Spalte username
     * @param $email Wert für die Spalte email
     * @param $password Wert für die Spalte password
     *
     * @throws Exception falls das Ausführen des Statements fehlschlägt
     */
    public function register($username, $email, $password)
    {
        $passwordhash = sha1($password . "bdh4h") ;

        $query = "INSERT INTO $this->tableName (username, email, password) VALUES (?, ?, ?)";

        $statement = ConnectionHandler::getConnection()->prepare($query);

        $statement->bind_param('sss', $username, $email, $passwordhash);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }

        $this->login($username, $password);
        return $statement->insert_id;
    }

    /**
     * Prüft ob Benutzer vorhanden, wenn ja Benutzer wird eingeloggt
     *
     * Das Passwort wird vor dem ausführen des Queries noch mit dem SHA1
     *  Algorythmus gehashed.
     *
     * @param $username Wert für die Spalte username
     * @param $password Wert für die Spalte password
     *
     * @throws Exception falls das Ausführen des Statements fehlschlägt
     */
    public function login($username, $password){
        $password = sha1($password . "bdh4h") ;
        $query = "SELECT `id`, `isAdmin` FROM $this->tableName WHERE username = ? AND password = ?";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        if (!$statement) {
            throw new Exception(ConnectionHandler::getConnection()->error);
        }

        $statement->bind_param('ss', $username, $password);

        if(!$statement->execute()) {
            throw new Exception($statement->error);
        };

        $result = $statement->get_result();
        $user = $result->fetch_assoc();

        if ($user['id'] > 0) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['userid'] =  $user['id'];
            $_SESSION['isAdmin'] = $user['isAdmin'];

        }
    }
}