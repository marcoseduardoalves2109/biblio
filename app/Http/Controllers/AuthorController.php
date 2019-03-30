<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Authors;
use Validator;

class AuthorController extends Controller
{

  
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
		$Authors = Authors::paginate(10);
	   	return view('authors.index', compact('Authors'));
    }

    public function add()
    {
    	return view('authors.add');
    }

    public function save(Request $request)
    {

        //dd($request->all());
        $fileName=null;
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:5|max:255'
        ]);
        if(!$validator->fails()){

           $result = Authors::create([
                'name' => $request->input('name'), 
                'surname' => $request->input('surname')
            ]);
        }else{
            dd($validator->errors()->all());
        }

    	return redirect()->route('authors.index');	
    }

    public function edit($id)
    {
        $author = Authors::find($id);

        if(!$author){
            return redirect()->route('authors.index');
        }

        return view('authors.edit', compact('author'));
    }

    public function update(Request $request, $id)
    {
     
        $update =[
            'name' =>  $request->input('name')
        ];
        $result = Authors::find($id)->update($update);
        return redirect()->route('authors.index');
    }

    public function delete($id)
    {
        $author =  Authors::find($id);

        if($author){
            $author->books()->detach();
            $result = $author->delete();
        }

        return redirect()->route('authors.index');
    }

    public function search(Request $request)
    {
        $name = $request->input('name');
        $search = TRUE;
        if($name){
            $authors = Authors::where('name', 'like', '%' . $name . '%')->get();
        }
        return view('authors.index', compact('authors', 'search'));
    }
}
