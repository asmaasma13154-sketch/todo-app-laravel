<h1>✏️ Modifier tâche</h1>

<form method="POST" action="{{ route('tasks.update', $task->id) }}">
    @csrf
    @method('PUT')

    <input type="text" name="title" value="{{ $task->title }}">

    <button>Update</button>
</form>