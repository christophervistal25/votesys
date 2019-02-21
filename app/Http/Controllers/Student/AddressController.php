<?php

namespace App\Http\Controllers\Student;
use App\Http\Controllers\Controller;
use App\RegisteredAddress;
use Illuminate\Http\Request;

class AddressController extends Controller
{


	public function check(Request $request)
	{
		$is_already_register = !is_null(RegisteredAddress::find($request->mac_address));
		$responseCode = ($is_already_register) ? 422 : 200;
		return response()->json(['registered' => $is_already_register],$responseCode);
	}
}
