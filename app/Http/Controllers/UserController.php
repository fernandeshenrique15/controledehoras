<?php

namespace ControleDeHoras\Http\Controllers;

use ControleDeHoras\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;

class UserController extends Controller {

	public function __construct() {
		// privar toda class
		$this->middleware('auth');
	}

	public function lista() {

		$users = User::all()->sortBy('name');

		return view('user.listagem')->with('users', $users);
	}

	public function remove($id) {
		$user = User::find($id);

		// Não apaga o primeiro usuário

		if ($user->id != 1) {

			$user->delete();
			return flashMessage('User', 'Usuário removido com sucesso');
		}

		return flashMessage('User', 'Não é possível excluir o usuário primário', 'danger');
	}

	public function novo() {
		return view('user.novo');
	}

	protected function adiciona() {
		$request = Request::only('name', 'email', 'password', 'password2');

		if ($request['password'] == $request['password2']) {
			User::create([
				'name' => $request['name'],
				'email' => $request['email'],
				'password' => Hash::make($request['password']),
			]);

			return flashMessage('User', 'Usuário cadastrado com sucesso');
		} else {
			return flashMessage('User', 'Senhas não conferem', 'danger');
		}

	}

	public function edita($id) {
		$user = User::find($id);

		if (empty($user)) {
			return flashMessage('User', 'Usuário não localizado', 'danger');
		}

		return view('user.edita', ['user' => $user]);
	}

	public function atualiza() {
		$request = Request::except('_token');

		if ($request['password'] == $request['password2']) {
			$request['password'] = Hash::make($request['password']);
			User::find($request['id'])->update($request);

			return flashMessage('User', 'Usuário atualizado com sucesso');
		} else {
			return flashMessage('User', 'Senhas não conferem', 'danger');
		}

	}

}
