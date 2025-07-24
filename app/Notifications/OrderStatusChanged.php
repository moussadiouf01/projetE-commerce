<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class OrderStatusChanged extends Notification
{
    use Queueable;

    public $order;
    public $oldStatus;
    public $newStatus;

    public function __construct(Order $order, $oldStatus, $newStatus)
    {
        $this->order = $order;
        $this->oldStatus = $oldStatus;
        $this->newStatus = $newStatus;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Changement de statut pour la commande #' . $this->order->id)
            ->greeting('Bonjour Admin,')
            ->line('Le statut de la commande #' . $this->order->id . ' a changé.')
            ->line('Ancien statut : ' . $this->oldStatus)
            ->line('Nouveau statut : ' . $this->newStatus)
            ->action('Voir la commande', url(route('admin.orders.show', $this->order)))
            ->line('Merci d’utiliser l’interface d’administration.');
    }

    public function toArray($notifiable)
    {
        return [
            'order_id' => $this->order->id,
            'old_status' => $this->oldStatus,
            'new_status' => $this->newStatus,
        ];
    }
} 