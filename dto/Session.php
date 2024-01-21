<?php
class Session
{
    private $id;
    private $ip;
    private $data_login;

    public function getId() {
        return $this->id;
    }

    function getIp() {
        return $this->ip;
    }
    function setIp($value) {
        $this->ip = $value;
    }

    function getDataLogin() {
        return $this->data_login;
    }

    function setDataLogin($value) {
        $this->data_login = $value;
    }

    public static function find($id)
    {
        $conn = Session::connector();
        $query = "SELECT * FROM sessions WHERE id = :id";
        try
        {
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $record = $stmt->fetchObject(__CLASS__);
            return $record;
        }
        catch(PDOException $e)
        {
            die("\nErrore nella ricerca del record: " . $e->getMessage());
        }
    }

    public function delete()
    {
        $conn = Session::connector();
        $id = $this->getId();
        $query = "DELETE FROM sessions WHERE id = :id";
        try {
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            die("Errore nell'eliminazione del record: " . $e->getMessage());
        }
    }

    public static function create($params)
    {
        $conn = Session::connector();
        $date = date('Y-m-d H:i:s');
        $query = "INSERT INTO sessions (ip, data_login, user_id) VALUES (:ip, :data_login, :user_id)";
        try {
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':ip', $params["ip"], PDO::PARAM_STR);
            $stmt->bindParam(':data_login', $date, PDO::PARAM_STR);
            $stmt->bindParam(':user_id', $params['user_id'], PDO::PARAM_INT);
            $stmt->execute();
            return $conn->lastInsertId();
        } catch (PDOException $e) {
            die("Errore nell'inserimento dei dati: " . $e->getMessage());
        }
    }

    private static function connector() {
        $db = new DbManager('localhost', 3306, 'C:\Users\USER\Desktop\E-COMMERCE\file.txt');
        return $db->connect('ecommerce5E');
    }
}

?>