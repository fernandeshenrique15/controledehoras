<?php

namespace ControleDeHoras;

use Illuminate\Database\Eloquent\Model;

class Record extends Model {

	// Mensurar o que deve ser cadastrado
	protected $fillable = array('mode', 'idWork', 'hour', 'produced', 'update_at', 'created_at', 'comment');

	// Proibe inserção deste campo
	protected $guarded = ['id'];

}
