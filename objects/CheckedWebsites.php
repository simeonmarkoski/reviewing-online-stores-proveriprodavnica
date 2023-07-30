<?php
class CheckedWebsites {
    private Database $db;
    public function __construct()
    {
        $this->db = Database::connect();
        try {
            $this->db->query("CREATE TABLE IF NOT EXISTS CheckedWebsites
(
    Opinion         BOOL NOT NULL,
    Timestamp       TIMESTAMP DEFAULT NOW(),
    Uid             INT(6) NOT NULL,
    Url             VARCHAR(255) NOT NULL,
    Comment         VARCHAR(255),
    ScreenshotUrl   VARCHAR(255),
    HasSSL          BOOL,
    IsCompany       BOOL,
    HasContact      BOOL
);");
        } catch (Exception $e) {
            Everything::Log($e->getMessage());
            die($e->getMessage());
        }
    }
    public function CheckIfCanRate(int $uid, string $url) : bool {
        try {
            $previous = $this->db->query("SELECT * FROM CheckedWebsites WHERE Uid = $uid AND Url LIKE '%$url';");
            if ($previous->num_rows === 0) {
                return true;
            } else {
                return false;
            }
        } catch(Exception $e) {
            Everything::Log($e->getMessage());
            return true;
        }
    }
    public function GetAll() : array {
        $sites = [];
        try {
            $result = $this->db->query("SELECT * FROM CheckedWebsites");
            while($row = $result->fetch_assoc()) {
                $row["Type"] = "Website";
                $sites[] = $row;
            }
        } catch (Exception $e) {
            // lmao
        }

        return $sites;
    }
    public function GetAllByUrl(string $url) : array {
        $sites = [];
        Everything::Log($url);
        $url = $this->db->sanitize($url);
        try {
            $result = $this->db->query("SELECT * FROM CheckedWebsites WHERE Url LIKE '%$url' ORDER BY Timestamp DESC");
            while($row = $result->fetch_assoc()) {
                $sites[] = $row;
            }
        } catch (Exception $e) {
            Everything::Log($e->getMessage());
        }
        return $sites;
    }
    public function GetAllByUid(int $uid) : array {
        $sites = [];
        try {
            $result = $this->db->query("SELECT * FROM CheckedWebsites WHERE Uid = $uid;");
            while($row = $result->fetch_assoc()) {
                $sites[] = $row;
            }
        } catch (Exception $e) {
            Everything::Log($e->getMessage());
        }
        return $sites;
    }
    public function AppendNegative(
        int $uid, string $url, string $comment,
        string $screenshot_url, bool $has_ssl,
        bool $is_company, bool $has_contact
    ) : bool {
        $uid = $this->db->sanitize($uid);
        $url = $this->db->sanitize($url);
        $comment = $this->db->sanitize($comment);
        $screenshot_url = $this->db->sanitize($screenshot_url);
        $is_company = $is_company ? "true" : "false";
        $has_ssl = $has_ssl ? "true" : "false";
        $has_contact = $has_contact ? "true" : "false";
        if ($this->CheckIfCanRate($uid, $url)) {
            try {
                $this->db->query("
INSERT INTO 
    CheckedWebsites (Opinion, Uid, Url, Comment, ScreenshotUrl, HasSSL, IsCompany, HasContact) 
    VALUES(false, '$uid', '$url', '$comment', '$screenshot_url', $has_ssl, $is_company, $has_contact);
    ");
            } catch (Exception $e) {
                Everything::Log($e->getMessage());
                return false;
            }
            return true;
        } else {
            return false;
        }

    }
    public function AppendPositive(int $uid, string $url, string $comment) : bool {
        $uid = $this->db->sanitize($uid);
        $url = $this->db->sanitize($url);
        $comment = $this->db->sanitize($comment);
        if ($this->CheckIfCanRate($uid, $url)) {
            try {
                $this->db->query("INSERT INTO CheckedWebsites (Opinion, Uid, Url, Comment) VALUES(true, '$uid', '$url', '$comment');");
            } catch (Exception $e) {
                Everything::Log($e->getMessage());
                return false;
            }
            return true;
        } else {
            return false;
        }
    }

    public function Count() : int
    {
        try {
            $result = $this->db->query("SELECT * FROM CheckedWebsites");
            return $result->num_rows;
        } catch(Exception $e) {
            return 0;
        }
    }

    public function CountProblematic() : int
    {
        try {
            $result = $this->db->query("SELECT * FROM CheckedWebsites WHERE Opinion = 0");
            return $result->num_rows;
        } catch(Exception $e) {
            return 0;
        }
    }
}
