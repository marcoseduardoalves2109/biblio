<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Authors;
use App\Models\Books;

class ApiController extends Controller{

    public function Livros(){
        $books = Books::with(['books','images'])->get();
        return response()->json($books);
    }

    public function autores(){
        $authors = Category::all();
        return response()->json($authors);
    }
    
}