<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;


class OrderDispatched implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $quotation;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($quotation)
    {
        $this->quotation = $quotation;
    }

        public function broadcastWith(){
            return[
                /*'id' => $this->quotation->id,
                'items' => $this->quotation->items,
                'company_id' => $this->quotation->company_id,
                'user_id' => $this->quotation->user_id,
                'date' => $this->quotation->date,
                'production_dispatched' => $this->quotation->production_dispatched*/
                $this->quotation
            ];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('sales_dispatched');
    }
}
