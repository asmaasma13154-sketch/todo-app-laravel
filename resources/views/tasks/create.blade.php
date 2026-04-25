@extends('layouts.app')

@section('title', 'Nouvelle Tâche')

@section('content')

<style>
    .form-card {
        background: #fff;
        border: 1px solid #e8e8e5;
        border-radius: 12px;
        padding: 28px 32px;
    }
    .form-header {
        margin-bottom: 24px;
        padding-bottom: 18px;
        border-bottom: 1px solid #e8e8e5;
    }
    .form-header h2 { font-size: 16px; font-weight: 600; color: #1c1c1a; }
    .form-header p  { font-size: 13px; color: #9ca3af; margin-top: 4px; }

    .form-group { margin-bottom: 18px; }

    label {
        display: block;
        font-size: 13px;
        font-weight: 500;
        color: #374151;
        margin-bottom: 6px;
    }
    label .required { color: #dc2626; margin-left: 2px; }

    input[type="text"], textarea {
        width: 100%;
        font-family: 'Inter', sans-serif;
        font-size: 14px;
        color: #1c1c1a;
        background: #fafaf9;
        border: 1px solid #e8e8e5;
        border-radius: 8px;
        padding: 10px 14px;
        transition: border-color .15s, box-shadow .15s;
        outline: none;
        resize: vertical;
    }
    input[type="text"]:focus, textarea:focus {
        background: #fff;
        border-color: #a3a3a0;
        box-shadow: 0 0 0 3px rgba(0,0,0,0.05);
    }
    input.is-invalid, textarea.is-invalid {
        border-color: #fca5a5;
        background: #fef2f2;
    }

    .error-msg {
        font-size: 12px;
        color: #dc2626;
        margin-top: 5px;
    }

    .form-actions {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-top: 24px;
        padding-top: 18px;
        border-top: 1px solid #e8e8e5;
    }
    .btn-primary {
        font-family: 'Inter', sans-serif;
        font-size: 13px;
        font-weight: 500;
        padding: 9px 20px;
        background: #1c1c1a;
        color: #fff;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        transition: background .12s;
    }
    .btn-primary:hover { background: #2d2d2b; }

    .btn-cancel {
        font-family: 'Inter', sans-serif;
        font-size: 13px;
        color: #6b7280;
        text-decoration: none;
        padding: 9px 16px;
        border-radius: 8px;
        border: 1px solid #e8e8e5;
        transition: all .12s;
    }
    .btn-cancel:hover { background: #f5f5f4; color: #1c1c1a; }
</style>

<div class="form-card">
    <div class="form-header">
        <h2>Nouvelle tâche</h2>
        <p>Remplissez les informations ci-dessous</p>
    </div>

    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="title">Titre <span class="required">*</span></label>
            <input
                type="text"
                id="title"
                name="title"
                value="{{ old('title') }}"
                placeholder="Ex : Finir le TP Laravel..."
                class="{{ $errors->has('title') ? 'is-invalid' : '' }}"
                autofocus
            >
            @error('title')
                <div class="error-msg">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Description <span style="color:#9ca3af;font-weight:400">(optionnel)</span></label>
            <textarea
                id="description"
                name="description"
                rows="4"
                placeholder="Détails supplémentaires..."
            >{{ old('description') }}</textarea>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-primary">Enregistrer</button>
            <a href="{{ route('tasks.index') }}" class="btn-cancel">Annuler</a>
        </div>
    </form>
</div>

@endsection