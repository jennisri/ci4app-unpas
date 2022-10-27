<?php

namespace App\Models;

use CodeIgniter\Model;

class Orangmodel extends Model
{
	protected $table      = 'orang';
	protected $returnType     = 'array';
	protected $useTimestamps = true;
	protected $allowedFields = ['nama', 'alamat'];
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';

	public function search($keyword)
	{
		// $builder = $this->table('orang');
		// $builder->like('nama', $keyword);
		// return $builder;

		return $this->table('orang')->like('nama', $keyword)->orLike('alamat', $keyword);

	}
}