@extends('layout.principal')

@section('conteudo')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    <br>
@endif

<div class="panel panel-primary">
    <div class="panel-heading">Cadastro de Registro</div>
        <div class="panel-body">
        <form action="adiciona" method="post">
            <div class="form-group">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                <select required name="mode" class="form-control">
                  <option selected value="" disabled>Modalidade</option>
                  <option value="add">Positivo</option>
                  <option value="remove">Negativo</option>
                </select>
                <br>
                <select required name="idWork" class="form-control">
                    <option selected value="" disabled>Funcionário</option>

                    @foreach ($departments as $d)

                        <optgroup label="{{ $d->name }}">

                        @foreach ($works as $w)

                            @if ($w->idDepartment == $d->id)

                                <option value='{{ $w->id }}'>{{ $w->lastname }}</option>

                            @endif

                        @endforeach

                        </optgroup>

                    @endforeach

                </select>
                <br>
                <input type="time" class="form-control" name="hour" placeholder="Hora" required>
                <br>
                <input type="date" class="form-control" name="produced" placeholder="Data" required>
                <br>
                <textarea class="form-control" aria-label="Comentário" placeholder="Comentário" name="comment" required></textarea>
                <br>
                <button class="btn btn-primary" type="submit">Cadastrar Registro</button>
            </div>
        </form>
        </div>
    </div>
</div>
@stop
