<?php

function formatHour($hour, $minute) {

	// Verifica se é negativo e adiciona o traço
	$result = ($hour < 0 || $minute < 0) ? "-" : "";

	// Transforma em valor absoluto
	$hour = abs($hour);
	$minute = abs($minute);

	// Se for apenas um número adiciona 0 na frente
	$result .= (strlen($hour) == 1) ? '0' . $hour . ":" : $hour . ":";
	$result .= (strlen($minute) == 1) ? '0' . $minute : $minute;

	return ($result);

}

function flashMessage($controller, $msg, $type = 'success', $passed = true) {

	return redirect()->action($controller . 'Controller@lista')
		->withInput([
			'msg' => $msg,
			'type' => $type,
			'passed' => $passed,
		]);

}
