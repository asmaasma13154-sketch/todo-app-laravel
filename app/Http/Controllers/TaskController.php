<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Afficher toutes les tâches
     */
    public function index()
{
    $tasks = auth()->user()->tasks()->latest()->get();
    return view('tasks.index', compact('tasks'));
}

    /**
     * Formulaire création tâche
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Enregistrer une tâche
     */
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|min:3|max:255',
        'description' => 'nullable|max:1000',
    ]);

    auth()->user()->tasks()->create($request->only(['title', 'description']));

    return redirect()->route('tasks.index')->with('success', 'Tâche créée !');
}

    /**
     * Afficher une tâche
     */
    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    /**
     * Formulaire modification
     */
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    /**
     * Mettre à jour
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|min:3'
        ]);

        $task->update([
            'title' => $request->title
        ]);

        return redirect()->route('tasks.index');
    }

    /**
     * Supprimer
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index');
    }
}