<?php

namespace App\Models;

use CodeIgniter\Model;

class Komikmodel extends Model
{
	protected $table      = 'komik';
	protected $returnType     = 'array';
	protected $useTimestamps = true;
	protected $allowedFields = ['judul', 'slug', 'penulis', 'penerbit', 'sampul'];
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';

	// kalau ada parameternya, cari pake yang where. jadi kalau tidak ada tampilkan semua data komik
	// false berarti tidak ada
	public function getKomik($slug = false)
	{
		if($slug == false){
			return $this->findAll();
		}

		return $this->where(['slug' => $slug])->first();
	}
}