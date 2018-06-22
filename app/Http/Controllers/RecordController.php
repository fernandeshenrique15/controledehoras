<?php

namespace ControleDeHoras\Http\Controllers;

use Carbon\Carbon;
use ControleDeHoras\Department;
use ControleDeHoras\Http\Requests\RecordRequest;
use ControleDeHoras\Record;
use ControleDeHoras\Work;

class RecordController extends Controller {

	public function __construct() {
		// privar exceto algumas funções
		$this->middleware('auth',
			['except' => ['lista']]);
	}

	public function lista() {

		$records = Record::limit(10)->latest()->get();
		$works = Work::all();

		foreach ($records as $r) {
			$formatDate = new Carbon($r->produced);
			$r->produced = $formatDate->format('d-m-Y');

			foreach ($works as $w) {

				if ($r->idWork == $w->id) {
					$r->idWork = $w->lastname;
				}

			}

		}

		return view('record.listagem')->with('records', $records);
	}

	public function remove($id) {
		$record = Record::find($id);

		// Localiza o funcionário para descontar o registro que será excluido
		$work = Work::find($record->idWork);
		$hour = explode(':', $record->hour);

		// Transforma tudo em minutos
		$hour[1] += $hour[0] * 60;
		$work->minutes += $work->hours * 60;

		// Faz o calculo

		if ($record->mode == 'add') {
			$work->minutes -= $hour[1];
		} elseif ($record->mode == 'remove') {
			$work->minutes += $hour[1];
		}

		// Reverte a transformação
		$work->hours = intval($work->minutes / 60);
		$work->minutes = $work->minutes - ($work->hours * 60);

		if ($work->save()) {

			if ($record->delete()) {
				return flashMessage('Work', 'Registro removido com sucesso');
			} else {
				return flashMessage('Work', 'Falha ao remover registro', 'danger');
			}

		} else {
			return flashMessage('Work', 'Falha ao descontar do funcionário', 'danger');
		}

	}

	public function novo() {
		$departments = Department::all();
		$works = Work::all();

		return view('record.novo', ['departments' => $departments, 'works' => $works]);
	}

	public function adiciona(RecordRequest $request) {
		$work = Work::find($request->idWork);

		if (empty($work)) {
			return flashMessage('Record', 'Falha ao adicionar registro', 'danger');
		}

		$dados = $request->except('_token');
		$hour = explode(':', $dados['hour']);

		// Transforma tudo em minutos
		$hour[1] += $hour[0] * 60;
		$work->minutes += $work->hours * 60;

		// Faz o calculo

		if ($dados['mode'] == 'add') {
			$work->minutes += $hour[1];
		} elseif ($request->mode == 'remove') {
			$work->minutes -= $hour[1];
		}

		// Reverte a transformação
		$work->hours = intval($work->minutes / 60);
		$work->minutes = $work->minutes - ($work->hours * 60);

		if ($work->save()) {
			Record::create($request->all());
			return flashMessage('Record', 'Registro adicionado com sucesso');
		}

		return flashMessage('Record', 'Falha ao adicionar registro', 'danger');
	}

	public function edita($id) {
		$departments = Department::all();
		$works = Work::all();
		$record = Record::find($id);

		if (empty($record)) {
			return flashMessage('Record', 'Registro não localizado', 'danger');
		}

		return view('record.edita', ['departments' => $departments, 'works' => $works, 'record' => $record]);
	}

	public function atualiza(RecordRequest $request) {
		$work = Work::find($request->idWork);
		$recordOld = Record::find($request->id);
		$workOld = Work::find($recordOld->idWork);

		if (empty($work)) {
			return flashMessage('Record', 'Funcionário não localizado', 'danger');
		}

		$hour = explode(':', $request->hour);
		$hourAntigo = explode(':', $recordOld->hour);

		// Transforma tudo em minutos
		$hour[1] += $hour[0] * 60;
		$hourAntigo[1] += $hourAntigo[0] * 60;

		$work->minutes += $work->hours * 60;

		// Verifica se permanece a modalidade

		if ($recordOld->mode == $request->mode) {

			// Sem alteração no funcionário

			if ($recordOld->hour == $request->hour) {

				if (Record::find($request->id)->update($request->except('_token'))) {
					return flashMessage('Record', 'Registro atualizado com sucesso');
				} else {
					return flashMessage('Record', 'Falha ao atualizar registro #142');
				}

			}

			// Alteração no hora, desfaz o calculo e calcula com o novo valor

			if ($request->mode == 'add') {
				$work->minutes -= $hourAntigo[1];
				$work->minutes += $hour[1];
			} elseif ($request->mode == 'remove') {
				$work->minutes += $hourAntigo[1];
				$work->minutes -= $hour[1];
			}

		}

		// Mudou a modalidade, desfaz o calculo e calcula com a nova modalidade

		else {

			if ($request->mode == 'add') {
				$work->minutes += $hourAntigo[1];
				$work->minutes += $hour[1];
			} elseif ($request->mode == 'remove') {
				$work->minutes -= $hourAntigo[1];
				$work->minutes -= $hour[1];
			}

		}

		// Reverte a transformação
		$work->hours = intval($work->minutes / 60);
		$work->minutes = $work->minutes - ($work->hours * 60);

		if ($work->save()) {
			Record::find($request->id)->update($request->except('_token'));
			return flashMessage('Record', 'Registro atualizado com sucesso');
		} else {
			return flashMessage('Record', 'Falha ao atualizar funcionário', 'danger');
		}

	}

};
