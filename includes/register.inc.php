<?php
class Register {
    private $conn;
    private $table_mahasiswa = 'mahasiswa';

    public $id_mahasiswa;
    public $nama;
    public $jurusan;
    public $jenis_kelamin;
    public $telp;
    public $email;
    public $nim;
    public $id_user;

	public function __construct($db) {
		$this->conn = $db;
	}

    function insert() {
        $query = "INSERT INTO {$this->table_mahasiswa} (id_mahasiswa, id_user, nama, jurusan, jenis_kelamin, telp, email, nim) VALUES(:id_mahasiswa, :id_user, :nama, :jurusan, :jenis_kelamin, :telp, :email, :nim)";

        $stmt = $this->conn->prepare($query);
        // mahasiswa
        $stmt->bindParam(':id_mahasiswa', $this->id_mahasiswa);
        $stmt->bindParam(':id_user', $this->id_user);
		$stmt->bindParam(':nama', $this->nama);
        $stmt->bindParam(':jurusan', $this->jurusan);
        $stmt->bindParam(':jenis_kelamin', $this->jenis_kelamin);
        $stmt->bindParam(':telp', $this->telp);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':nim', $this->nim);

		if ($stmt->execute()) {
            // var_dump($stmt);
			return true;
		} else {
            var_dump($this->jurusan);
			return false;
		}
	}
	
	function getNewID() {
		$query = "SELECT MAX(id_mahasiswa) AS code FROM {$this->table_mahasiswa}";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if ($row) {
			return $this->genCode($row["code"], '');
		} else {
			return $this->genCode($nomor_terakhir, '');
		}
	}

	function genCode($latest, $key, $chars = 0) {
    $new = intval(substr($latest, strlen($key))) + 1;
    $numb = str_pad($new, $chars, "0", STR_PAD_LEFT);
    return $key . $numb;
	}

	function genNextCode($start, $key, $chars = 0) {
    $new = str_pad($start, $chars, "0", STR_PAD_LEFT);
    return $key . $new;
	}

}
