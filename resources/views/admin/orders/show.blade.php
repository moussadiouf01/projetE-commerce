@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2 class="mb-0">Commande #{{ $order->id }}</h2>
                    <div>
                        <a href="{{ route('admin.orders.invoice', $order) }}" class="btn btn-success me-2" target="_blank">Télécharger la facture PDF</a>
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary me-2">Tableau de bord</a>
                        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Retour</a>
                    </div>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h4>Informations client</h4>
                            <p><strong>Nom :</strong> {{ $order->user->name }}</p>
                            <p><strong>Email :</strong> {{ $order->user->email }}</p>
                            <p><strong>Date de commande :</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                        <div class="col-md-6">
                            <h4>Statut de la commande</h4>
                            <form action="{{ route('admin.orders.update-status', $order) }}" method="POST" class="mb-3">
                                @csrf
                                @method('PATCH')
                                <div class="input-group">
                                    <select name="status" class="form-control">
                                        <option value="en attente" {{ $order->status == 'en attente' ? 'selected' : '' }}>En attente</option>
                                        <option value="en cours" {{ $order->status == 'en cours' ? 'selected' : '' }}>En cours</option>
                                        <option value="expédié" {{ $order->status == 'expédié' ? 'selected' : '' }}>Expédié</option>
                                        <option value="livré" {{ $order->status == 'livré' ? 'selected' : '' }}>Livré</option>
                                        <option value="annulé" {{ $order->status == 'annulé' ? 'selected' : '' }}>Annulé</option>
                                    </select>
                                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                                </div>
                            </form>
                            <p><strong>Statut actuel :</strong> 
                                <span class="badge {{ $order->status_badge }}">{{ $order->status }}</span>
                            </p>
                        </div>
                    </div>

                    <h4>Détails de la commande</h4>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Produit</th>
                                    <th>Prix unitaire</th>
                                    <th>Quantité</th>
                                    <th>Sous-total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->orderItems as $item)
                                    <tr>
                                        <td>{{ $item->product->name }}</td>
                                        <td>{{ $item->price_formatted }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ $item->subtotal_formatted }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-right"><strong>Total</strong></td>
                                    <td><strong>{{ $order->total }}</strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 