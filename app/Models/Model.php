<?php

namespace App\Models;

use PDO;
use function App\Helpers\env;

class Model {
    protected $db;
    protected $table;

    public function __construct() {
        $dbhost = env('DATABASE_HOST');
        $dbname = env('DATABASE_NAME');
        $dbuser = env('DATABASE_USERNAME');
        $dbpass = env('DATABASE_PASSWORD');
        $this->db = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    }

    public function find($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM $this->table WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $keys = array_keys($data);
        $columns = implode(', ', $keys);
        $values = ':' . implode(', :', $keys);
        $stmt = $this->db->prepare("INSERT INTO $this->table ($columns) VALUES ($values)");
        $stmt->execute($data);
        return $this->db->lastInsertId();
    }

    public function update($id, $data)
    {
        $set = '';
        $keys = array_keys($data);
        foreach ($keys as $key) {
            $set .= "$key=:$key, ";
        }
        $set = rtrim($set, ', ');
        $stmt = $this->db->prepare("UPDATE $this->table SET $set WHERE id = :id");
        $data['id'] = $id;
        $stmt->execute($data);
        return $stmt->rowCount();
    }

    public function getAll($where = '', $params = [], $sort = '', $dir = '')
    {
        $query = "SELECT * FROM $this->table";
        if (!empty($where)) {
            $query .= " WHERE $where";
        }
        if (!empty($sort)) {
            $sortOrder = strtoupper($dir) === 'DESC' ? 'DESC' : 'ASC';
            $query .= " ORDER BY $sort $sortOrder";
        }
        $stmt = $this->db->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteWhere($where = '', $params = [])
    {
        $query = "DELETE FROM $this->table";
        if (!empty($where)) {
            $query .= " WHERE $where";
        }
        $stmt = $this->db->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM $this->table WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->rowCount();
    }
}
