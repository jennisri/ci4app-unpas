<?php

namespace App\Controllers;

use App\Models\Orangmodel;

class Orang extends BaseController
{

	// tambah property
	protected $orangModel;

	public function __construct()
	{
		// lalu property tersebut diisi dengan models komikmodel 
		$this->orangModel = new Orangmodel();
	}

	public function index()
	{

		// ambil data dari url
		$currentPage = $this->request->getVar('page_orang') ? $this->request->getVar('page_orang') : 1;
		
		$keyword = $this->request->getVar('keyword');

		if($keyword){
			$orang = $this->orangModel->search($keyword);
		}else{
			$orang = $this->orangModel;
		}

		$data = [
			'title' => 'Daftar Orang',
			// 'orang' => $this->orangModel->findAll()
			'orang' => $orang->paginate(6, 'orang'),
			'pager' => $this->orangModel->pager,
			'currentPage' => $currentPage
		];

		// // cara connect db tanpa model
		// $db = \Config\Database::connect();
		// $komik = $db->query("SELECT * FROM komik");
		// foreach($komik->getResultArray() as $row){
		// 	dd($row);
		// }

		// untuk menampilkan seluruh data
		return view('orang/index', $data);
	}

}
