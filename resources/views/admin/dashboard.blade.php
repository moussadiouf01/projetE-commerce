@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Tableau de bord Admin</h1>
    <div class="row g-4">
        <div class="col-md-3">
            <a href="{{ route('admin.products.index') }}" class="text-decoration-none">
                <div class="card text-center shadow h-100">
                    <div class="card-body">
                        <div class="mb-2" style="font-size:2.5rem;">📦</div>
                        <h5 class="card-title">Produits</h5>
                        <p class="card-text">Gérer les produits</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('admin.categories.index') }}" class="text-decoration-none">
                <div class="card text-center shadow h-100">
                    <div class="card-body">
                        <div class="mb-2" style="font-size:2.5rem;">🗂️</div>
                        <h5 class="card-title">Catégories</h5>
                        <p class="card-text">Gérer les catégories</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('admin.orders.index') }}" class="text-decoration-none">
                <div class="card text-center shadow h-100">
                    <div class="card-body">
                        <div class="mb-2" style="font-size:2.5rem;">🧾</div>
                        <h5 class="card-title">Commandes</h5>
                        <p class="card-text">Gérer les commandes</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('admin.users.index') }}" class="text-decoration-none">
                <div class="card text-center shadow h-100">
                    <div class="card-body">
                        <div class="mb-2" style="font-size:2.5rem;">👤</div>
                        <h5 class="card-title">Utilisateurs</h5>
                        <p class="card-text">Gérer les utilisateurs</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('admin.stats.index') }}" class="text-decoration-none">
                <div class="card text-center shadow h-100">
                    <div class="card-body">
                        <div class="mb-2" style="font-size:2.5rem;">📊</div>
                        <h5 class="card-title">Statistiques</h5>
                        <p class="card-text">Voir les statistiques</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection 