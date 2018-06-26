<?php

namespace ControleDeHoras\Http\Controllers\Auth;

use ControleDeHoras\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class RegisterController extends Controller {

	protected $redirectTo = '/home';

	public function __construct() {
		Redirect::to('/')->send();
	}

}
