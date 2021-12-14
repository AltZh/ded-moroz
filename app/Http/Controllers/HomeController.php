<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Letter;
use App\Models\Gift;
use Illuminate\Support\Facades\Auth;

//temp
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){
        $gifts_all    = Gift::all();
        
        return view('main_page', ['gifts_all' => $gifts_all]);
    }

    public function letters_list(){

        //$letters_list = Letter::where("author_id", 1)->get();
        $letters_list = Letter::all();

        return view('letters_list', ['letters_all' => $letters_list]);

    }

    public function my_letters_list(){

        $letters_list = Letter::where("author_id", Auth::user()->id )->get();
        
        return view('letters_list', ['letters_all' => $letters_list]);

    }

    public function letter_compose(){
        return view('letter_compose');
    }

    public function letter_create(Request $request){
        $validatedData = $request->validate([
            'body' => 'required|max:950',
            'is_private' => 'required',
        ]);

        $black_list = ['крампус', 'политика', 'спиннер', 'санта клаус'];
        $gray_list  = ['к*****с', 'п******а', 'с*****р', 'Дедушка Наш Любимый Мороз'];

        $validatedData['body'] = str_replace( $black_list, $gray_list, $validatedData['body']);

        $letter = new Letter;
        $letter->author_id = Auth::user()->id;
        $letter->body = $validatedData['body'];
        $letter->is_private = $validatedData['is_private'];
        //$letter->slug = $this->generate_slug();
        $letter->save();

        return back();
        //redirect()->intended()
        //redirect('')
        //redirect()->route('');
    }

    public function letter_edit( $id ){

        $letter = Letter::findOrFail($id);

        if( $letter->author_id == Auth::user()->id ){
            return view('letter_edit', [ 'letter' => $letter]);
        } else {
            return redirect()->route('letters.list.my');
        }

    }

    public function letter_update( Request $request, $id){

        $validatedData = $request->validate([
            'body' => 'required|max:950',
            'is_private' => 'required',
        ]);

        $letter = Letter::findOrFail($id);
        $letter->body = $validatedData['body'];
        $letter->is_private = $validatedData['is_private'];
        $letter->save();

        return redirect()->route('letters.list');
    }

    public function letter_response( $id ){
        $letter = Letter::findOrFail( $id );
        $gifts_all = Gift::all();
        
        if( Auth::user()->role == 'admin' ){
            return view('letter_response', ['letter' => $letter, 'gifts_all' => $gifts_all ]);
        } else {
            return redirect()->route('home');
        }
    }

    public function letter_send_response( Request $request, $id){
        $validatedData = $request->validate([
            'response' => 'required|max:950',
        ]);

        $letter = Letter::findOrFail($id);
        $letter->response = $validatedData['response'];
        $letter->save();

        return redirect()->route('letters.list');
    }

    public function letter_add_gift( Request $request, $id){

        $gift_id   = $request->gift_id;
        $is_public = $request->is_public;

        $letter = Letter::findOrFail($id);
        $letter->gifts()->attach( $gift_id, [ 'is_public' => $is_public ] );

        return back();
    }

    public function letter_view( $id ){

        $letter = Letter::findOrFail($id);

        return view('letter_view', [ 'letter' => $letter]);
    }

    public function generate_slug(){
        //возвращаяет случайную строку фывВФЫВйцвЦЙВЫФВЙ122135
    }
}
