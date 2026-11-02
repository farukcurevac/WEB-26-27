<?php
require_once __DIR__ . '/../../config/config.php';

class BaseDao {
    private static $connection = null;
    protected $table_name;
    protected $columns;

    public function __construct($table_name, $columns = []) {
        $this->table_name = $table_name;
        $this->columns = $columns;
    }

    public static function connection() {
        if (self::$connection === null) {
            try {
                self::$connection = new PDO(
                    "mysql:host=" . Config::DB_HOST() . ";port=" . Config::DB_PORT() . ";dbname=" . Config::DB_NAME() . ";charset=utf8mb4",
                    Config::DB_USER(),
                    Config::DB_PASSWORD(),
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                    ]
                );
            } catch (PDOException $e) {
                die("Konekcija na bazu nije uspjela: " . $e->getMessage());
            }
        }
        return self::$connection;
    }

    protected function query($query, $params = []) {
        $stmt = self::connection()->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    protected function query_unique($query, $params = []) {
        $results = $this->query($query, $params);
        return $results[0] ?? null;
    }

    protected function execute($query, $params = []) {
        $stmt = self::connection()->prepare($query);
        $stmt->execute($params);
        return $stmt->rowCount();
    }

    protected function only_columns($entity) {
        return array_intersect_key($entity, array_flip($this->columns));
    }

    public function get_all() {
        return $this->query("SELECT * FROM " . $this->table_name);
    }

    public function get_by_id($id) {
        return $this->query_unique("SELECT * FROM " . $this->table_name . " WHERE id = :id", ["id" => $id]);
    }

    public function count_all() {
        return (int) $this->query_unique("SELECT COUNT(*) AS total FROM " . $this->table_name)["total"];
    }

    public function add($entity) {
        $entity = $this->only_columns($entity);
        $columns = array_keys($entity);
        $query = "INSERT INTO {$this->table_name} (" . implode(", ", $columns) . ") VALUES (:" . implode(", :", $columns) . ")";
        $this->execute($query, $entity);
        $entity["id"] = (int) self::connection()->lastInsertId();
        return $entity;
    }

    public function update($entity, $id) {
        $entity = $this->only_columns($entity);
        $fields = "";
        foreach ($entity as $key => $value) {
            $fields .= "$key = :$key, ";
        }
        $fields = rtrim($fields, ", ");

        $query = "UPDATE {$this->table_name} SET {$fields} WHERE id = :id";
        $params = array_merge($entity, ["id" => $id]);
        $this->execute($query, $params);
        return $this->get_by_id($id);
    }

    public function delete($id) {
        return $this->execute("DELETE FROM " . $this->table_name . " WHERE id = :id", ["id" => $id]);
    }

    public function begin_transaction() {
        self::connection()->beginTransaction();
    }

    public function commit() {
        self::connection()->commit();
    }

    public function rollback() {
        self::connection()->rollBack();
    }
}