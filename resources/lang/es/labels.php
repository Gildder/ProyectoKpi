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

        /* Inincio Sesion */
        'lbsUsuario' => 'Usuario:',
        'lbsContrasenia' => 'Contraseña:',

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

        /* Inicio Sesion */
        'btnEntrar' => 'Entrar',
    ],

    'stylbtns' => [
        'btnGuardar' => 'btn btn-success',
        'btnCancelar' => 'btn btn-danger',
        'btnNuevo' => 'btn btn-primary',
        'btnEliminar' => 'btn btn-danger',
        'btnEditar' => 'btn btn-warning',
        'btnRestaurar' => 'btn btn-success',
        'btnReabrir' => 'btn btn-danger',
        'btnFinalizar' => 'btn btn-success',
        'btnFinalizarArchivo' => 'btn btn-github',
        'btnInfo' => 'btn btn-primary btn-xs',
        'btnBuscar' => 'btn btn-success',
        'btnLimpiar' => 'btn btn-primary',
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

        /* Inicio Session*/
        'phsUsuario'=> 'Usuario',
        'phsContrasenia' => 'Contraseña',

    ],

    'titlesPage' => [
        /* Tarea Resolver*/
        'tareaFinalizar' => 'Finalizar Tarea',
        'createTarea' => 'Nueva Tarea',
        'ttlEstadoTarea' => 'Estados de Tareas', //index
        'ttlEstadoTareaRecycle' => 'Reciclados', //index
        'ttlTareasArchivadas' => 'Archivos', //index

        'ttlConexionLdap' => 'Conexion LDAP',
        'ttlNuevaLdap' => 'Nueva Conexion',
        'ttlAprobaciones' => 'Aprobaciones',
        'ttlOpicioens' => 'Opciones',

        /* Aprobaciones */
        'ttlAprobacionOpciones' => 'Opciones de Aprobacion',
        /* Inicio de Session */
        'ttlInicioSesion' => 'Inicio de Session',
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



        'pnsConexionLdap' => 'Conexion LDAP',
        'pnsNuevoLdap' => 'Nueva Conexion LDAP',
        

        'pnsAprobaciones' => 'Procesos Aprobacion',
        'pnsOpciones' => 'Opciones de Aprobacion',

        'pnsAprobacionOpciones' => 'Opciones de Aprobacion',

        /*Inicio de Ssssion */
        'pnsInicioSesion' => 'Inicio de Sesiòn',
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
