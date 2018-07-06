<?php

namespace ControleDeHoras\Http\Controllers;

use ControleDeHoras\Department;
use Illuminate\Support\Facades\Request;

class DepartmentController extends Controller {

	public function __construct() {
		// privar toda class
		$this->middleware('auth');
	}

	public function lista() {

		$departments = Department::all()->sortBy('name');

		return view('department.listagem')->with('departments', $departments);
	}

	public function mostra($id) {
		$department = Department::find($id);

		if ($department->works->count() == 0) {
			return flashMessage('Department', 'Não há funcionário no departamento', 'danger');
		}

		return view('department.mostra', ['department' => $department]);
	}

	public function remove($id) {
		$department = Department::find($id);

		if (empty($department)) {

			$msg = 'Departamento não existe';
			$type = 'danger';

		} elseif ($department->works->count() == 0) {

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

		Department::create(Request::all());
		return flashMessage('Department', 'Departamento adicionado com sucesso');

	}

}
