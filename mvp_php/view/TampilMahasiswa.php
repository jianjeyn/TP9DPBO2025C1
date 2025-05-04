<?php

/******************************************
 Asisten Pemrogaman 13 & 14
******************************************/

include("KontrakView.php");
include("presenter/ProsesMahasiswa.php");

class TampilMahasiswa implements KontrakView
{
	private $prosesmahasiswa; // Presenter yang dapat berinteraksi langsung dengan view
	private $tpl;

	function __construct()
	{
		//konstruktor
		$this->prosesmahasiswa = new ProsesMahasiswa();
	}

	function tampil()
	{
		$data = null;
		$action = isset($_GET['action']) ? $_GET['action'] : "";

		// Handle actions based on parameters
		switch ($action) {
			case 'add':
				// Tampilkan form tambah data
				$this->tpl = new Template("templates/form_add.html");
				$this->tpl->write();
				break;
				
			case 'add_submit':
				// Proses tambah data
				if ($_SERVER['REQUEST_METHOD'] == 'POST') {
					$nim = $_POST['nim'];
					$nama = $_POST['nama'];
					$tempat = $_POST['tempat'];
					$tl = $_POST['tl'];
					$gender = $_POST['gender'];
					$email = $_POST['email'];
					$telp = $_POST['telp'];

					$this->prosesmahasiswa->prosesAddMahasiswa($nim, $nama, $tempat, $tl, $gender, $email, $telp);
					header("Location: index.php");
				}
				break;
				
			case 'update':
				// Tampilkan form edit data
				if (isset($_GET['id'])) {
					$id = $_GET['id'];
					$this->prosesmahasiswa->prosesDataMahasiswaById($id);
					
					if ($this->prosesmahasiswa->getSize() > 0) {
						$this->tpl = new Template("templates/form_update.html");
						$this->tpl->replace("DATA_ID", $this->prosesmahasiswa->getId(0));
						$this->tpl->replace("DATA_NIM", $this->prosesmahasiswa->getNim(0));
						$this->tpl->replace("DATA_NAMA", $this->prosesmahasiswa->getNama(0));
						$this->tpl->replace("DATA_TEMPAT", $this->prosesmahasiswa->getTempat(0));
						$this->tpl->replace("DATA_TL", $this->prosesmahasiswa->getTl(0));
						
						// Set the selected gender options
						$selectedLaki = ($this->prosesmahasiswa->getGender(0) == "Laki-laki") ? "selected" : "";
						$selectedPerempuan = ($this->prosesmahasiswa->getGender(0) == "Perempuan") ? "selected" : "";
						$this->tpl->replace("DATA_SELECTED_LAKI", $selectedLaki);
						$this->tpl->replace("DATA_SELECTED_PEREMPUAN", $selectedPerempuan);
						
						$this->tpl->replace("DATA_EMAIL", $this->prosesmahasiswa->getEmail(0));
						$this->tpl->replace("DATA_TELP", $this->prosesmahasiswa->getTelp(0));
						$this->tpl->write();
					} else {
						header("Location: index.php");
					}
				}
				break;
				
			case 'update_submit':
				// Proses update data
				if ($_SERVER['REQUEST_METHOD'] == 'POST') {
					$id = $_POST['id'];
					$nim = $_POST['nim'];
					$nama = $_POST['nama'];
					$tempat = $_POST['tempat'];
					$tl = $_POST['tl'];
					$gender = $_POST['gender'];
					$email = $_POST['email'];
					$telp = $_POST['telp'];

					$this->prosesmahasiswa->prosesUpdateMahasiswa($id, $nim, $nama, $tempat, $tl, $gender, $email, $telp);
					header("Location: index.php");
				}
				break;
				
			case 'delete':
				// Proses delete data
				if (isset($_GET['id'])) {
					$id = $_GET['id'];
					$this->prosesmahasiswa->prosesDeleteMahasiswa($id);
					header("Location: index.php");
				}
				break;
				
			default:
				// Tampilkan data mahasiswa dalam tabel
				$this->prosesmahasiswa->prosesDataMahasiswa();
				$data = null;

				//semua terkait tampilan adalah tanggung jawab view
				for ($i = 0; $i < $this->prosesmahasiswa->getSize(); $i++) {
					$no = $i + 1;
					$data .= "<tr>
					<td>" . $no . "</td>
					<td>" . $this->prosesmahasiswa->getNim($i) . "</td>
					<td>" . $this->prosesmahasiswa->getNama($i) . "</td>
					<td>" . $this->prosesmahasiswa->getTempat($i) . "</td>
					<td>" . $this->prosesmahasiswa->getTl($i) . "</td>
					<td>" . $this->prosesmahasiswa->getGender($i) . "</td>
					<td>" . $this->prosesmahasiswa->getEmail($i) . "</td>
					<td>" . $this->prosesmahasiswa->getTelp($i) . "</td>
					<td>
						<a href='index.php?action=update&id=" . $this->prosesmahasiswa->getId($i) . "' class='btn btn-warning btn-sm'>Edit</a>
						<a href='index.php?action=delete&id=" . $this->prosesmahasiswa->getId($i) . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Hapus</a>
					</td>
					</tr>";
				}
				
				// Membaca template skin.html
				$this->tpl = new Template("templates/skin.html");

				// Mengganti kode Data_Tabel dengan data yang sudah diproses
				$this->tpl->replace("DATA_TABEL", $data);

				// Menampilkan ke layar
				$this->tpl->write();
		}
	}
}