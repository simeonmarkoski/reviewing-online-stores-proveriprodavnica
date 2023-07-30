<?php
class Database
{
    private mysqli $connection;
    private static ?Database $db = null;
    private function __construct(array $db_conf) {
        $this->connection = new mysqli($db_conf["hostname"], $db_conf["username"], $db_conf["password"], $db_conf["database"]);
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public static function connect() : Database
    {
        if (self::$db === null) {
            self::$db = new Database(json_decode(file_get_contents(__DIR__ . "/db_conf.json"), true));
        }
        return self::$db;
    }

    public static function die() {
        self::$db = null;
    }


    /**
     * @throws Exception
     */
    public function query(string $query) : mysqli_result
    {
        $result = $this->connection->query($query);
        if (!$result) {
            throw new Exception($this->connection->error);
        }
        if (gettype($result) == "boolean") {
            return new mysqli_result($this->connection);
        }
        return $result;
    }

    public function __destruct()
    {
        $this->connection->close();
    }

    public function sanitize($string): string
    {
        return $this->connection->real_escape_string($string);
    }

}