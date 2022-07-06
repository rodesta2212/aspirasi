<?php
class Aspirasi {
	private $conn;
    private $table_aspirasi = 'aspirasi';
    private $table_mahasiswa = 'mahasiswa';
	private $table_kategori = 'kategori';
	private $table_advokasi = 'advokasi';

    public $id_aspirasi;
    public $id_mahasiswa;
    public $aspirasi;
    public $id_kategori;
    public $status;

	public function __construct($db) {
		$this->conn = $db;
	}

	function insert() {
		$query = "INSERT INTO {$this->table_aspirasi} VALUES(?, ?, ?, ?, ?)";

		$stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_aspirasi);
        $stmt->bindParam(2, $this->aspirasi);
        $stmt->bindParam(3, $this->id_kategori);
        $stmt->bindParam(4, $this->id_mahasiswa);
        $stmt->bindParam(5, $this->status);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
	
	function getNewID() {
		$query = "SELECT MAX(id_aspirasi) AS code FROM {$this->table_aspirasi}";
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

	function readAll() {
		$query = "SELECT A.id_aspirasi, B.nama AS nama_mahasiswa, A.aspirasi, C.nama AS nama_kategori, C.bidang, A.status 
		FROM {$this->table_aspirasi} A 
		LEFT JOIN {$this->table_mahasiswa} B ON A.id_mahasiswa=B.id_mahasiswa 
		LEFT JOIN {$this->table_kategori} C ON A.id_kategori=C.id_kategori 
		ORDER BY id_aspirasi ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function readAllMahasiswa() {
		$query = "SELECT A.id_aspirasi, B.nama AS nama_mahasiswa, A.aspirasi, C.nama AS nama_kategori, C.bidang, A.status 
		FROM {$this->table_aspirasi} A 
		LEFT JOIN {$this->table_mahasiswa} B ON A.id_mahasiswa=B.id_mahasiswa 
		LEFT JOIN {$this->table_kategori} C ON A.id_kategori=C.id_kategori 
		WHERE A.id_mahasiswa=:id_mahasiswa
		ORDER BY id_aspirasi ASC";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id_mahasiswa', $this->id_mahasiswa);
		$stmt->execute();

		return $stmt;
	}

	function readOne() {
		$query = "SELECT A.id_aspirasi, A.id_mahasiswa, B.nama AS nama_mahasiswa, B.nim, B.jurusan, B.jenis_kelamin, A.aspirasi, A.id_kategori, C.nama AS nama_kategori, C.bidang, A.status 
		FROM {$this->table_aspirasi} A 
		LEFT JOIN {$this->table_mahasiswa} B ON A.id_mahasiswa=B.id_mahasiswa 
		LEFT JOIN {$this->table_kategori} C ON A.id_kategori=C.id_kategori 
		WHERE id_aspirasi=:id_aspirasi LIMIT 0,1";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id_aspirasi', $this->id_aspirasi);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->id_aspirasi = $row['id_aspirasi'];
		$this->id_mahasiswa = $row['id_mahasiswa'];
		$this->nama_mahasiswa = $row['nama_mahasiswa'];
		$this->nim = $row['nim'];
		$this->jurusan = $row['jurusan'];
		$this->jenis_kelamin = $row['jenis_kelamin'];
        $this->aspirasi = $row['aspirasi'];
        $this->id_kategori = $row['id_kategori'];
		$this->nama_kategori = $row['nama_kategori'];
		$this->bidang = $row['bidang'];
        $this->status = $row['status'];
	}

	function readOneDetail() {
		$query = "SELECT A.id_aspirasi, A.id_mahasiswa, B.nama AS nama_mahasiswa, B.nim, 
		B.jurusan, B.jenis_kelamin, A.aspirasi, A.id_kategori, C.nama AS nama_kategori, 
		C.bidang, A.status, D.advokasi, D.file 
		FROM {$this->table_aspirasi} A 
		LEFT JOIN {$this->table_mahasiswa} B ON A.id_mahasiswa=B.id_mahasiswa 
		LEFT JOIN {$this->table_kategori} C ON A.id_kategori=C.id_kategori 
		LEFT JOIN {$this->table_advokasi} D ON A.id_aspirasi=D.id_aspirasi 
		WHERE A.id_aspirasi=:id_aspirasi LIMIT 0,1";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id_aspirasi', $this->id_aspirasi);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->id_aspirasi = $row['id_aspirasi'];
		$this->id_mahasiswa = $row['id_mahasiswa'];
		$this->nama_mahasiswa = $row['nama_mahasiswa'];
		$this->nim = $row['nim'];
		$this->jurusan = $row['jurusan'];
		$this->jenis_kelamin = $row['jenis_kelamin'];
        $this->aspirasi = $row['aspirasi'];
        $this->id_kategori = $row['id_kategori'];
		$this->nama_kategori = $row['nama_kategori'];
		$this->bidang = $row['bidang'];
        $this->status = $row['status'];
		$this->advokasi = $row['advokasi'];
		$this->file = $row['file'];
	}

	function update() {
		$query = "UPDATE {$this->table_aspirasi}
			SET
                id_aspirasi = :id_aspirasi,
				id_mahasiswa = :id_mahasiswa,
                aspirasi = :aspirasi,
                id_kategori = :id_kategori,
				status = :status
			WHERE
				id_aspirasi = :id";
        $stmt = $this->conn->prepare($query);

		$stmt->bindParam(':id_aspirasi', $this->id_aspirasi);
		$stmt->bindParam(':id_mahasiswa', $this->id_mahasiswa);
        $stmt->bindParam(':aspirasi', $this->aspirasi);
        $stmt->bindParam(':id_kategori', $this->id_kategori);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':id', $this->id_aspirasi);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
	
	function delete() {
		$query = "DELETE FROM {$this->table_aspirasi} WHERE id_aspirasi = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id_aspirasi);
		if ($result = $stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
}
