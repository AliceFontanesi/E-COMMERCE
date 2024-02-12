<?php
class User
{
    private $id;
    private $email;
    private $password;
    private $role_id;

    public function getId() {
        return $this->id;
    }

    function getEmail() {
        return $this->email;
    }
    function setEmail($email) {
        $this->email = $email;
    }

    function getPassword() {
        return $this->password;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function getRoleId() {
        return $this->role_id;
    }

    function setRoleId($value) {
        $this->role_id = $value;
    }

    public static function find($id)
    {
        $db = new DbManager('localhost', 3306, 'C:\Users\USER\Desktop\E-COMMERCE\file.txt');
        $pdo = $db->connect('ecommerce5E');

        $query = "SELECT * FROM users WHERE id = :id";
        try
        {
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $record = $stmt->fetchObject(__CLASS__);
            if ($record) {
                return $record;
            } else {
                return null; 
            }
        } 
        catch(PDOException $e)
        {
            die("\nErrore nella ricerca dell'elemento: " . $e->getMessage());
        }
    }

    public static function find_user($email)
    {
        $db = new DbManager('localhost', 3306, 'C:\Users\USER\Desktop\E-COMMERCE\file.txt');
        $pdo = $db->connect('ecommerce5E');

        $query = "SELECT * FROM users WHERE email = :email";
        try
        {
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $record = $stmt->fetchObject(__CLASS__);
            return $record;
        }
        catch(PDOException $e)
        {
            die("\nErrore nella ricerca dell'elemento: " . $e->getMessage());
        }
    }
}

?>