<?php
class CheckedFacebookPage {
    private Database $db;
    public function __construct()
    {
        $this->db = Database::connect();
        try {
            $this->db->query("CREATE TABLE IF NOT EXISTS CheckedFacebookPage
(
    Opinion         BOOL NOT NULL,
    Timestamp       TIMESTAMP DEFAULT NOW(),
    Uid             INT(6) NOT NULL,
    Url             VARCHAR(255) NOT NULL,
    Comment         VARCHAR(255),
    ScreenshotUrl   VARCHAR(255),
    CreatedAt       TIMESTAMP DEFAULT NOW(),
    Followers       INT,
    ChangeName      BOOL
    );");
        } catch (Exception $e) {
            Everything::Log($e->getMessage());
            die($e->getMessage());
        }
    }
    public function GetAll() : array {
        $sites = [];
        try {
            $result = $this->db->query("SELECT * FROM CheckedFacebookPage");
            while($row = $result->fetch_assoc()) {
                $row["Type"] = "Facebook";
                $sites[] = $row;
            }
        } catch (Exception $e) {
            Everything::Log($e->getMessage());
        }

        return $sites;
    }
    public function CheckIfCanRate(int $uid, string $url) : bool {
        try {
            $previous = $this->db->query("SELECT * FROM CheckedFacebookPage WHERE Uid = $uid AND Url LIKE '%$url';");
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
    public function GetAllByUrl(string $url) : array {
        $sites = [];
        $url = $this->db->sanitize($url);
        try {
            $result = $this->db->query("SELECT * FROM CheckedFacebookPage WHERE Url LIKE '%$url' ORDER BY Timestamp DESC");
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
            $result = $this->db->query("SELECT * FROM CheckedFacebookPage WHERE Uid = $uid;");
            while($row = $result->fetch_assoc()) {
                $sites[] = $row;
            }
        } catch (Exception $e) {
            Everything::Log($e->getMessage());
        }
        return $sites;
    }
    public function FixUrl(string $url): string
    {
        if (substr($url, strlen($url)-1) === "/") {
            return $url;
        }
        return $url . "/";
    }
    public function AppendNegative(
        int $uid, string $url, string $comment,
        string $screenshot_url, int $created_at,
        int $followers, bool $changed_name
    ) : bool {
        $uid = $this->db->sanitize($uid);
        $url = $this->FixUrl($this->db->sanitize($url));
        $comment = $this->db->sanitize($comment);
        $screenshot_url = $this->db->sanitize($screenshot_url);
        $changed_name = $changed_name ? "true" : "false";
        if ($this->CheckIfCanRate($uid, $url)) {
            try {
                $this->db->query("
INSERT INTO 
    CheckedFacebookPage (Opinion, Uid, Url, Comment, ScreenshotUrl, CreatedAt, Followers, ChangeName) 
    VALUES(false, '$uid', '$url', '$comment', '$screenshot_url', $created_at, $followers, $changed_name);
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
    public function Count() : int
    {
        try {
            $result = $this->db->query("SELECT * FROM CheckedFacebookPage");
            return $result->num_rows;
        } catch(Exception $e) {
            return 0;
        }
    }
    public function AppendPositive(int $uid, string $url, string $comment) : bool {
        $uid = $this->db->sanitize($uid);
        $url = $this->FixUrl($this->db->sanitize($url));
        $comment = $this->db->sanitize($comment);
        if ($this->CheckIfCanRate($uid, $url)) {
            try {
                $this->db->query("INSERT INTO CheckedFacebookPage (Opinion, Uid, Url, Comment) VALUES(true, '$uid', '$url', '$comment');");
            } catch (Exception $e) {
                Everything::Log($e->getMessage());
                return false;
            }
            return true;
        } else {
            return false;
        }
    }

    public function CountProblematic(): int
    {

        try {
            $result = $this->db->query("SELECT * FROM CheckedFacebookPage WHERE Opinion = 0");
            return $result->num_rows;
        } catch (Exception $e) {
            return 0;
        }
    }
}
