@extends('layouts.app')

@section('title', 'Mes Tâches')

@section('content')

<style>
    .page-header {
        display: flex;
        align-items: baseline;
        justify-content: space-between;
        margin-bottom: 24px;
    }
    .page-title {
        font-size: 22px;
        font-weight: 600;
        color: #1c1c1a;
    }
    .page-title span {
        font-size: 14px;
        font-weight: 400;
        color: #9ca3af;
        margin-left: 8px;
    }

    .stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
        margin-bottom: 24px;
    }
    .stat-card {
        background: #fff;
        border: 1px solid #e8e8e5;
        border-radius: 10px;
        padding: 14px 16px;
    }
    .stat-number {
        font-size: 24px;
        font-weight: 600;
        color: #1c1c1a;
    }
    .stat-label {
        font-size: 12px;
        color: #9ca3af;
        margin-top: 2px;
        text-transform: uppercase;
        letter-spacing: 0.04em;
    }

    .task-list { display: flex; flex-direction: column; gap: 8px; }

    .task-card {
        background: #fff;
        border: 1px solid #e8e8e5;
        border-radius: 10px;
        padding: 14px 16px;
        display: flex;
        align-items: center;
        gap: 12px;
        transition: border-color .15s;
    }
    .task-card:hover { border-color: #d1d5db; }
    .task-card.done { opacity: 0.55; }

    .task-check {
        width: 18px; height: 18px;
        border-radius: 50%;
        border: 1.5px solid #d1d5db;
        flex-shrink: 0;
        display: flex; align-items: center; justify-content: center;
        background: #fff;
    }
    .task-check.done {
        background: #16a34a;
        border-color: #16a34a;
    }
    .task-check.done::after {
        content: '';
        display: block;
        width: 6px; height: 4px;
        border-left: 2px solid #fff;
        border-bottom: 2px solid #fff;
        transform: rotate(-45deg) translate(1px, -1px);
    }

    .task-body { flex: 1; min-width: 0; }
    .task-title {
        font-size: 14px;
        font-weight: 500;
        color: #1c1c1a;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .task-card.done .task-title {
        text-decoration: line-through;
        color: #9ca3af;
    }
    .task-desc {
        font-size: 12px;
        color: #9ca3af;
        margin-top: 2px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .task-actions { display: flex; gap: 6px; align-items: center; }

    .btn-edit, .btn-del {
        font-family: 'Inter', sans-serif;
        font-size: 12px;
        padding: 5px 10px;
        border-radius: 6px;
        border: 1px solid #e8e8e5;
        background: #fff;
        cursor: pointer;
        text-decoration: none;
        color: #6b7280;
        transition: all .12s;
    }
    .btn-edit:hover { background: #f5f5f4; color: #1c1c1a; }
    .btn-del { color: #dc2626; border-color: #fecaca; }
    .btn-del:hover { background: #fef2f2; }

    .empty {
        text-align: center;
        padding: 60px 0;
        color: #9ca3af;
    }
    .empty p { font-size: 14px; margin-bottom: 14px; }
    .btn-primary {
        display: inline-block;
        font-family: 'Inter', sans-serif;
        font-size: 13px;
        font-weight: 500;
        padding: 8px 18px;
        background: #1c1c1a;
        color: #fff;
        border-radius: 8px;
        text-decoration: none;
        border: none;
        cursor: pointer;
    }
    .btn-primary:hover { background: #2d2d2b; }
</style>

<div class="page-header">
    <h1 class="page-title">
        Mes Tâches
        <span>{{ $tasks->count() }} tâche{{ $tasks->count() > 1 ? 's' : '' }}</span>
    </h1>
</div>

<div class="stats">
    <div class="stat-card">
        <div class="stat-number">{{ $tasks->count() }}</div>
        <div class="stat-label">Total</div>
    </div>
    <div class="stat-card">
        <div class="stat-number">{{ $tasks->where('completed', false)->count() }}</div>
        <div class="stat-label">En cours</div>
    </div>
    <div class="stat-card">
        <div class="stat-number">{{ $tasks->where('completed', true)->count() }}</div>
        <div class="stat-label">Terminées</div>
    </div>
</div>

<div class="task-list">
    @forelse($tasks as $task)
        <div class="task-card {{ $task->completed ? 'done' : '' }}">
            <div class="task-check {{ $task->completed ? 'done' : '' }}"></div>
            <div class="task-body">
                <div class="task-title">{{ $task->title }}</div>
                @if($task->description)
                    <div class="task-desc">{{ $task->description }}</div>
                @endif
            </div>
            <div class="task-actions">
                <a href="{{ route('tasks.edit', $task) }}" class="btn-edit">Éditer</a>
                <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Supprimer cette tâche ?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-del">Supprimer</button>
                </form>
            </div>
        </div>
    @empty
        <div class="empty">
            <p>Aucune tâche pour l'instant.</p>
            <a href="{{ route('tasks.create') }}" class="btn-primary">Créer une tâche</a>
        </div>
    @endforelse
</div>

@endsection