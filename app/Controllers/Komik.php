<?php

namespace App\Controllers;

use App\Models\Komikmodel;

class Komik extends BaseController
{

	// tambah property
	protected $komikModel;

	public function __construct()
	{
		// lalu property tersebut diisi dengan models komikmodel 
		$this->komikModel = new Komikmodel();
	}

	public function index()
	{
		// $komik = $this->komikModel->findAll();
		
		$data = [
			'title' => 'Daftar Komik',
			'komik' => $this->komikModel->getKomik()
		];

		// // cara connect db tanpa model
		// $db = \Config\Database::connect();
		// $komik = $db->query("SELECT * FROM komik");
		// foreach($komik->getResultArray() as $row){
		// 	dd($row);
		// }

		// untuk menampilkan seluruh data
		return view('komik/index', $data);
	}

	// method baru yang menerima slug
	public function detail($slug)
	{
		// ambil model komik kemudian panggil method where nya slug yang isinya slug
		// dan ambil data pertamanya dengan first
		$data = [
			'title' => 'Detail Komik',
			'komik' => $this->komikModel->getKomik($slug)
		];

		// jika komik tidak ada di tabel
		if(empty($data['komik'])){
			throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul Komik' . $slug . 'tidak ditemukan.');
		}

		return view('komik/detail', $data);
	}

	public function create()
	{
		// session();

		$data = [
			'title' => 'Form Tambah Data Komik',
			'validation' => \Config\Services::validation()
		];

		return view('komik/create', $data);
	}

	public function save()
	{

		// validasi input
		if(!$this->validate([
			// buat  rus, 
			// 'judul' => 'required|is_unique[komik.judul]'
			'judul' => [
				'rules' => 'required|is_unique[komik.judul]',
				'errors' => [
					'required' => '{field} Komik harus diisi',
					'is_unique' => '{field} Komik sudah ada'
				]
			],

			'sampul' => [
				'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
				'errors' => [
					// 'uploaded' => 'Pilih gambar sampul terlebih dahulu',
					'max_size' => 'Ukuran gambar terlalu besar',
					'is_image' => 'Yang dipilih bukan gambar',
					'mime_in' => 'Yang dipilih bukan gambar'
				]
			]
		])){
			// ngambil pesan kesalahan
			// $validation = \Config\Services::validation();
			// return redirect()->to('/komik/create')->withInput()->with('validation', $validation);
			return redirect()->to('/komik/create')->withInput();
		}

		// ambil gambar
		$fileSampul = $this->request->getFile('sampul');


		// apakah tidak ada gambar yang diupload
		if($fileSampul->getError() == 4){
			$namaSampul = 'default.png';
		}else{

		// generate nama sampul
			$namaSampul = $fileSampul->getRandomName();
		// pindahkan file ke folder img
			$fileSampul->move('img', $namaSampul);
		}



		// ambil nama file
		// $namaSampul = $fileSampul->getName();


		$slug = url_title($this->request->getVar('judul'), '-', true);
		$this->komikModel->save([
			'judul' => $this->request->getVar('judul'),
			'slug' => $slug,
			'penulis' => $this->request->getVar('penulis'),
			'penerbit' => $this->request->getVar('penerbit'),
			'sampul' => $namaSampul
		]);

		session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan');

		return redirect()->to('/komik');
	}

	public function delete($id)
	{

		// cari gambar berdasarkan id
		$komik = $this->komikModel->find($id);

		// cek jika file gambarnya default.png
		if($komik['sampul'] != 'default.png'){
		// hapus gambar
			unlink('img/'. $komik['sampul']);

		}



		$this->komikModel->delete($id);
		session()->setFlashdata('pesan', 'Data Berhasil Dihapus');
		return redirect()->to('/komik');
	}

	public function edit($slug)
	{
		$data = [
			'title' => 'Form Ubah Data Komik',
			'validation' => \Config\Services::validation(),
			'komik' => $this->komikModel->getKomik($slug)
		];

		return view('komik/edit', $data);
	}

	public function update($id)
	{
		// cek judul
		$komikLama = $this->komikModel->getKomik($this->request->getVar('slug'));
		if($komikLama['judul'] == $this->request->getVar('judul')){
			$rule_judul = 'required';
		}else{
			$rule_judul= 'required|is_unique[komik.judul]';
		}

		// validasi input
		if(!$this->validate([
			// buat  rus, 
			// 'judul' => 'required|is_unique[komik.judul]'
			'judul' => [
				'rules' => $rule_judul,
				'errors' => [
					'required' => '{field} Komik harus diisi',
					'is_unique' => '{field} Komik sudah ada'
				]
			],
			'sampul' => [
				'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
				'errors' => [
					// 'uploaded' => 'Pilih gambar sampul terlebih dahulu',
					'max_size' => 'Ukuran gambar terlalu besar',
					'is_image' => 'Yang dipilih bukan gambar',
					'mime_in' => 'Yang dipilih bukan gambar'
				]
			]
		])){
			// ngambil pesan kesalahan
			// $validation = \Config\Services::validation();
			return redirect()->to('/komik/edit/'.$this->request->getVar('slug'))->withInput();
		}

		$fileSampul = $this->request->getFile('sampul');

		// cek gambar, apakah tetap gambar lama
		if($fileSampul->getError() == 4){
			$namaSampul = $this->request->getVar('sampulLama');
		}else{
			// generate nama sampul
			$namaSampul = $fileSampul->getRandomName();
		// pindahkan file ke folder img
			$fileSampul->move('img', $namaSampul);
			// hapus file lama
			unlink('img/' . $this->request->getVar('sampulLama'));

		}


		$slug = url_title($this->request->getVar('judul'), '-', true);
		$this->komikModel->save([
			'id'	=> $id,
			'judul' => $this->request->getVar('judul'),
			'slug' => $slug,
			'penulis' => $this->request->getVar('penulis'),
			'penerbit' => $this->request->getVar('penerbit'),
			'sampul' => $namaSampul
		]);

		session()->setFlashdata('pesan', 'Data Berhasil Diubah');

		return redirect()->to('/komik');
	}



}
