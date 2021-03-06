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
                    <form class="form-inline" action="{{ route('authors.search') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="put">
                        <div class="form-group" style="float: right;">
                            <p><a href="{{route('authors.add')}}" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-plus"></i> Adicionar</a></p>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Autor">
                        </div>
                        <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i> Buscar</button>
                    </form>
                    <br />
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Cod</th>
                                <th>Nome</th>
                                <th>Sobrenome</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($Authors as $author)
                                <tr>
                                    <th scope="row" class="text-center">{{ $author->id }}</th>
                                    <td>{{ $author->name }}</td>
                                    <td>{{ $author->surname }}</td>
                                    <td width="155" class="text-center">
                                        <a href="{{route('authors.edit', $author->id)}}" class="btn btn-default">Editar</a>
                                        <a href="{{route('authors.delete', $author->id)}}" class="btn btn-danger">Excluir</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if(!isset($search))
                    <div align="center">
                        {!! $Authors->links() !!}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection