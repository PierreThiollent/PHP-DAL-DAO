<?php

require_once 'Truc.php';

class TrucDAO
{

    /**
     * @var $dal
     */
    private $dal;


    /**
     * TrucDAO constructor.
     * @param $dal
     */
    public function __construct($dal)
    {
        $this->dal = $dal;
    }

    /**
     * Add Truc
     * @param Truc $truc
     * @return mixed
     */
    public function add(Truc $truc)
    {
        $sql = 'INSERT INTO Truc (id, name) values (null, :name)';
        $this->dal->execute($sql, [
            'name' => $truc->getName()
        ]);
        $id = $this->dal->lastInsertId();
        $truc->setId($id);
        return true;
    }


    /**
     * Get one Truc by id
     * @param int $id
     * @return Truc
     */
    public function get(int $id): Truc
    {
        $sql = 'SELECT id, name FROM Truc WHERE id = :id';
        $this->dal->execute($sql, ['id' => $id]);

        $data = $this->dal->fetchData();

        $truc = new Truc();
        $truc->setId($data[0]['id'] ?? null);
        $truc->setName($data[0]['name'] ?? null);

        return $truc;
    }


    public function update(Truc $truc)
    {
        $sql = 'UPDATE Truc set name = :name';
        $this->dal->execute($sql, [
            'name' => $truc->getName()
        ]);
        return true;
    }

    public function delete(Truc $truc)
    {
        $sql = 'DELETE FROM Truc WHERE id = :id';
        return $this->dal->execute($sql, [
            'id' => $truc->getId()
        ]);
    }

    public function searchByName(string $name)
    {
        $sql = 'SELECT id, name FROM Truc WHERE name = :name';
        $this->dal->execute($sql, ['name' => $name]);

        return $this->dal->fetchData();
    }
}
