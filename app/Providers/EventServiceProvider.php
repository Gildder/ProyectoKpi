<?php

namespace ProyectoKpi\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        // evento -> acciones

        // Tarea -> Indicador
        'ProyectoKpi\Events\Tarea\TareaSaved' => [
            'ProyectoKpi\Listeners\Tarea\IndicadorSavedListener',
        ],

        'ProyectoKpi\Events\Tarea\TareaUpdated ' => [
            'ProyectoKpi\Listeners\Tarea\IndicadorUpdatedListener',
        ],

        'ProyectoKpi\Events\Tarea\TareaUpdating' => [
            'ProyectoKpi\Listeners\Tarea\IndicadorUpdatingListener',
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
    }
}
