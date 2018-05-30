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
        <div class="panel-heading">Editar Registro</div>
            <div class="panel-body">
                @if(empty($record))
                    <div>Registro não localizado</div><br>
                @else
                    <form action="atualiza" method="post">
                        <div class="form-group">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                            <input type="hidden" name="id" value="{{ $record->id }}"/>
                            <select required name="mode" class="form-control">
                              <option value="" disabled>Modalidade</option>
                              <option @if ($record->mode == 'add') selected @endif value="add">Positivo</option>
                              <option @if ($record->mode == 'remove') selected @endif value="remove">Negativo</option>
                            </select>
                            <br>
                            <select required name="idWork" class="form-control">
                                <option value="" disabled>Funcionário</option>
                                    @foreach ($works as $w)
                                        @if ($record->idWork == $w->id)
                                         <option value='{{ $record->idWork }}' selected>{{ $w->lastname }}</option>
                                        @endif
                                    @endforeach
                            </select>
                            <br>
                            <input type="time" value="{{ $record->hour }}" class="form-control" name="hour" placeholder="Hora" required>
                            <br>
                            <input type="date" value="{{ $record->produced }}" class="form-control" name="produced" placeholder="Data" required>
                            <br>
                            <textarea class="form-control" aria-label="Comentário" placeholder="Comentário" name="comment" required>{{ $record->comment }}</textarea>
                            <br>
                            <button class="btn btn-primary" type="submit">Atualizar Registro</button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
@stop
