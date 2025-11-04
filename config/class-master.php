<?php

// Memasukkan file konfigurasi database
include_once 'db-config.php';

class MasterData extends Database {

    // Method untuk mendapatkan daftar program studi
    public function gettoping(){
        $query = "SELECT * FROM tb_toping";
        $result = $this->conn->query($query);
        $prodi = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $prodi[] = [
                    'id' => $row['kode_toping'],
                    'nama' => $row['nama_toping']
                ];
            }
        }
        return $prodi;
    }

    // Method untuk mendapatkan daftar provinsi
    public function getProvinsi(){
        $query = "SELECT * FROM tb_provinsi";
        $result = $this->conn->query($query);
        $provinsi = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $provinsi[] = [
                    'id' => $row['id_provinsi'],
                    'nama' => $row['nama_provinsi']
                ];
            }
        }
        return $provinsi;
    }

    // Method untuk mendapatkan daftar status mahasiswa menggunakan array statis
    public function getStatus(){
        return [
            ['id' => 1, 'nama' => 'PROSES'],
            ['id' => 2, 'nama' => 'DIKIRIM'],
            ['id' => 3, 'nama' => 'DIANTAR'],
            ['id' => 4, 'nama' => 'TELAH DITERIMA']
        ];
    }

    // ✅ Method untuk input data toping (sudah dicegah duplicate)
    public function inputtoping($data){
        $kodetoping = $data['kode'];
        $namatoping = $data['nama'];

        // Cek apakah kode sudah ada
        $cek = $this->conn->prepare("SELECT kode_toping FROM tb_toping WHERE kode_toping = ?");
        $cek->bind_param("s", $kodetoping);
        $cek->execute();
        $hasil = $cek->get_result();

        if($hasil->num_rows > 0){
            return "duplicate"; // kode sudah ada → hentikan
        }

        $query = "INSERT INTO tb_toping (kode_toping, nama_toping) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("ss", $kodetoping, $namatoping);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk mendapatkan data toping berdasarkan kode
    public function getUpdatetoping($kode){
        $query = "SELECT * FROM tb_toping WHERE kode_toping = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("s", $kode);
        $stmt->execute();
        $result = $stmt->get_result();
        $prodi = null;
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $prodi = [
                'id' => $row['kode_toping'],
                'nama' => $row['nama_toping']
            ];
        }
        $stmt->close();
        return $prodi;
    }

    // Method untuk mengedit data toping
    public function updatetoping($data){
        $kodetoping = $data['kode'];
        $namatoping = $data['nama'];
        $query = "UPDATE tb_toping SET nama_toping = ? WHERE kode_toping = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("ss", $namatoping, $kodetoping);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk menghapus data toping
    public function deletetoping($kode){
        $query = "DELETE FROM tb_toping WHERE kode_toping = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("s", $kode);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method input provinsi
    public function inputProvinsi($data){
        $namaProvinsi = $data['nama'];
        $query = "INSERT INTO tb_provinsi (nama_provinsi) VALUES (?)";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("s", $namaProvinsi);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method dapat provinsi berdasarkan id
    public function getUpdateProvinsi($id){
        $query = "SELECT * FROM tb_provinsi WHERE id_provinsi = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $provinsi = null;
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $provinsi = [
                'id' => $row['id_provinsi'],
                'nama' => $row['nama_provinsi']
            ];
        }
        $stmt->close();
        return $provinsi;
    }

    // Update provinsi
    public function updateProvinsi($data){
        $idProvinsi = $data['id'];
        $namaProvinsi = $data['nama'];
        $query = "UPDATE tb_provinsi SET nama_provinsi = ? WHERE id_provinsi = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("si", $namaProvinsi, $idProvinsi);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Hapus provinsi
    public function deleteProvinsi($id){
        $query = "DELETE FROM tb_provinsi WHERE id_provinsi = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

}

?>
