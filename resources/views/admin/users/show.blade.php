@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Détail utilisateur</h2>
        <div>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary me-2">Tableau de bord</a>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Retour à la liste</a>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <h4>{{ $user->name }}</h4>
            <p><strong>Email :</strong> {{ $user->email }}</p>
            <p><strong>Date d'inscription :</strong> {{ $user->created_at->format('d/m/Y') }}</p>
            <p><strong>Nombre de commandes :</strong> {{ $user->orders->count() }}</p>
        </div>
    </div>
    <h4>Historique des commandes</h4>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Statut</th>
                    <th>Total</th>
                    <th>Produits</th>
                </tr>
            </thead>
            <tbody>
                @foreach($user->orders as $order)
                    <tr>
                        <td>#{{ $order->id }}</td>
                        <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                        <td><span class="badge {{ $order->status_badge }}">{{ $order->status }}</span></td>
                        <td>{{ $order->total }}</td>
                        <td>
                            <ul class="mb-0">
                                @foreach($order->orderItems as $item)
                                    <li>{{ $item->product->name }} x {{ $item->quantity }}</li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection 