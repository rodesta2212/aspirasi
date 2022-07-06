<?php
class Kategori {
	private $conn;
    private $table_kategori = 'kategori';

    public $id_kategori;
    public $nama;
    public $bidang;

	public function __construct($db) {
		$this->conn = $db;
	}

	function insert() {
		$query = "INSERT INTO {$this->table_kategori} VALUES(?, ?, ?)";

		$stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_kategori);
        $stmt->bindParam(2, $this->nama);
        $stmt->bindParam(3, $this->bidang);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
	
	function getNewID() {
		$query = "SELECT MAX(id_kategori) AS code FROM {$this->table_kategori}";
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
		$query = "SELECT id_kategori, nama, bidang FROM {$this->table_kategori} ORDER BY id_kategori ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function readOne() {
		$query = "SELECT * FROM {$this->table_kategori} WHERE id_kategori=:id_kategori LIMIT 0,1";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id_kategori', $this->id_kategori);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->id_kategori = $row['id_kategori'];
		$this->nama = $row['nama'];
        $this->bidang = $row['bidang'];
	}

	function update() {
		$query = "UPDATE {$this->table_kategori}
			SET
                id_kategori = :id_kategori,
				nama = :nama,
                bidang = :bidang
			WHERE
				id_kategori = :id";
        $stmt = $this->conn->prepare($query);

		$stmt->bindParam(':id_kategori', $this->id_kategori);
		$stmt->bindParam(':nama', $this->nama);
        $stmt->bindParam(':bidang', $this->bidang);
        $stmt->bindParam(':id', $this->id_kategori);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
	
	function delete() {
		$query = "DELETE FROM {$this->table_kategori} WHERE id_kategori = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id_kategori);
		if ($result = $stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
}
