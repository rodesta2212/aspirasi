<?php
class Login {
    private $conn;
    private $table_user = "user";
    private $table_role1 = "mahasiswa";

    public $user;
    public $username;
    public $password;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function login() {
        $user = $this->checkMahasiswa();
        if ($user) {
            $this->user = $user;
            session_start();
            $_SESSION['id_user'] = $user['id_user'];
            $_SESSION['id_mahasiswa'] = $user['id_mahasiswa'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['password'] = $user['password'];
            $_SESSION['nama'] = $user['nama'];
            $_SESSION['role'] = $user['role'];
            return $user['nama'];
        }else {
            $user = $this->checkUsers();
            if ($user) {
                $this->user = $user;
                session_start();
                $_SESSION['id_user'] = $user['id_user'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['password'] = $user['password'];
                $_SESSION['nama'] = $user['nama'];
                $_SESSION['role'] = $user['role'];
                return $user['nama'];
            }
        }
        return false;
    }

    protected function checkMahasiswa() {
        $stmt = $this->conn->prepare('SELECT * FROM '.$this->table_user.' LEFT JOIN '.$this->table_role1.' ON '.$this->table_user.'.id_user='.$this->table_role1.'.id_user WHERE username=? AND password=? AND role="mahasiswa" LIMIT 1');
        $stmt->bindParam(1, $this->username);
        $stmt->bindParam(2, $this->password);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            $submitted_pass = $this->password;
            if ($submitted_pass == $data['password']) return $data;
        }
        return false;
    }

    protected function checkUsers() {
        $stmt = $this->conn->prepare('SELECT * FROM '.$this->table_user.' WHERE username=? AND password=? AND role!="mahasiswa" LIMIT 1');
        $stmt->bindParam(1, $this->username);
        $stmt->bindParam(2, $this->password);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            $submitted_pass = $this->password;
            if ($submitted_pass == $data['password']) return $data;
        }
        return false;
    }

    public function getUser() {
        return $this->user;
    }
}
