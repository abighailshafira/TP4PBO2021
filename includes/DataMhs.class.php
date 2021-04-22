<?php 

class DataMhs extends DB{
	
	//method untuk mengambil data
	function getData(){
		//query mysql select data ke tb_mahasiswa
		$query = "SELECT * FROM tb_mahasiswa";

		// Mengeksekusi query
		return $this->execute($query);
	}

    function deleteData($id_data){
    	//query mysql delete data ke tb_mahasiswa
		$query = "DELETE FROM tb_mahasiswa WHERE id=$id_data";

		//mengeksekusi query
		return $this->execute($query);
	}

    function insertData($data){
		$tnim = $data['tnim'];
		$tnama = $data['tnama'];
		$tjk = $data['tjk'];
		$tprodi = $data['tprodi'];
		$tjenjang = $data['tjenjang'];
        $tjumlah = $data['tjumlah'];
        $tstatus = "Belum";

        //query mysql insert data ke tb_mahasiswa
		$query = "INSERT INTO tb_mahasiswa (nim, nama, jenis_kelamin, program_studi, jenjang, jumlah, status_bayar) VALUES ('$tnim', '$tnama', '$tjk', '$tprodi', '$tjenjang', '$tjumlah', '$tstatus')";

		//mengeksekusi query
		return $this->execute($query);
	}

	function updateData($id){
		//query mysql update data ke tb_mahasiswa
        $query = "UPDATE tb_mahasiswa SET status_bayar='Sudah' WHERE id = $id";
        //mengeksekusi query
		return $this->execute($query);   
	}
	
}



?>
