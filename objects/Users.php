<?php
class Users
{
    private Database $db;
    public function __construct()
    {
        $this->db = Database::connect();
        try {
            $this->db->query("CREATE TABLE IF NOT EXISTS Users
(
    Id       INT(6) UNSIGNED UNIQUE AUTO_INCREMENT PRIMARY KEY,
    Name     VARCHAR(255) NOT NULL,
    Email    VARCHAR(255) UNIQUE,
    Password VARCHAR(50)  NOT NULL,
    GoogleEmail VARCHAR(255) UNIQUE
);");
        } catch (Exception $e) {
            Everything::Log($e->getMessage());
            die($e->getMessage());
        }
    }
    public function GetInfo(int $uid) : ?array {
        try {
            $result = $this->db->query("SELECT Name,Email FROM Users WHERE Id = $uid");
            $response = $result->fetch_assoc();
            if ($uid !== Everything::$uid) {
                $response["Email"] = "<private>";
            }
            return $response;
        } catch (Exception $e) {
            return null;
        }
    }
    public function Count() : int {
        try {
            $result = $this->db->query("SELECT * FROM Users");
            return $result->num_rows;
        } catch(Exception $e) {
            return 0;
        }
    }
    public function Login(string $email, string $password, bool $hashed = false) : ?int {
        $email = $this->db->sanitize($email);
        if ($hashed) {
            $password = $this->db->sanitize($password);
        } else {
            $password = sha1($password);
        }
        try {
            $result = $this->db->query("SELECT * FROM Users WHERE Email = '$email' AND Password = '$password'");
            $assoc = $result->fetch_assoc();
            if (!isset($assoc["Id"])) {
                return null;
            } else {
                return (int)$assoc["Id"];
            }
        } catch(Exception $e) {
            Everything::Log($e->getMessage());
            return null;
        }
    }
    public function LoginFromCookies(): ?int
    {
        if (@!isset($_COOKIE['email']) || @!isset($_COOKIE['password'])) {
            return null;
        } else if (@$_COOKIE['email'] == null || @$_COOKIE['password'] == null) {
            return null;
        }
        return $this->Login($_COOKIE['email'], $_COOKIE['password'], true);

    }
    public function LoginToCookies(string $email, string $password, bool $real = true): ?int
    {
        $opts =  [
            'expires' => time() + (86400 * 30 * 365),
            'path' => '/',
            'secure' => true,
            'samesite' => 'None'
        ];
        setcookie('email', $email, $opts);
        if ($real) {
            setcookie('password', sha1($password), $opts);
        } else {
            setcookie('password', $password, $opts);
        }
        return $this->Login($email, $password, !$real);
    }
    public function Logout() {
        $opts =  [
            'expires' => time() - 1,
            'path' => '/',
            'secure' => true,
            'samesite' => 'None'
        ];
        setcookie('email', "", $opts);
        setcookie('password', "", $opts);
    }

    public function AttachGoogleAccount(int $uid, string $googleAccountEmail) : bool {
        $gmail = $this->db->sanitize($googleAccountEmail);
        try {
            $this->db->query("UPDATE Users SET GoogleEmail = '$gmail' WHERE Id = $uid;");
            return true;
        } catch (Exception $e) {
            Everything::Log($e->getMessage());
            return false;
        }
    }

    public function LoginFromGoogleAccount(string $googleAccountEmail) : ?int {
        $gmail = $this->db->sanitize($googleAccountEmail);
        try {
            $query = $this->db->query("SELECT * FROM Users WHERE GoogleEmail = '$gmail';");
            if ($query->num_rows != 1) {
                return null;
            }
            $assoc = $query->fetch_assoc();
            return $this->LoginToCookies($assoc['Email'], $assoc['Password'], false);
        } catch(Exception $e) {
            Everything::Log($e->getMessage());
            return null;
        }
    }

    public function Register(string $name, string $email, string $password) : ?int
    {
        $name = $this->db->sanitize($name);
        $email = $this->db->sanitize($email);
        $real_pw = $password;
        $password = sha1($password);
        try {
            $this->db->query("INSERT INTO Users (Name, Email, Password) VALUES('$name', '$email', '$password');");
            return $this->LoginToCookies($email, $real_pw);
        } catch (Exception $e) {
            Everything::Log($e->getMessage());
            return null;
        }
    }
}
