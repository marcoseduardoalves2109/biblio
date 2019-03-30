<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lendings;
use Validator;

class AuthorController extends Controller
{

  
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
		$lendings = Lending::paginate(10);
	   	return view('lendings.index', compact('lendings'));
    }

    public function add()
    {
    	return view('lending.add');
    }

    public function save(Request $request)
    {

        //dd($request->all());
        $fileName=null;
        $validator = Validator::make($request->all(), [
            'date_start' => 'required|min:10|max:10'
        ]);
        if(!$validator->fails()){

           $result = Lending::create([
                'date_start' => $request->input('date_start'), 
                'date_end' => $request->input('date_end'),
                'date_finish'=> $request->input('date_finish')
            ]);
        }else{
            dd($validator->errors()->all());
        }

    	return redirect()->route('lending.index');	
    }

    public function edit($id)
    {
        $lending = Lending::find($id);

        if(!$lending){
            return redirect()->route('lending.index');
        }

        return view('lending.edit', compact('lending'));
    }

    public function update(Request $request, $id)
    {
     
        $update =[
            'date_start' =>  $request->input('date_start'),
            'date_end' =>  $request->input('date_end'),
            'date_finish' =>  $request->input('date_finish')
        ];
        $result = Lending::find($id)->update($update);
        return redirect()->route('lending.index');
    }

    public function delete($id)
    {
        $lending =  Lending::find($id);

        if($lending){
            $lending->books()->detach();
            $result = $lending->delete();
        }

        return redirect()->route('lending.index');
    }

    public function search(Request $request)
    {
        $date_start = $request->input('date_start');
        $search = TRUE;
        if($date_start){
            $books = Lending::where('date_start', 'like', '%' . $date_start . '%')->get();
        }
        return view('lending.index', compact('books', 'search'));
    }
}
