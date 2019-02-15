<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Position;




class PositionController extends Controller
{
	public function create()
	{
		return view('admin.position.create');
	}

	public function store()
	{

	}

}
