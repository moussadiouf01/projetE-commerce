<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Facture Commande #{{ $order->id }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 14px; }
        .header { text-align: center; margin-bottom: 30px; }
        .table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .table th, .table td { border: 1px solid #333; padding: 8px; text-align: left; }
        .table th { background: #f2f2f2; }
        .right { text-align: right; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Facture - Commande #{{ $order->id }}</h2>
        <p>Date : {{ $order->created_at->format('d/m/Y H:i') }}</p>
    </div>
    <h4>Informations client</h4>
    <p><strong>Nom :</strong> {{ $order->user->name }}</p>
    <p><strong>Email :</strong> {{ $order->user->email }}</p>
    <hr>
    <h4>Détails de la commande</h4>
    <table class="table">
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
                    <td class="right">{{ $item->price_formatted }}</td>
                    <td class="right">{{ $item->quantity }}</td>
                    <td class="right">{{ $item->subtotal_formatted }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="right"><strong>Total</strong></td>
                <td class="right"><strong>{{ $order->total }}</strong></td>
            </tr>
        </tfoot>
    </table>
    <p><strong>Statut :</strong> {{ $order->status }}</p>
</body>
</html> 