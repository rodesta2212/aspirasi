<?php
class Webservice {
    private $conn;
    private $table_aspirasi = 'aspirasi';
    private $table_mahasiswa = 'mahasiswa';
	private $table_kategori = 'kategori';
	private $table_advokasi = 'advokasi';

    public function __construct($db) {
		$this->conn = $db;
	}

    function LaporanPerkategori() {
        $query = "SELECT COUNT(A.aspirasi) AS jml_aspirasi, B.nama AS nama_kategori 
		FROM aspirasi A 
		LEFT JOIN kategori B ON A.id_kategori=B.id_kategori 
		WHERE A.status = 'Selesai'
		GROUP BY B.nama";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $data = [
            'status' => 'ok',
            'code'  => '200',
            'data'  => $row
        ];
		return json_encode($data);
    }

    function LaporanPerangkatan() {
		$query = "SELECT COUNT(A.aspirasi) AS jml_aspirasi, SUBSTR(B.nim,1,2) AS angkatan 
		FROM aspirasi A 
		LEFT JOIN mahasiswa B ON A.id_mahasiswa=B.id_mahasiswa 
		LEFT JOIN kategori C ON A.id_kategori=C.id_kategori 
		WHERE A.status = 'Selesai'
		GROUP BY SUBSTR(B.nim,1,2)";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $data = [
            'status' => 'ok',
            'code'  => '200',
            'data'  => $row
        ];
		return json_encode($data);
	}

    function readAllSelesai() {
		$query = "SELECT A.id_aspirasi, B.nama AS nama_mahasiswa, A.aspirasi, C.nama AS nama_kategori, C.bidang, A.status 
		FROM {$this->table_aspirasi} A 
		LEFT JOIN {$this->table_mahasiswa} B ON A.id_mahasiswa=B.id_mahasiswa 
		LEFT JOIN {$this->table_kategori} C ON A.id_kategori=C.id_kategori 
		WHERE A.status = 'Selesai'
		ORDER BY id_aspirasi ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $data = [
            'status' => 'ok',
            'code'  => '200',
            'data'  => $row
        ];
		return json_encode($data);
	}
}