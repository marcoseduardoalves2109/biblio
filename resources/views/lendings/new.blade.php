@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <ol class="breadcrumb panel-heading">
                    <li class="active">Livros</li>
                </ol>
                <div class="panel-body">
                    <form class="form-inline" action="{{ route('lendings.add') }}" method="POST">
                    {{ csrf_field() }}

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Cod</th>
                                <th>Título</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($books as $book)
                                <tr>
                                    <th scope="row" class="text-center">{{ $book->id }}</th>
                                    <td>  <input type="checkbox" id="idlivro" name="livro[]" value="{{ $book->id }}"></td>
                                    <td>{{ $book->title }}</td>
                                    <td class="center">
                                        <img src="/images/book/{{ $book->image }}"  width="50px" />
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        
                    </table>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection