<?php

namespace ControleDeHoras\Http\Controllers;

use ControleDeHoras\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller {

	public function __construct() {
		// privar toda class
		$this->middleware('auth');
	}

	public function lista() {
		$idAccount = Auth::user()->idAccount;
		$users = User::all()->where('idAccount', $idAccount)->sortBy('name');

		return view('user.listagem', ['users' => $users, 'idAccount' => $idAccount]);
	}

	public function remove($id) {
		$user = User::find($id);

		if($user->idAccount <> Auth::user()->idAccount)
			return flashMessage('User', 'Sem permissão', 'danger');

		$user->delete();
		return flashMessage('User', 'Usuário removido com sucesso');

	}

	public function novo() {
		return view('user.novo');
	}

	protected function adiciona() {
		$request = Request::only('name', 'email', 'password', 'password2');

		$data = User::where('email', $request['email'])->count();

        if(!empty($data))
			return flashMessage('User', 'E-mail já cadastrado', 'danger');

		if ($request['password'] != $request['password2'])
			return flashMessage('User', 'Senhas não conferem', 'danger');
		
		User::create([
			'name' => $request['name'],
			'email' => $request['email'],
			'password' => Hash::make($request['password']),
			'idAccount' => Auth::user()->idAccount
		]);

		return flashMessage('User', 'Usuário cadastrado com sucesso');

	}

	public function edita($id) {
		$user = User::find($id);

		if($user->idAccount != Auth::user()->idAccount)
			return flashMessage('User', 'Sem permissão', 'danger');
		

		if (empty($user)) {
			return flashMessage('User', 'Usuário não localizado', 'danger');
		}

		return view('user.edita', ['user' => $user]);
	}

	public function atualiza() {
		$request = Request::except('_token');
		$user = User::find($request['id']);

		if($user->idAccount != Auth::user()->idAccount)
			return flashMessage('User', 'Sem permissão', 'danger');
		
		if ($request['password'] != $request['password2'])
			return flashMessage('User', 'Senhas não conferem', 'danger');

		unset($request['password2']);
		$request['password'] = Hash::make($request['password']);
		$user->update($request);

		return flashMessage('User', 'Usuário atualizado com sucesso');

	}

}
