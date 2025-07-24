@extends('layouts.app')

@section('content')
<div class="container">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Liste des produits</h2>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Retour au tableau de bord</a>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Ajouter un produit</a>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prix</th>
                <th>Stock</th>
                <th>Catégorie</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price_formatted }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->category ? $product->category->name : '-' }}</td>
                    <td>
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="Image" width="50">
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-warning">Modifier</a>
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ce produit ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Aucun produit trouvé.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection 