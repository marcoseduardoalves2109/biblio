<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Lendings;
use App\models\Books;

class LendingController extends Controller
{
    private $totalPage =5;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user_id = \Auth::user()->id;
        if(!auth()->user()->role == 1000){
            $lendings = Lendings::where('user_id', '=', $user_id)->withCount('books')->paginate($this->totalPage);
        }
        else{
            $lendings = Lendings::withCount('books')->paginate($this->totalPage);
        }
        return view('lendings.index', compact('lendings'));
    }
    public function emprestimo()
    {
        $books = Books::get();
        return view('lendings.new', compact('books'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        $livros=$request->input("livro");
        $userid=\Auth::user()->id;
        $lending=Lendings::create([
            'user_id' =>$userid,
            'date_start' =>date('Y-m-d H:i:s'),
            'date_end' => date('Y-m-d', strtotime(date('Y-m-d H:i:s') . ' + 7 day'))
        ]);
        $lending->books()->sync($livros);
        return redirect()->route('lendings.index');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function devolucao($id)
    {
        //
        $lending=Lendings::find($id);
        $lending->date_finish = date('Y-m-d H:i:s');
        $lending->save();
        return redirect()->route('lendings.index');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //f
        $lennding = Lendings::find(id);
        if($lennding)
            return redirect()->back();
        
        $title = "Empréstimo número: ($lennding->id)";
        return view('lending.show', compact('title','lending'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function lending()
    {
        if (session()->has('carrinho')){
            $user_id = auth()->user()->id;
            $date_start = Carbon::now();
            $date_end = Carbon::now()->addDays(7);
            $lending = new Lendings();
            $lending->user_id = $user_id;
            $lending->date_start = $date_start;
            $lending->date_end = $date_end;
            
            $lending->save();
            $lending->books()->attach(session('carrinho'));
            session()->forget('carrinho');

        }
    }

    
}
