@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Liste des utilisateurs</h2>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Retour au tableau de bord</a>
    </div>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Date d'inscription</th>
                    <th>Commandes</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at->format('d/m/Y') }}</td>
                        <td>{{ $user->orders_count }}</td>
                        <td>
                            <a href="{{ route('admin.users.show', $user) }}" class="btn btn-info btn-sm">Voir historique</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center mt-4">
        {{ $users->links() }}
    </div>
</div>
@endsection 