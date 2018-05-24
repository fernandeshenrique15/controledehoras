<?php

namespace ControleDeHoras;

use Illuminate\Database\Eloquent\Model;

class Department extends Model {

	// Desativar os campos padrões 'update_at' e 'created_at'
	public $timestamps = false;

	// Mensurar o que deve ser cadastrado
	protected $fillable = array('name');

	// Proibe inserção deste campo
	protected $guarded = ['id'];

	// public function works() {
	//     return $this->hasMany('ControleDeHoras\Work');
	// }

}
