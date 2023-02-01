<?php
namespace App\Models;

use PDO;

class Task
{
    private static string $table_name = "tasks";
    private static $conn;

    // свойства объекта
    public static int $id;
    public static string $task;
    public static string $date;
    public static int $user_id;
    public static int $active;
    public static int $complited;

    public function __construct($db)
    {
        self::$conn = $db;
    }

    // данный метод используется в раскрывающемся списке
    public static function read()
    {
        // запрос MySQL: выбираем столбцы в таблице «categories»
        $query = "SELECT
                    *
                FROM
                    " . self::$table_name . "
                ORDER BY
                    date";

        $stmt = self::$conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public static function create()
    {
        // запрос MySQL для вставки записей в таблицу БД «products»
        $query = "INSERT INTO
                    " .self::table_name . "
                SET
                    task=:task, date=:date, user_id=:user_id, active=:active";

        $stmt = self::$conn->prepare($query);

        // опубликованные значения
        self::$task = htmlspecialchars(strip_tags(self::$task));
        self::$date = htmlspecialchars(strip_tags(self::$date));
        self::$user_id = htmlspecialchars(strip_tags(self::$user_id));
        self::$active = htmlspecialchars(strip_tags(self::$active));

        // привязываем значения
        $stmt->bindParam(":task", self::$task);
        $stmt->bindParam(":date", self::$date);
        $stmt->bindParam(":user_id", self::$user_id);
        $stmt->bindParam(":active", self::$active);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function readAll($from_record_num, $records_per_page)
    {
        // запрос MySQL
        $query = "SELECT
                id, task, date, user_id, active
            FROM
                " . self::$table_name . "
            ORDER BY
                date DESC}";

        $stmt = self::$conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public static function readOne()
    {
        // запрос MySQL
        $query = "SELECT
                task, date, user_id, active
            FROM
                " . self::$table_name . "
            WHERE
                id = ?
            LIMIT
                0,1";

        $stmt = self::$conn->prepare($query);
        $stmt->bindParam(1, self::$id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        self::$task = $row["task"];
        self::$date = $row["date"];
        self::$user_id = $row["user_id"];
        self::$active = $row["active"];
    }

    public function update()
    {
        // MySQL запрос для обновления записи (товара)
        $query = "UPDATE
                " . self::$table_name . "
            SET
                task = :task,
                date = :date,
                user_id = :user_id,
                active  = :active
            WHERE
                id = :id";

        // подготовка запроса
        $stmt = self::$conn->prepare($query);

        // очистка
        self::$task = htmlspecialchars(strip_tags(self::$task));
        self::$date = htmlspecialchars(strip_tags(self::$date));
        self::$user_id = htmlspecialchars(strip_tags(self::$user_id));
        self::$active = htmlspecialchars(strip_tags(self::$active));
        self::$id = htmlspecialchars(strip_tags(self::$id));

        // привязка значений
        $stmt->bindParam(":task", self::$task);
        $stmt->bindParam(":date", self::$date);
        $stmt->bindParam(":user_id", self::$user_id);
        $stmt->bindParam(":active", self::$active);
        $stmt->bindParam(":id", self::$id);

        // выполняем запрос
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function delete()
    {
        // запрос MySQL для удаления
        $query = "DELETE FROM " . self::$table_name . " WHERE id = ?";

        $stmt = self::$conn->prepare($query);
        $stmt->bindParam(1, $this->id);

        if ($result = $stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

}