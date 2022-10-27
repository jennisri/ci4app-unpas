<?php

namespace App\Controllers;

class Pages extends BaseController
{
	public function index()
	{

		// $faker = \Faker\Factory::create();
		// dd($faker->address);

		// pakai array
		$data = [
			'title' => 'Home | WebProgramming'
		];
		return view('pages/home', $data);
	}

	public function about()
	{
		// pakai array
		$data = [
			'title' => 'About | WebProgramming',
			'tes' => ['satu', 'dua', 'tiga']
		];
		return view('pages/about', $data);
	}

	public function contact()
	{
		$data = [
			'title' => 'Halaman Contact',
			'alamat' => [
				[
					'tipe' => 'Rumah',
					'jalan' => 'Jalan Kasmaran Kecamatan Babat Toman',
					'kota' => 'Kab. Musi Banyuasin'
				],
				[
					'tipe' => 'Hotel',
					'jalan' => 'Lubuk Linggau',
					'kota' => 'Kab. Musi Rawas'
				]
			]
		];

		return view('pages/contact', $data);
	}

}
