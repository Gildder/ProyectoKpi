<?php

namespace ProyectoKpi\Events\Tarea;

use ProyectoKpi\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TareaUpdating extends Event
{
    use SerializesModels;

    public $tarea;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($tarea)
    {   
        $this->tarea = $tarea;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
