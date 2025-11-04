<?php 

// Memasukkan file konfigurasi database
include_once 'db-config.php';

class roti extends Database {

    // Method untuk input data roti
    public function inputroti($data){
        $kode     = $data['kode'];
        $nama     = $data['nama'];
        $toping   = $data['toping'];
        $jumlah   = $data['jumlah'];
        $alamat   = $data['alamat'];
        $provinsi = $data['provinsi'];
        $email    = $data['email'];
        $telp     = $data['telp'];
        $status   = $data['status'];

        // ✅ FIX untuk input agar tidak error
        if($jumlah === '' || $jumlah === null){ $jumlah = 0; }
        if($provinsi === '' || $provinsi === null){ $provinsi = 0; }
        if($status === '' || $status === null){ $status = 0; }

        $query = "INSERT INTO tb_roti (kode_roti, nama_roti, toping_roti, jumlah, alamat, provinsi, email, telp, status_roti) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }

        $stmt->bind_param("sssssssss", $kode, $nama, $toping, $jumlah, $alamat, $provinsi, $email, $telp, $status);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    // Method untuk mengambil semua data roti
    public function getAllroti(){
        $query = "SELECT id_roti, kode_roti, nama_roti, toping_roti, jumlah, nama_provinsi, alamat, email, telp, status_roti 
                  FROM tb_roti
                  JOIN tb_toping ON toping_roti = kode_toping
                  JOIN tb_provinsi ON provinsi = id_provinsi";
        $result = $this->conn->query($query);
        $roti = [];

        if($result && $result->num_rows > 0){
            while($row = $result->fetch_assoc()) {
                $roti[] = [
                    'id' => $row['id_roti'],
                    'kode' => $row['kode_roti'],
                    'nama' => $row['nama_roti'],
                    'toping' => $row['toping_roti'],
                    'jumlah' => $row['jumlah'],
                    'provinsi' => $row['nama_provinsi'],
                    'alamat' => $row['alamat'],
                    'email' => $row['email'],
                    'telp' => $row['telp'],
                    'status' => $row['status_roti']
                ];
            }
        }

        return $roti;
    }

    // Method untuk mengambil data roti berdasarkan ID
    public function getUpdateroti($id){
        $query = "SELECT * FROM tb_roti WHERE id_roti = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = false;

        if($result && $result->num_rows > 0){
            $row = $result->fetch_assoc();
            $data = [
                'id' => $row['id_roti'],
                'kode' => $row['kode_roti'],
                'nama' => $row['nama_roti'],
                'toping' => $row['toping_roti'],
                'jumlah' => $row['jumlah'],
                'alamat' => $row['alamat'],
                'provinsi' => $row['provinsi'],
                'email' => $row['email'],
                'telp' => $row['telp'],
                'status' => $row['status_roti']
            ];
        }

        $stmt->close();
        return $data;
    }

    // Method untuk mengedit data roti
    public function editroti($data){
        $id       = $data['id'];
        $kode     = $data['kode'];
        $nama     = $data['nama'];
        $toping   = $data['toping'];
        $jumlah   = $data['jumlah'];
        $alamat   = $data['alamat'];
        $provinsi = $data['provinsi'];
        $email    = $data['email'];
        $telp     = $data['telp'];
        $status   = $data['status'];

        // ✅ FIX untuk cegah error integer kosong saat edit
        if($jumlah === '' || $jumlah === null){ $jumlah = 0; }
        if($provinsi === '' || $provinsi === null){ $provinsi = 0; }
        if($status === '' || $status === null){ $status = 0; }

        $query = "UPDATE tb_roti SET kode_roti = ?, nama_roti = ?, toping_roti = ?, jumlah = ?, alamat = ?, provinsi = ?, email = ?, telp = ?, status_roti = ? 
                  WHERE id_roti = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }

        $stmt->bind_param("ssssssssss", $kode, $nama, $toping, $jumlah, $alamat, $provinsi, $email, $telp, $status, $id);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    // Method untuk menghapus data roti
    public function deleteroti($id){
        $query = "DELETE FROM tb_roti WHERE id_roti = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }

        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    // Method untuk mencari data roti berdasarkan kata kunci
    public function searchroti($kataKunci){
        $likeQuery = "%".$kataKunci."%";
        $query = "SELECT id_roti, kode_roti, nama_roti, toping_roti, jumlah, nama_provinsi, alamat, email, telp, status_roti
                  FROM tb_roti
                  JOIN tb_toping ON toping_roti = kode_toping
                  JOIN tb_provinsi ON provinsi = id_provinsi
                  WHERE kode_roti LIKE ? OR nama_roti LIKE ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return [];
        }

        $stmt->bind_param("ss", $likeQuery, $likeQuery);
        $stmt->execute();
        $result = $stmt->get_result();
        $roti = [];

        if($result && $result->num_rows > 0){
            while($row = $result->fetch_assoc()) {
                $roti[] = [
                    'id' => $row['id_roti'],
                    'kode' => $row['kode_roti'],
                    'nama' => $row['nama_roti'],
                    'toping' => $row['toping_roti'],
                    'jumlah' => $row['jumlah'],
                    'provinsi' => $row['nama_provinsi'],
                    'alamat' => $row['alamat'],
                    'email' => $row['email'],
                    'telp' => $row['telp'],
                    'status' => $row['status_roti']
                ];
            }
        }

        $stmt->close();
        return $roti;
    }

}
?>
