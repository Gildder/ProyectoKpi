<?php

return [

    'labels' => [
        // Tareas Resultas
        'lbsDescripcion'  => 'Descripcion *:',
        'lbsDescripcionAyuda'  => 'Descripcion:',
        'lbsFechaInicio'   => 'Fecha Inicio *:',
        'lbsFechaFin'   => 'Fecha Fin *:',
        'lbsCheckEstimadas' => 'Utilizar Fechas y Horas estimadas',
        'lbsDuracion' => 'Duracion:',
        'lbsEstado' => 'Estado *:',
        'lbsHora' => 'Hora *:',
        'lbsMinuto' => 'Minutos *:',
        'lbsObservaciones' => 'Observaciones:',
        'lbsLocalizaciones' => 'Localizaciones *:',

        /*Estado tarea */
        'lbsNombre'  => 'Nombre *:',

    ],

    'buttons' => [
        /* Tarea Resolver */
        'btnCancelar' => 'Cancelar',
        'btnGuardar' => 'Guardar',
        'btnNuevo' => 'Nuevo',
        'btnEditar' => 'Editar',
        'btnEliminar' => 'Eliminar',
        'btnReciclados' => 'Reciclados',
        'btnRestaurar' => 'Restaurar',
        'btnAceptar' => 'Aceptar',
        'btnFinalizar' => 'Finalizar',
        'btnAbrir' => 'Reabrir',
        'btnFinalizarArchivo' => 'Terminar',
        'btnInfo' => '',
        'btnBuscar' => 'Buscar',
        'btnLimpiar' => 'Limpiar',
    ],

    'stylbtns' => [
        'btnGuardar' => 'btn btn-success',
        'btnCancelar' => 'btn btn-danger',
        'btnNuevo' => 'btn btn-primary btn-sm',
        'btnEliminar' => 'btn btn-danger btn-sm',
        'btnEditar' => 'btn btn-warning btn-sm',
        'btnRestaurar' => 'btn btn-success btn-sm',
        'btnReabrir' => 'btn btn-danger btn-sm',
        'btnFinalizar' => 'btn btn-success btn-sm',
        'btnFinalizarArchivo' => 'btn btn-github btn-sm',
        'btnInfo' => 'btn btn-primary btn-xs',
        'btnBuscar' => 'btn btn-success btn-sm',
        'btnLimpiar' => 'btn btn-primary btn-sm',
    ],

    'patterns' => [
        'ptsFecha' => '(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d',
        'ptsNumero' => '/[0-9]/',
    ],

    'icons' => [
        'icoSave' => 'fa fa-save',
        'icoCancel' => 'fa fa-times',
        'icoBtnNuevo' => 'fa fa-plus',
        'icoBtnEliminar' => 'fa fa-trash',
        'icoBtnEditar' => 'fa fa-edit',
        'icoBtnRestaurar' => 'fa fa-check',
        'icoBtnReabrir' => 'fa fa-external-link',
        'icoBtnFinalizar' => 'fa fa-thumbs-up text-left',
        'icoBtnPermiso' => 'fa fa-gavel',
        'icoBtnInfo' => 'fa fa-info',
        'icoBtnBuscar' => 'fa fa-search',
        'icoBtnLimpiar' => 'fa fa-times-circle-o',
    ],

    /**
     * Placeholder de los inputs de Formularios
     * */
    'pladers' => [
        /* Tareas Resolver */
        'phsDescripcion' => 'Ingresar Descripcion',
        'phsFechaInicio' => 'dd/mm/aaaa',
        'phsFechaFin' => 'dd/mm/aaaa',
        'phsHora' => 'Horas',
        'phsMinuto' => 'Minutos',
        'phsObservaciones' => 'Ingrese sus observaciones',

        /* Estado tareas */
        'phsNombre' => 'Ingrese el Nombre',

    ],

    'panels' => [
        /* Tarea Resolver */
        'pnsTareaFinalizar' => 'Finalizar: Tarea Nro.',
        'pnsTareaArchivadas' => 'Tareas Archivadas',

        /* estados tareas */
        'pnsEstadoTarea' => 'Estados Tareas',
        'pnsEliminar' => 'Eliminar',
        'pnsRestaurar' => 'Restaurar',
        'pnsEditar' => 'Editar',
        'pnsNuevo' => 'Nuevo',
        'pnsReciclados' => 'Reciclados',
        'pnsDetalle' => 'Detalle',
    ],


    'titlesForm' => [

    ],

    'titlesPage' => [
        /* Tarea Resolver*/
        'tareaFinalizar' => 'Finalizar Tarea',
        'createTarea' => 'Nueva Tarea',
        'ttlEstadoTarea' => 'Estados de Tareas', //index
        'ttlEstadoTareaRecycle' => 'Reciclados', //index
        'ttlTareasArchivadas' => 'Archivos', //index

    ],

    'titleBtns' => [
        'ttlBtnEditar' => 'Editar',
        'ttlBtnEliminar' => 'Eliminar',
    ],


    'comments' => [
        /* Tarea Resolver */
        'cmtSelecLocalizacion' => 'Por favor selecionar una Localizacion para su tarea',
        'obligatorioAttr' => 'Los campos con  (*) son obligatorios',

    ],

    'sizes' => [
        'lenMinDesc' => 5, // minimo tamaño desccripcion
        'lenMaxDesc' => 120,

    ],

    'messages' => [
        /* Nueva tarea */
        'msgDuracionCero' => 'La hora y minuto no deben ser 0',
        'msgFormatoFecha' => 'El formato de la fecha es incorrecta',
        'msgFechaFueraRango' => 'La fecha esta fuera del rango permitido',
        'msgFechaMayor' => 'La Fecha Inicio debe ser menor o igual a la Fecha Fin',
    ],

    'menus' =>[
        'mnDashboard' => 'DashBoard',
    ],
];
