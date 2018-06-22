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

@endif

    <div class="card card-primary col-auto mx-auto mt-5">
        <div class="card-body">
            <h5 class="card-title">Cadastro de Registro</h5>
            <form action="adiciona" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                <select required name="mode" class="form-control">
                  <option selected value="" disabled>Modalidade</option>
                  <option value="add">Positivo</option>
                  <option value="remove">Negativo</option>
                </select>

                <select required name="idWork" class="form-control mt-2">
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

                <input type="time" class="form-control mt-2" name="hour" placeholder="Hora" required>

                <input type="date" class="form-control mt-2" name="produced" placeholder="Data" required>

                <textarea class="form-control mt-2" aria-label="Comentário" placeholder="Comentário" name="comment" required></textarea>

                <button class="btn btn-primary mt-4" type="submit">Cadastrar Registro</button>
            </form>
        </div>
    </div>
@stop
