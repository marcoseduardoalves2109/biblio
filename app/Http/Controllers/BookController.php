<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Books;
use App\Models\Authors;
use Validator;

class BookController extends Controller
{

    private $path = 'images/book';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
		$books = Books::paginate(10);
	   	return view('books.index', compact('books'));
    }

    public function add()
    {
        $authors = Authors::all();
    	return view('books.add', compact('authors'));
    }

    public function save(Request $request)
    {

        //dd($request->all());
        $fileName=null;
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:5|max:255'
        ]);
        if(!$validator->fails()){

            if (!empty($request->file('image')) && $request->file('image')->isValid()) {
                $fileName = time() . '.' . $request->file('image')->getClientOriginalExtension();
                $request->file('image')->move($this->path, $fileName);

      
            }

            $book = Books::create([
                'title' => $request->input('title'), 
                'description'  => $request->input('description'),
                'image' => $fileName
            ]);
            $book->authors()->sync($request->input('author'));
        }else{
            dd($validator->errors()->all());
        }

    	return redirect()->route('books.index');	
    }

    public function edit($id)
    {
        $book = Books::find($id);

        if(!$book){
            return redirect()->route('books.index');
        }

        return view('books.edit', compact('book'));
    }

    public function update(Request $request, $id)
    {
        $fileName = NULL;

        if (!empty($request->file('image')) && $request->file('image')->isValid()) {
            if(!empty($request->input('deleteimage')) && file_exists($this->path . '/' . $request->input('deleteimage'))){
                unlink($this->path . '/' . $request->input('deleteimage'));
            }
            $fileName = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move($this->path, $fileName);
        }

        if(!$fileName){
            $update = [
                'title' =>  $request->input('title'),
            ];
        }else{
            $update =[
                'title' =>  $request->input('title'),
                'text'  =>  $request->input('text'),
                'image' => $fileName
            ];
        }

        $result = Books::find($id)->update($update);
        
        return redirect()->route('books.index');
    }

    public function delete($id)
    {
        $book =  Books::find($id);

        if($book){
            $book->authors()->detach();
            $result = $book->delete();
        }

        return redirect()->route('books.index');
    }

    public function search(Request $request)
    {
        $title = $request->input('title');
        $search = TRUE;
        if($title){
            $books = Books::where('title', 'like', '%' . $title . '%')->get();
        }
        return view('books.index', compact('books', 'search'));
    }
}
