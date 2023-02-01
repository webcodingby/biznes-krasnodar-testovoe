<?php


namespace App\Core;

use PDO;
use PDOException;

class DataBase
{
    /**
     * Объект PDO.
     */
    public static $dbh = null;

    /**
     * Statement Handle.
     */
    public static $sth = null;

    /**
     * Выполняемый SQL запрос.
     */
    public static $query = '';

    /**
     * Подключение к БД.
     */
    public static function getDbh()
    {
        if (!self::$dbh) {
            try {
                $config = require 'config/db.php';
                self::$dbh = new PDO(
                    'mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'].';port='.$config['port'],
                    $config['username'],
                    $config['password'],
                    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'")
                );
                self::$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            } catch (PDOException $e) {
                exit('Error connecting to database: ' . $e->getMessage());
            }
        }
        return self::$dbh;
    }

    /**
     * Закрытие соединения.
     */
    public static function destroy()
    {
        self::$dbh = null;
        return self::$dbh;
    }

    /**
     * Получение ошибки запроса.
     */
    public static function getError()
    {
        $info = self::$sth->errorInfo();
        return (isset($info[2])) ? 'SQL: ' . $info[2] : null;
    }

    /**
     * Получение строки из таблицы.
     */
    public static function getRow($query, $param = array())
    {
        self::$sth = self::getDbh()->prepare($query);
        self::$sth->execute((array) $param);
        return self::$sth->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Получение всех строк из таблицы.
     */
    public static function getAll($query, $param = array())
    {
        self::$sth = self::getDbh()->prepare($query);
        self::$sth->execute((array) $param);
        return self::$sth->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Получение значения.
     */
    public static function getValue($query, $param = array(), $default = null)
    {
        $result = self::getRow($query, $param);
        if (!empty($result)) {
            $result = array_shift($result);
        }
        return (empty($result)) ? $default : $result;
    }

    public static function insertTask($task,$date,$user_id,$active,$complited)
    {
        $data = [
            'task' => $task,
            'date' => $date,
            'user_id' => $user_id,
            'active' => $active,
            'complited' => $complited,
        ];
        $sql = "INSERT INTO tasks (task, date, user_id, active, complited) VALUES (:task, :date, :user_id, :active, :complited)";
        $stmt = self::getDbh()->prepare($sql);
        $stmt->execute($data);
        return self::getDbh()->lastInsertId();
    }

    public static function getTask($id): array
    {
        $sql = "SELECT * FROM tasks WHERE id = :id";
        $stmt = self::getDbh()->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        $value = $stmt->fetch(PDO::FETCH_COLUMN);
        return $value;
    }

    public static function updateTask($data): string
    {
        $data = [
            'id' => $data['id'],
            'task' => $data['task'],
            'date' => $data['date'],
            'user_id' => $data['user_id'],
            'active' => $data['active'],
            'complited' => $data['complited'],
        ];
        $sql = "UPDATE tasks SET task=:task, date=:date, user_id=:user_id,active=:active, complited=:complited WHERE id = :id";
        $stmt = self::getDbh()->prepare($sql);
        $stmt->bindValue(":id", $data['id']);
        $stmt->bindValue(":task", $data['task']);
        $stmt->bindValue(":date", $data['date']);
        $stmt->bindValue(":user_id", $data['user_id']);
        $stmt->bindValue(":active", $data['active']);
        $stmt->bindValue(":complited", $data['complited']);

        $stmt->execute();

        return 'Задача обновлена!';
    }

    public static function getRequest($table, $where = '', $order = '',$limit = ''): array
    {
        $sql = "SELECT * FROM $table $where $order $limit";
        $stmt = self::getDbh()->query($sql);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public static function getTasks($table, $id, $offset, $itemsPerPage): array
    {
        $sql = "SELECT * FROM $table WHERE user_id=`$id` ORDER BY date LIMIT $offset,$itemsPerPage";
        $stmt = self::getDbh()->query($sql);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public static function getTasksCount($table, $where = '', $order = '') : array
    {
        $sql = "SELECT COUNT(*) AS count FROM $table $where $order";
        $stmt = self::getDbh()->query($sql);
        $data = $stmt->fetchAll();
        return $data;
    }


    public static function deleteTask($id)
    {
        $sql = "DELETE FROM `tasks` WHERE `id` = $id";
        $affectedRowsNumber = self::getDbh()->exec($sql);
        return $affectedRowsNumber;
    }
}