<?php

namespace App\Http\Controllers\Student;
use App\Http\Controllers\Controller;
use App\RegisteredAddress;
use App\Repositories\RegisterAddressRepository;
use Illuminate\Http\Request;

class AddressController extends Controller
{

	public function __construct(RegisterAddressRepository $registerAddressRepository)
	{
		$this->registerAddressRepository = $registerAddressRepository;
	}

	public function check(Request $request)
	{
		$isMacAddressAlreadyRegistered = $this->registerAddressRepository
											  ->studentCheckMacAddress($request->mac_address);
		$responseCode = ($isMacAddressAlreadyRegistered) ? 422 : 200;
		return response()->json(['registered' => $is_already_register],$responseCode);
	}
}
