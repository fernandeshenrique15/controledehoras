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
    <div class="card col-auto mx-auto mt-5">
        <div class="card-body">
            <h5 class="card-title">Editar Registro</h5>
            <form action="atualiza" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                <input type="hidden" name="id" value="{{ $record->id }}"/>
                <select required name="mode" class="form-control mt-2">
                  <option value="" disabled>Modalidade</option>
                  <option @if ($record->mode == 'add') selected @endif value="add">Positivo</option>
                  <option @if ($record->mode == 'remove') selected @endif value="remove">Negativo</option>
                </select>
                <select required name="idWork" class="form-control mt-2">
                    <option value="" disabled>Funcionário</option>
                        @foreach ($works as $w)
                            @if ($record->idWork == $w->id)
                             <option value='{{ $record->idWork }}' selected>{{ $w->lastname }}</option>
                            @endif
                        @endforeach
                </select>
                <input type="time" value="{{ $record->hour }}" class="form-control mt-2" name="hour" placeholder="Hora" required>
                <input type="date" value="{{ $record->produced }}" class="form-control mt-2" name="produced" placeholder="Data" required>
                <textarea class="form-control mt-2" aria-label="Comentário" placeholder="Comentário" name="comment" required>{{ $record->comment }}</textarea>
                <button class="btn btn-primary mt-3" type="submit">Atualizar Registro</button>
            </form>
        </div>
    </div>
@stop
