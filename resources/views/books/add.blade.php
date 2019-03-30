@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
            	<ol class="breadcrumb panel-heading">
                	<li><a href="{{route('books.index')}}">Livros</a></li>
                	<li class="active">Adicionar</li>
                </ol>
                <div class="panel-body">
	                <form action="{{ route('books.save') }}" method="POST" enctype="multipart/form-data">
	                	{{ csrf_field() }}
						<div class="form-group">
						  	<label for="name">Título</label>
						    <input type="text" class="form-control" name="title" id="title" placeholder="Descrição">
						</div>
                        <div class="form-group">
						  	<label for="name">Descrição</label>
						    <input type="text" class="form-control" name="description" id="description" placeholder="Descrição">
						</div>
                        <div class="form-group">
                            <label for="name">Autores</label>
                            <select name="author[]" class="form-control selectpicker" multiple="" data-live-search="true" title="Autores">
                                @foreach($authors as $author)
                                <option value="{{ $author->id }}">{{ $author->name }}</option>
                                @endforeach()
                            </select>
                            <p class="help-block">Use Crtl para selecionar.</p>
                        </div>
                        <div class="control-group input-images">
                            <button type="button" class="btn btn-info" id="moreimages">Mais...</button>
                            <br />
                            <br />
                            <div class="controls">
                                <input name="image" type="file">
                            </div>
                        </div>

						<br />
						<button type="submit" class="btn btn-primary">Salvar</button>
	                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
