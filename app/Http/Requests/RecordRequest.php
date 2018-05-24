<?php

namespace ControleDeHoras\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecordRequest extends FormRequest {
	public function authorize() {
		return true;
	}

	public function rules() {
		return [
			'mode' => 'required|min:3',
			'idWork' => 'required|numeric',
			'hour' => 'required',
			'produced' => 'required|date',
			'comment' => 'required|max:255',
		];
	}

	public function messages() {
		return [
			'required' => 'O campo :attribute é obrigatório!',
			'numeric' => 'O campo :attribute deve ser numérico',
			'date' => 'O campo :attribute deve ser uma data',
		];
	}
}
