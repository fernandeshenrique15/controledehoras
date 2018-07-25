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

		if(empty($user))
			return flashMessage('User', 'Usuário não existe', 'danger');

		$this->authorize('user', $user);

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
		$idAccount = Auth::user()->idAccount;
		$user = User::find($id);

		if (empty($user)) {
			return flashMessage('User', 'Usuário não localizado', 'danger');
		}

		$this->authorize('user', $user);

		return view('user.edita', ['user' => $user, 'idAccount' => $idAccount]);
	}

	public function atualiza() {
		// dados do formulário
		$request = (object) Request::except('_token');
		
		// usuário atual do banco
		$user = User::find($request->id);

		// verificação para não cadastrar o mesmo e-mail
		$data = User::where('email', $request->email)->count();
		if($user->email != $request->email && $data != 0) {
			return flashMessage('User', 'E-mail já cadastrado em nosso sistema', 'danger');
		}

		$this->authorize('user', $request);
		
		if ($request->password != $request->password2)
			return flashMessage('User', 'Senhas não conferem', 'danger');

		unset($request->password2);
		$request->password = Hash::make($request->password);
		$user->update((array) $request);

		return flashMessage('User', 'Usuário atualizado com sucesso');

	}

}
