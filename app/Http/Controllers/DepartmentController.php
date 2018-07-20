<?php

namespace ControleDeHoras\Http\Controllers;

use ControleDeHoras\Department;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class DepartmentController extends Controller {

	public function __construct() {
		// privar toda class
		$this->middleware('auth');
	}

	public function lista() {
	
		$idAccount = Auth::user()->idAccount;

		$departments = Department::all()->where('idAccount', Auth::user()->idAccount)->sortBy('name');

		return view('department.listagem', ['departments' => $departments, 'idAccount' => $idAccount]);
	}

	public function mostra($id) {
		$department = Department::find($id);

		if ($department->works->count() == 0)
			return flashMessage('Department', 'Não há funcionário no departamento', 'danger');

		if ($department->idAccount <> Auth::user()->idAccount)
			return flashMessage('Department', 'Usuário sem permissão', 'danger');

		return view('department.mostra', ['department' => $department]);
	}

	public function remove($id) {
		$department = Department::find($id);

		if (empty($department)) {

			$msg = 'Departamento não existe';
			$type = 'danger';

		} elseif ($department->works->count() == 0) {
			$this->authorize('department', $department);
			$department->delete();
			$msg = 'Departamento excluido com sucesso';
			$type = 'success';

		} else {

			$msg = 'Este departamento possui funcionários cadastrados';
			$type = 'danger';
		}

		return flashMessage('Department', $msg, $type);

	}

	public function adiciona() {
		$request = Request::all();

		$this->authorize('department', (object)$request);

		Department::create($request);
		return flashMessage('Department', 'Departamento adicionado com sucesso');

	}

}
