<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TodosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('todo', [
            'todos' => Todo::latest()->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validateRequest($request);

        Todo::create([
            'title' => $request->get('title')
        ]);
        return redirect()->route('index')->with('success', 'Todo has been added!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('edit', [
            'todo' => Todo::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validateRequest($request);

        $todo = Todo::find($id);
        $todo->title = $request->get('title');
        $todo->is_completed = (bool) $request->get('is_completed');
        $todo->save();

        return redirect()->route('index')->with('success', 'Todo has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Todo::where('id' ,$id)->delete();
        return redirect()->route('index')->with('success', 'Todo has been deleted!');
    }

    private function validateRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|min:5',
            'is_completed' => 'nullable'
        ]);

        if ($validator->fails()) {
            return redirect()->route('index')->withErrors($validator);
        }

        return $validator;
    }
}
