<?php

namespace ControleDeHoras\Http\Controllers;

use ControleDeHoras\Account;
use ControleDeHoras\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function adiciona() {
        $request = Request::except('_token');
        $data = User::where('email', $request['email'])->count();
        
        // Verifica se e-mail esta cadastrado
        if(!empty($data)){
            return redirect('login')->withInput([
                'msg' => 'E-mail já cadastrado',
                'type' => 'danger',
                'passed' => 'true'
            ]);
        }
        else {

            $idUser = User::create([
                'name' => $request['user'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'idAccount' => Account::create(Request::only('name'))->id
            ])->id;

            Auth::loginUsingId($idUser);
            return flashMessage('Department', 'Bem vindo ao sistema, cadastre seus dados', 'success');

      }
	
    }
    
    public function lista() {
        return view('auth.login');	
	}
}
