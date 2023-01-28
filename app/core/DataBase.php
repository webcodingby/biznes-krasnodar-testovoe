<?php


namespace App\Core;

use PDO;
use PDOException;

class DataBase
{
    /**
     * @var PDO
     */
    private PDO $db;

    // Соединение с БД
    public function __construct()
    {
        $config = require 'config/db.php';
        try {
            $this->db = new PDO(
                "mysql:host=" . $config['host'] . ";
                port=" . $config['port'] . ";
                dbname=" . $config['dbname'],
                $config['username'],
                $config['password']
            );
        } catch (PDOException $exception) {
            echo "Ошибка соединения: " . $exception->getMessage();
        }

        return self::getDb();
    }

    // Операции над БД
    public function query($sql, $params = [])
    {
        // Подготовка запроса
        $stmt = $this->db->prepare($sql);

        // Обход массива с параметрами
        // и подставляем значения
        if ( !empty($params) ) {
            foreach ($params as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }
        }

        // Выполняя запрос
        $stmt->execute();
        // Возвращаем ответ
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAll($table, $sql = '', $params = [])
    {
        return $this->query("SELECT * FROM $table" . $sql, $params);
    }

    public function getRow($table, $sql = '', $params = [])
    {
        $result = $this->query("SELECT * FROM $table" . $sql, $params);
        return $result[0];
    }

    /**
     * @return PDO
     */
    public function getDb(): PDO
    {
        return $this->db;
    }
}