<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use Illuminate\Validation\ValidationException;


class TodoController extends Controller
{
    public function index(){
        $todo = Todo::all();
        return view('index')->with('todos', $todo);
    }

    public function details(Todo $todo){

        return view('details')->with('todos', $todo);
    
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string|max:255',
            ]);
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        }

        $todo = new Todo();
        $todo->name = $validatedData['name'];
        $todo->description = $validatedData['description'];
        $todo->save();

        session()->flash('success', 'Todo created successfully');
        return redirect('/');
    }

    public function create(){
        return view('create');
    }
    
    public function edit(Todo $todo){
    
        return view('edit')->with('todos', $todo);
    
    }
    public function update(Todo $todo, Request $request){

        try {
            $validatedData = $request->validate([
                'name' => ['required'],
                'description' => ['required'],
           
            ]);
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        }
       
        $todo->name = $validatedData['name'];
        $todo->description = $validatedData['description'];
        $todo->save();

        session()->flash('success', 'Todo updated successfully');

        return redirect('/');

    }
    public function delete(Todo $todo){
        $todo->delete();

        return redirect('/');
    }
}
