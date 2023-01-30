<?php
namespace App\Models;

class Task
{
    private $conn;
    private $table_name = "tasks";

    // свойства объекта
    public $id;
    public $task;
    public $date;
    public $user_id;
    public $active;
    public $complited;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // данный метод используется в раскрывающемся списке
    function read()
    {
        // запрос MySQL: выбираем столбцы в таблице «categories»
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . "
                ORDER BY
                    date";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    function create()
    {
        // запрос MySQL для вставки записей в таблицу БД «products»
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    task=:task, date=:date, user_id=:user_id, active=:active";

        $stmt = $this->conn->prepare($query);

        // опубликованные значения
        $this->task = htmlspecialchars(strip_tags($this->name));
        $this->date = htmlspecialchars(strip_tags($this->price));
        $this->user_id = htmlspecialchars(strip_tags($this->description));
        $this->active = htmlspecialchars(strip_tags($this->category_id));

        // привязываем значения
        $stmt->bindParam(":task", $this->task);
        $stmt->bindParam(":date", $this->date);
        $stmt->bindParam(":user_id", $this->user_id);
        $stmt->bindParam(":active", $this->active);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function readAll($from_record_num, $records_per_page)
    {
        // запрос MySQL
        $query = "SELECT
                *
            FROM
                " . $this->table_name . "
            WHERE
                user_id = 
            ORDER BY
                date ASC
            LIMIT
                {$from_record_num}, {$records_per_page}";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function countAll()
    {
        // запрос MySQL
        $query = "SELECT id FROM " . $this->table_name . "";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $num = $stmt->rowCount();

        return $num;
    }
}