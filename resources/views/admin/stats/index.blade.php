@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Statistiques</h1>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Retour au tableau de bord</a>
    </div>
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card text-center shadow">
                <div class="card-body">
                    <h5 class="card-title">Chiffre d'affaires</h5>
                    <p class="display-6 fw-bold">{{ number_format($chiffreAffaires, 2, ',', ' ') }} F CFA</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card text-center shadow">
                <div class="card-body">
                    <h5 class="card-title">Nombre de commandes</h5>
                    <p class="display-6 fw-bold">{{ $nbCommandes }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card text-center shadow">
                <div class="card-body">
                    <h5 class="card-title">Nombre de clients</h5>
                    <p class="display-6 fw-bold">{{ $nbClients }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow">
        <div class="card-header">
            <h4 class="mb-0">Top 5 des produits les plus vendus</h4>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>Produit</th>
                            <th>Quantité vendue</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($topProduits as $produit)
                            <tr>
                                <td>{{ $produit->name }}</td>
                                <td>{{ $produit->total_vendus ?? 0 }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection 