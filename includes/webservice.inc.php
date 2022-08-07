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
		// request ke link
        $query = "SELECT COUNT(A.aspirasi) AS jml_aspirasi, B.nama AS nama_kategori 
		FROM aspirasi A 
		LEFT JOIN kategori B ON A.id_kategori=B.id_kategori 
		WHERE A.status = 'Selesai'
		GROUP BY B.nama";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		// proses merubah data query menjadi json
		$i=0;
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			$laporan[$i]['jumlah_aspirasi'] = $row['jml_aspirasi'];
			$laporan[$i]['nama_kategori'] = $row['nama_kategori'];
			$i++;
		}
        $data = [
            'status' => 'ok',
            'code'  => '200',
            'data'  => $laporan
        ];
		// menampilkan data berupa json kedalam link
		return json_encode($data);
    }

    function LaporanPerangkatan() {
		// request ke link
		$query = "SELECT COUNT(A.aspirasi) AS jml_aspirasi, SUBSTR(B.nim,1,2) AS angkatan 
		FROM aspirasi A 
		LEFT JOIN mahasiswa B ON A.id_mahasiswa=B.id_mahasiswa 
		LEFT JOIN kategori C ON A.id_kategori=C.id_kategori 
		WHERE A.status = 'Selesai'
		GROUP BY SUBSTR(B.nim,1,2)";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		// proses merubah data query menjadi json
		$i = 0;
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			$laporan[$i]['jml_aspirasi'] = $row['jml_aspirasi'];
			$laporan[$i]['angkatan'] = $row['angkatan'];
			$i++;
		}
        $data = [
            'status' => 'ok',
            'code'  => '200',
            'data'  => $laporan
        ];
		// menampilkan data berupa json kedalam link
		return json_encode($data);
	}

    function readAllSelesai() {
		// request ke link
		$query = "SELECT A.id_aspirasi, B.nama AS nama_mahasiswa, A.aspirasi, C.nama AS nama_kategori, C.bidang, A.status, D.advokasi  
		FROM {$this->table_aspirasi} A 
		LEFT JOIN {$this->table_mahasiswa} B ON A.id_mahasiswa=B.id_mahasiswa 
		LEFT JOIN {$this->table_kategori} C ON A.id_kategori=C.id_kategori 
		LEFT JOIN {$this->table_advokasi} D ON A.id_aspirasi=D.id_aspirasi 
		WHERE A.status = 'Selesai'
		ORDER BY id_aspirasi ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		// proses merubah data query menjadi json
		$i = 0;
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			$response[$i]['id_aspirasi'] = $row['id_aspirasi'];
			$response[$i]['nama_mahasiswa'] = $row['nama_mahasiswa'];
			$response[$i]['aspirasi'] = $row['aspirasi'];
			$response[$i]['advokasi'] = $row['advokasi'];
			$response[$i]['nama_kategori'] = $row['nama_kategori'];
			$response[$i]['bidang'] = $row['bidang'];
			$response[$i]['status'] = $row['status'];
			$i++;
		}
        $data = [
            'status' => 'ok',
            'code'  => '200',
            'data'  => $response
        ];
		// menampilkan data berupa json kedalam link
		return json_encode($data);
	}
}