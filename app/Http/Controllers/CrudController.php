<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Crud;
use Illuminate\Support\Facades\Session;
//use Session;
//use Illuminate\Contracts\Session\Session;


class CrudController extends Controller
{
    public function showData(){
        // $showData = Crud::all();
        //$showData = Crud::paginate(3);
        $showData = Crud::SimplePaginate(3);
        return view('show_data', compact('showData'));
    }

    public function addData(){
        return view('add_data');
    }
    public function storeData(Request $request){
        
        $rules = [
            'name' => 'required| max:10',
            'email' => 'required| email',
        ];
        $cm =[
            'name.required' => 'Enter your name',
            'name.max' => 'your name may be highest 10 character\'s length',
            'email.required' => 'Enter your email',
            'email.email' => 'email must be valid',

        ];
        $this -> validate($request, $rules, $cm);
        
        $crud = new Crud();
        $crud->name = $request->name;
        $crud->email = $request->email;
        $crud->save();

        Session::flash('msg', 'Data successfully added');
    
        // return redirect()->back();   //for showing message in add_data directory
        return redirect('/');           //for showing message in show_data directory
    }

    public function editData($id=null){
        $editData = Crud::find($id);
        return view('edit_data', compact('editData'));

    }
    public function updateData(Request $request, $id){
        
        $rules = [
            'name' => 'required| max:10',
            'email' => 'required| email',
        ];
        $cm =[
            'name.required' => 'Enter your name',
            'name.max' => 'your name may be highest 10 character\'s length',
            'email.required' => 'Enter your email',
            'email.email' => 'email must be valid',

        ];
        $this -> validate($request, $rules, $cm);
        
        $crud = Crud::find($id);
        $crud->name = $request->name;
        $crud->email = $request->email;
        $crud->save();

        Session::flash('msg', 'Data successfully updated');
    
        // return redirect()->back();   //for showing message in add_data directory
        return redirect('/');           //for showing message in show_data directory
    }

    public function deleteData($id=null){
        $deleteData= Crud::find($id);
        $deleteData->delete();

        Session::flash('msg', 'Data successfully Deleted');
        return redirect('/');           //for showing message in show_data directory
    }

}
