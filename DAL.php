<?php

require_once 'config.php';

class DAL
{
    /**
     * @var PDO
     */
    private $db = null;

    /**
     * @var bool|PDOStatement
     */
    private $lastRequest = null;


    public function connect(): bool
    {
        try {
            $this->db = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME . '', USERNAME, PASSWORD);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (\PDOException $e) {
            echo 'Erreur !: ' . $e->getMessage();
        }
        return $this->isConnected();
    }


    public function isConnected(): bool
    {
        return $this->db != null;
    }


    public function disconnect(): bool
    {
        $this->db = null;
        return true;
    }


    public function execute(string $query, array $data): bool
    {
        try {
            $request = $this->db->prepare($query);
            foreach ($data as $key => $value) {
                $request->bindParam(':' . $key, $value);
            }
            $this->lastRequest = $request;
            return $request->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }


    public function lastInsertId()
    {
        try {
            return $this->db->lastInsertId();
        } catch (PDOException $exception) {
            echo $exception->getMessage();
            return 0;
        }
    }


    public function fetchData(): ?array
    {
        if ($this->db == null) {
            return null;
        }

        try {
            return $this->lastRequest->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }
}
