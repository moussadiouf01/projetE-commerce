@extends('layouts.app')

@section('content')
<div class="container" style="margin-top:80px;">
    <h2>Bienvenue sur le Dashboard Admin</h2>
    <form method="POST" action="{{ route('admin.logout') }}">
        @csrf
        <button type="submit" class="btn btn-danger mt-3">Déconnexion</button>
    </form>
</div>
@endsection 