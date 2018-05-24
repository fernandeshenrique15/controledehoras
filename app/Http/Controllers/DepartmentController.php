<?php

namespace ControleDeHoras\Http\Controllers;

use ControleDeHoras\Department;
use ControleDeHoras\Work;
use Illuminate\Support\Facades\Request;

class DepartmentController extends Controller {

	public function __construct() {
		// privar toda class
		$this->middleware('auth');
	}

	public function lista() {

		$departments = Department::all();

		return view('department.listagem')->with('departments', $departments);
	}

	public function mostra($id) {
		$department = Department::find($id);

		$works = Work::where('idDepartment', $id);

		if (empty($department)) {
			return flashMessage('Department', 'Departamento não existe', 'danger');

		} elseif ($works->count() == 0) {
			$msg = "Não há funcionário no " . $department->name;
			return flashMessage('Department', $msg, 'danger');
		}

		return view('department.mostra', ['department' => $department, 'works' => $works->get()]);
	}

	public function remove($id) {
		$department = Department::find($id);
		$works = Work::where('idDepartment', $id)->count();

		if (empty($department)) {

			$msg = 'Departamento não existe';
			$type = 'danger';

		} elseif ($works == 0) {

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
