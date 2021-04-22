<?php

include("conf.php");
include("includes/Template.class.php");
include("includes/DB.class.php");
include("includes/DataMhs.class.php");

// Membuat objek dari kelas data
$odata = new DataMhs($db_host, $db_user, $db_password, $db_name);
$odata->open();

$odata->getData();
$data = null;
$no = 1;

while (list($id, $tnim, $tnama, $tjk, $tprodi, $tjenjang, $tjumlah, $tstatus) = $odata->getResult()) {
	// Tampilan jika status pembayaran nya sudah bayar
    if($tstatus == "Sudah"){
        $data .= "<tr>
        <td style='text-align: center;'>" . $no . "</td>
        <td>" . $tnim . "</td>
        <td>" . $tnama . "</td>
        <td>" . $tjk . "</td>
        <td>" . $tprodi . "</td>
        <td>" . $tjenjang . "</td>
        <td>" . $tjumlah . "</td>
        <td>" . $tstatus . "</td>
        <td align='center'><button class='btn btn-danger'><a href='index.php?id_hapus=" . $id . "' style='color: white; text-decoration: none;'>Hapus</a></button></td>
        <td align='center'><button class='btn btn-outline-warning' disabled><a style='color: black; text-decoration: none;'>Sudah Bayar</a></button></td>
        </tr>";
        $no++;
	}else{//Tampilan jika status pembayaran nya belum bayar
		$data .= "<tr>
        <td style='text-align: center;'>" . $no . "</td>
        <td>" . $tnim . "</td>
        <td>" . $tnama . "</td>
        <td>" . $tjk . "</td>
        <td>" . $tprodi . "</td>
        <td>" . $tjenjang . "</td>
        <td>" . $tjumlah . "</td>
        <td>" . $tstatus . "</td>
        <td align='center'><button class='btn btn-danger'><a href='index.php?id_hapus=" . $id . "' style='color: white; text-decoration: none;'>Hapus</a></button></td>
        <td align='center'><button class='btn btn-warning'><a href='index.php?id_edit=" . $id . "' style='color: black; text-decoration: none;'>Sudah Bayar</a></button></td>
        </tr>";
        $no++;
	}
}

//menghapus data pada tabel
if(isset($_GET['id_hapus'])){
	$id_data = $_GET['id_hapus'];

	$odata->deleteData($id_data);

	unset($_GET['id_hapus']);

	header("Location: index.php");
}

//menambah data baru pada tabel
if(isset($_POST['add'])){
	$odata->insertData($_POST);

	header("Location:index.php");
}

//mengupdate data
if(isset($_GET['id_edit'])){
	$id_edit = $_GET['id_edit'];

	$odata->updateData($id_edit);

	unset($_GET['id_edit']);
	
	header("Location: index.php");
}


//Menutup koneksi database
$odata->close();

//Membaca template skin.html
$tpl = new Template("templates/skin.html");

//Mengganti kode Data_Tabel dengan data yang sudah diproses
$tpl->replace("DATA_TABEL", $data);

//Menampilkan ke layar
$tpl->write();