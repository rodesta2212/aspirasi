<?php
class Advokasi {
	private $conn;
    private $table_advokasi = 'advokasi';
    private $table_aspirasi = 'aspirasi';

    public $id_advokasi;
    public $advokasi;
    public $id_aspirasi;
    public $file;

	public function __construct($db) {
		$this->conn = $db;
	}

	function insert() {
		$query = "INSERT INTO {$this->table_advokasi} VALUES(?, ?, ?, ?)";

		$stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_advokasi);
        $stmt->bindParam(2, $this->advokasi);
        $stmt->bindParam(3, $this->id_aspirasi);
        $stmt->bindParam(4, $this->file);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
	
	function getNewID() {
		$query = "SELECT MAX(id_advokasi) AS code FROM {$this->table_advokasi}";
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
		$query = "SELECT A.id_advokasi, B.nama AS nama_mahasiswa, A.advokasi, C.nama AS nama_kategori, C.bidang, A.file 
		FROM {$this->table_advokasi} A 
		LEFT JOIN {$this->table_aspirasi} B ON A.id_mahasiswa=B.id_mahasiswa 
		LEFT JOIN {$this->table_kategori} C ON A.id_aspirasi=C.id_aspirasi 
		ORDER BY id_advokasi ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function readAllMahasiswa() {
		$query = "SELECT A.id_advokasi, B.nama AS nama_mahasiswa, A.advokasi, C.nama AS nama_kategori, C.bidang, A.file 
		FROM {$this->table_advokasi} A 
		LEFT JOIN {$this->table_aspirasi} B ON A.id_mahasiswa=B.id_mahasiswa 
		LEFT JOIN {$this->table_kategori} C ON A.id_aspirasi=C.id_aspirasi 
		WHERE A.id_mahasiswa=:id_mahasiswa
		ORDER BY id_advokasi ASC";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id_mahasiswa', $this->id_mahasiswa);
		$stmt->execute();

		return $stmt;
	}

	function readOne() {
		$query = "SELECT A.id_advokasi, A.id_mahasiswa, B.nama AS nama_mahasiswa, B.nim, B.jurusan, B.jenis_kelamin, A.advokasi, A.id_aspirasi, C.nama AS nama_kategori, C.bidang, A.file 
		FROM {$this->table_advokasi} A 
		LEFT JOIN {$this->table_aspirasi} B ON A.id_mahasiswa=B.id_mahasiswa 
		LEFT JOIN {$this->table_kategori} C ON A.id_aspirasi=C.id_aspirasi 
		WHERE id_advokasi=:id_advokasi LIMIT 0,1";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id_advokasi', $this->id_advokasi);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->id_advokasi = $row['id_advokasi'];
		$this->id_mahasiswa = $row['id_mahasiswa'];
		$this->nama_mahasiswa = $row['nama_mahasiswa'];
		$this->nim = $row['nim'];
		$this->jurusan = $row['jurusan'];
		$this->jenis_kelamin = $row['jenis_kelamin'];
        $this->advokasi = $row['advokasi'];
        $this->id_aspirasi = $row['id_aspirasi'];
		$this->nama_kategori = $row['nama_kategori'];
		$this->bidang = $row['bidang'];
        $this->file = $row['file'];
	}

	function update() {
		$query = "UPDATE {$this->table_advokasi}
			SET
                id_advokasi = :id_advokasi,
				id_mahasiswa = :id_mahasiswa,
                advokasi = :advokasi,
                id_aspirasi = :id_aspirasi,
				file = :file
			WHERE
				id_advokasi = :id";
        $stmt = $this->conn->prepare($query);

		$stmt->bindParam(':id_advokasi', $this->id_advokasi);
		$stmt->bindParam(':id_mahasiswa', $this->id_mahasiswa);
        $stmt->bindParam(':advokasi', $this->advokasi);
        $stmt->bindParam(':id_aspirasi', $this->id_aspirasi);
        $stmt->bindParam(':file', $this->file);
        $stmt->bindParam(':id', $this->id_advokasi);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
	
	function delete() {
		$query = "DELETE FROM {$this->table_advokasi} WHERE id_advokasi = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id_advokasi);
		if ($result = $stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
}
