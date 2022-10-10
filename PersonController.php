<?php

namespace App\Http\Controllers;

use App\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;

class PersonController extends Controller
{
    public function index(){
        $allPerson = Person::all();

        return response()->json($allPerson);
    }


    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'full_name' => 'required',
            'full_address' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        //dd($request->all(), $request->file('photo')->getClientOriginalName());

        if ($validator->fails()) {
            return 0;
        } else {
            $person = new Person();
            $person->unique_id = random_int(100000, 999999);
            $person->full_name = $request->full_name;
            $person->full_address = $request->full_address;
            if ($request->hasFile('photo')){
                $img_name = time().'.'.trim($request->file('photo')->getClientOriginalName());
                $request->photo->move(public_path('images'), $img_name);
                $person->photo = $img_name;
            }
            $person->save();
            return 1;
        }
    }

    public function delete($edit_id){
        $delete = Person::find($edit_id);
        $delete->delete();
        return 1;
    }

    public function deleteAll($edit_ids){
        $edit_ids = explode(',', $edit_ids);
        foreach ($edit_ids as $id){
            //dd($id);
            $delete = Person::find($id);
            $delete->delete();
        }
        return 1;
    }


}
