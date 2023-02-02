<?php


namespace App\Core;

use PDO;
use PDOException;

class DataBase
{
    /**
     * Объект PDO.
     */
    public static ?PDO $dbh = null;

    /**
     * Statement Handle.
     */
    public static $sth = null;

    /**
     * Выполняемый SQL запрос.
     */
    public static string $query = '';

    /**
     * Подключение к БД.
     */
    public static function getDbh(): ?PDO
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

    public static function insert($data, $tableAndColumn, $valuesColumn): string
    {
        $sql = "INSERT INTO $tableAndColumn  VALUES $valuesColumn";

        $stmt = self::getDbh()->prepare($sql);
        $stmt->execute($data);
        return self::getDbh()->lastInsertId();
    }

    public static function getRequest($table, $where = '', $order = '',$limit = ''): array
    {
        $sql = "SELECT * FROM $table $where $order $limit";
        return self::getDbh()->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function insertTask($task,$date,$user_id,$active,$done): string
    {
        $data = [
            'task' => $task,
            'date' => $date,
            'user_id' => $user_id,
            'active' => $active,
            'done' => $done,
        ];
        $sql = "INSERT INTO tasks (task, date, user_id, active, done) VALUES (:task, :date, :user_id, :active, :done)";
        self::getDbh()->prepare($sql)->execute($data);
        return self::getDbh()->lastInsertId();
    }

    public static function getTask($id): array
    {
        $sql = "SELECT * FROM tasks WHERE id = $id";
        return self::getDbh()->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function updateTask($form, $id): string
    {
        $sql = 'UPDATE tasks SET task=:task, date=:date, user_id=:user_id, active=:active, done=:done WHERE id = :id';
        $data = self::getDbh()->prepare($sql);
        $data->execute(array(
            ':task' => $form['task'],
            ':date' => $form['date'],
            ':user_id' => $form['user_id'],
            ':active' => $form['active'],
            ':done' => $form['done'],
            ':id' => $id,
        ));
        return $data->rowCount(); //выведет: 1
    }


    public static function getTasks($table, $id, $offset, $itemsPerPage): array
    {
        $sql = "SELECT * FROM $table WHERE user_id=`$id` ORDER BY date LIMIT $offset,$itemsPerPage";
        return self::getDbh()->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getId($table, $where, $id): int
    {
        $sql = "SELECT id FROM $table WHERE $where=`$id`";
        return self::getDbh()->query($sql);
    }

    public static function getTasksCount($table, $where = '', $order = '') : array
    {
        $sql = "SELECT COUNT(*) AS count FROM $table $where $order";
        return self::getDbh()->query($sql)->fetchAll();
    }

    public static function deleteTask($id): bool|int
    {
        $sql = "DELETE FROM `tasks` WHERE `id` = $id";
        return self::getDbh()->exec($sql);
    }
}