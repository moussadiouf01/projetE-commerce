<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class OrderStatusChangedClient extends Notification
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
            ->subject('Mise à jour de votre commande #' . $this->order->id)
            ->greeting('Bonjour ' . $this->order->user->name . ',')
            ->line('Le statut de votre commande #' . $this->order->id . ' a changé.')
            ->line('Ancien statut : ' . $this->oldStatus)
            ->line('Nouveau statut : ' . $this->newStatus)
            ->action('Voir ma commande', url('/'))
            ->line('Merci pour votre confiance.');
    }
} 