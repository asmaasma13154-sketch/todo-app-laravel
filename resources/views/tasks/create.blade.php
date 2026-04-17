<h1>➕ Ajouter tâche</h1>

<form method="POST" action="{{ route('tasks.store') }}">
    @csrf

    <input type="text" name="title" placeholder="Titre">

    <button>Save</button>
</form>