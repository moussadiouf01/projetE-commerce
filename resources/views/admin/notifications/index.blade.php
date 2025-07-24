@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Notifications</h1>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Retour au tableau de bord</a>
    </div>
    <div class="list-group">
        @forelse($notifications as $notification)
            <div class="list-group-item d-flex justify-content-between align-items-center @if($notification->read_at) bg-light @endif">
                <div>
                    @if($notification->type === 'App\\Notifications\\OrderStatusChanged')
                        <strong>Commande #{{ $notification->data['order_id'] ?? '' }}</strong> :
                        Statut changé de <b>{{ $notification->data['old_status'] ?? '' }}</b> à <b>{{ $notification->data['new_status'] ?? '' }}</b>.
                        <a href="{{ route('admin.orders.show', $notification->data['order_id'] ?? 0) }}">Voir la commande</a>
                    @else
                        {{ $notification->data['message'] ?? 'Notification' }}
                    @endif
                    <br>
                    <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                </div>
                @if(!$notification->read_at)
                <form action="{{ route('admin.notifications.read', $notification->id) }}" method="POST">
                    @csrf
                    <button class="btn btn-sm btn-outline-primary">Marquer comme lue</button>
                </form>
                @endif
            </div>
        @empty
            <div class="list-group-item">Aucune notification.</div>
        @endforelse
    </div>
</div>
@endsection 