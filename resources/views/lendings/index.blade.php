@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <ol class="breadcrumb panel-heading">
                    <li class="active">Categorias</li>
                </ol>
                <div class="panel-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Cod</th>
                                <th>Inicio</th>
                                <th>Fim</th>
                                <th>Devolução</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lendings as $lending)
                                <tr>
                                    <th scope="row" class="text-center">{{ $lending->id }}</th>
                                    <td>{{ $lending->date_start }}</td>
                                    <td>{{ $lending->date_end }}</td>
                                    <td>
                                        @if (empty($lending->date_finish))
                                        <a href="{{route('lendings.devolucao', $lending->id)}}" class="btn btn-default">Devolver</a>
                                        @else
                                        {{ $lending->date_finish }}
                                        @endif

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection