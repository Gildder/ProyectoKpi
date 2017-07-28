<?php

namespace ProyectoKpi\Listeners\Eficacia;

use ProyectoKpi\Events\Eficacia\ProgramacionImportacionTickets;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class InsertandoImportacion
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ProgramacionImportacionTickets  $event
     * @return void
     */
    public function handle(ProgramacionImportacionTickets $event)
    {
        //
    }
}
