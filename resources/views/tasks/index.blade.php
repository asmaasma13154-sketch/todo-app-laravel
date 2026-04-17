<!DOCTYPE html>
<html>
<head>
    <title>Todo List</title>
</head>
<body>

<h1>📋 Liste des tâches</h1>

<a href="{{ route('tasks.create') }}">➕ Ajouter</a>

<hr>

@if($tasks->count() > 0)

    @foreach($tasks as $task)
        <div style="border:1px solid #ccc; padding:10px; margin:10px;">
            <h3>
                {{ $task->title }}
            </h3>

            <p>
                {{ $task->description }}
            </p>

            <p>
                @if($task->completed)
                    ✅ Terminée
                @else
                    ⏳ En cours
                @endif
            </p>

        </div>
    @endforeach

@else
    <p>Aucune tâche pour le moment 😴</p>
@endif

</body>
</html>