<?php

class DbManager {

    private $host;
    private $port;
    private $username;
    private $password;
    private $filename;

    public function __construct($host, $port, $filename) {
        $this->host = $host;
        $this->port = $port;
        $this->filename = $filename;
        $this->loadConfig();
    }

    private function loadConfig() {
        try {
            if (file_exists($this->filename)) {
                $lines = file($this->filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                if (count($lines) >= 1) {
                    $credentials = preg_split('/\s+/', $lines[0], 2);
                    if (count($credentials) === 2) {
                        list($this->username, $this->password) = $credentials;
                    }
                }
            }
        } catch (Exception $e) {
            die("Errore nel caricamento del file di configurazione: " . $e->getMessage());
        }
    }

    public function connect($dbname) {
        try {
            $dsn = "mysql:dbname={$dbname};host={$this->host};port={$this->port}";
            return new PDO($dsn, $this->username, $this->password);
        } catch (PDOException $e) {
            die("Errore di connessione al database: " . $e->getMessage());
        }
    }
}










