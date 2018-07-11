<?php

namespace ControleDeHoras;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {
	use Notifiable;

	protected $guarded = ['id'];

	protected $hidden = [
		'password', 'remember_token',
	];

	public function account() {
		return $this->belongsTo('ControleDeHoras\Account', 'idAccount');
	}

}
