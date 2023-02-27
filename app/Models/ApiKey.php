<?php

namespace App\Models;

use PDO;

class ApiKey extends Model
{
    protected $table = 'api_keys';

    public function whereUserId(int $user_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM $this->table WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function whereKey($key_value)
    {
        $stmt = $this->db->prepare("SELECT * FROM $this->table WHERE key_value = :key_value");
        $stmt->bindParam(':key_value', $key_value);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
