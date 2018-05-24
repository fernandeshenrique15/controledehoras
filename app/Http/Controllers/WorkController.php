<?php

namespace ControleDeHoras\Http\Controllers;

use ControleDeHoras\Department;
use ControleDeHoras\Record;
use ControleDeHoras\Work;
use Illuminate\Support\Facades\Request;

class WorkController extends Controller {

	public function __construct() {
		// privar toda class
		$this->middleware('auth');
	}

	// Listar funcionários
	public function lista() {

		$works = Work::all();
		$departments = Department::all();

		foreach ($works as $work) {

			foreach ($departments as $department) {

				if ($work->idDepartment == $department->id) {
					$work->idDepartment = $department->name;
				}

				$work->hours = formatHour($work->hours, $work->minutes);
			}

		}

		return view('work.listagem')->with('works', $works);
	}

	public function mostra($id) {
		$work = Work::find($id);
		$records = Record::where('idWork', $id);

		if (empty($work)) {
			return flashMessage('Work', 'Esse funcionário não existe', 'danger');
		} elseif ($records->count() == 0) {
			return view('work.mostra', ['work' => $work]);
		}

		return view('work.mostra', ['work' => $work, 'records' => $records->get()]);
	}

	public function remove($id) {
		$work = Work::find($id);
		$work->delete();

		return flashMessage('Work', 'Funcionário removido com sucesso');
	}

	public function novo() {
		$departments = Department::all();
		return view('work.novo')->with('departments', $departments);
	}

	public function adiciona() {
		Work::create(Request::all());

		return flashMessage('Work', 'Funcionário cadastrado com sucesso');

	}

	public function edita($id) {
		$work = Work::find($id);
		$departments = Department::all();

		return view('work.edita', ['departments' => $departments, 'work' => $work]);
	}

	public function atualiza() {
		$request = Request::except('_token');
		Work::find($request['id'])->update($request);

		return flashMessage('Work', 'Funcionário atualizado com sucesso');

	}

}
