<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        // Assurons-nous d'avoir un utilisateur et des produits
        $user = User::first() ?? User::factory()->create();
        $productsCount = Product::count();
        if ($productsCount < 3) {
            Product::factory(3 - $productsCount)->create();
        }
        $products = Product::all();

        // Créer quelques commandes
        $statuses = ['en attente', 'en cours', 'expédié', 'livré', 'annulé'];
        
        foreach (range(1, 5) as $i) {
            $order = Order::create([
                'user_id' => $user->id,
                'status' => $statuses[array_rand($statuses)],
                'total' => 0, // Sera mis à jour après l'ajout des items
            ]);

            // Ajouter 2-3 produits à chaque commande
            $orderTotal = 0;
            foreach ($products->random(min($products->count(), rand(2, 3))) as $product) {
                $quantity = rand(1, 3);
                $price = $product->price;
                
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $price
                ]);

                $orderTotal += $quantity * $price;
            }

            // Mettre à jour le total de la commande
            $order->update(['total' => $orderTotal]);
        }
    }
} 