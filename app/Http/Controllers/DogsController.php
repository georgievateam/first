<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dog;
use Illuminate\Support\Facades\Auth;

class DogsController extends Controller
{
    public function postNewDog(Request $request){
        $this->validate($request,[
            'name'=>'required|min:1|max:50',
            'breed'=>'required|max:120'
            ]);

        $dog = new Dog;
        $dog->breed = $request->breed;

        $dog->name = $request->name;
        $dog->vaccine = false;
        $dog->user_id = Auth::user()->id;
        $dog->save();

        return redirect()->back()->with('success', 'Успешно създадено куче: '.$request->name);
    }
    function getHome(){
        $dogs = Dog::where('user_id', Auth::user()->id)->get();
        return view('home',[
            'dogs'=>$dogs,
        ]);
    }
    function deleteDog(Request $request, $id){
        $dog  = Dog::where('id', $id);
        $dog->delete();

        return response(200);
    }
    function renameDog(Request $request, $id){
        $dog = Dog::where('id', $id);
        return view('refactorDog', [
            'dog' => $dog,
        ]);

    }
    function postRefactor(){

    }
}
