<?php

require_once '../lib/Repository.php';

/**
 * Das UserRepository ist zuständig für alle Zugriffe auf die Tabelle "user".
 *
 */
class UserRepository extends Repository
{
    /**
     * Diese Variable wird von der Klasse Repository verwendet, um generische
     * Funktionen zur Verfügung zu stellen.
     */
    protected $tableName = 'user';

    /**
     * Erstellt einen neuen benutzer mit den gegebenen Werten.
     *
     * Das Passwort wird vor dem ausführen des Queries noch mit dem SHA1
     *  Algorythmus gehashed.
     *
     * @param $firstName Wert für die Spalte firstName
     * @param $lastName Wert für die Spalte lastName
     * @param $email Wert für die Spalte email
     * @param $password Wert für die Spalte password
     *
     * @throws Exception falls das Ausführen des Statements fehlschlägt
     */
    public function create($username, $email, $password)
    {
        $password = sha1($password);

        $query = "INSERT INTO $this->tableName (username, email, password) VALUES (?, ?, ?)";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('sss', $username, $email, $password);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }

        return $statement->insert_id;
    }

    public function login($username, $password){
        $password = sha1($password);

        $query = "SELECT `id` FROM $this->tableName WHERE username = ? AND password = ?";
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
        }
    }
}
