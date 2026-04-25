<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Todo App') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .navbar {
            background: #fff;
            border-bottom: 1px solid #e5e7eb;
            padding: 0 32px;
            height: 56px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .navbar-brand {
            font-size: 15px;
            font-weight: 600;
            color: #1c1c1a;
            text-decoration: none;
        }
        .navbar-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .user-name {
            font-size: 13px;
            color: #6b7280;
        }
        .btn-logout {
            font-family: 'Figtree', sans-serif;
            font-size: 13px;
            padding: 6px 14px;
            border-radius: 6px;
            border: 1px solid #e5e7eb;
            background: #fff;
            color: #dc2626;
            cursor: pointer;
            transition: all .12s;
        }
        .btn-logout:hover { background: #fef2f2; }
        .container {
            max-width: 720px;
            margin: 40px auto;
            padding: 0 20px;
        }
        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 20px;
        }
        .alert-success { background: #f0fdf4; color: #166534; border: 1px solid #bbf7d0; }
        .alert-error   { background: #fef2f2; color: #991b1b; border: 1px solid #fecaca; }
    </style>
</head>
<body style="background:#f5f5f4; font-family:'Figtree',sans-serif; margin:0;">

<nav class="navbar">
    <a href="{{ route('tasks.index') }}" class="navbar-brand">Todo App</a>
    <div class="navbar-right">
        @auth
            <a href="{{ route('tasks.create') }}" style="font-size:13px;font-weight:500;padding:7px 16px;border-radius:6px;border:1px solid #e5e7eb;background:#1c1c1a;color:#fff;text-decoration:none;">+ Nouvelle tâche</a>
            <span class="user-name">{{ auth()->user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout">Déconnexion</button>
            </form>
        @else
            <a href="{{ route('login') }}" style="font-size:13px;color:#6b7280;text-decoration:none;">Connexion</a>
            <a href="{{ route('register') }}" style="font-size:13px;color:#1c1c1a;text-decoration:none;font-weight:500;">S'inscrire</a>
        @endauth
    </div>
</nav>

<div class="container">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-error">{{ session('error') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-error">Veuillez corriger les erreurs ci-dessous.</div>
    @endif

    @yield('content')
</div>

</body>
</html>