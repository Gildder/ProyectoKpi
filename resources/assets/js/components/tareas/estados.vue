<template>

</template>

<script>


    export default {
        props: [ // 0: listado, 1:archivas, 2:eliminadas
            'modelo'
        ],
        data: function(){
            return {
//                //Tarea
//                btnEliminar: 1,
            }
        },
        ready: function () {
            this.opcionModeloTarea(this.modelo);
        },
        methods: {
            opcionModeloTarea: function(opcion) {
                if(opcion == 0){
                    this.$parent.btnResultado = 1;
                    this.$parent.btnEditar = 1;
                    this.obtenerEstadoBtnEliminarTarea();
                }else{
                    this.$parent.btnResultado = 0;
                    this.$parent.btnEditar = 0;
                    this.$parent.btnEliminar = 0;
                }
            },
            obtenerEstadoBtnEliminarTarea: function () {
                // verificar si se puede eliminar una tarea
                $.ajax({
                    url: window.location.pathname+'/obtenerEstadoBtnEliminarTarea',
                    method: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        this.$parent.btnEliminar = data;

                    }.bind(this), error: function (data) {
                        console.log('Error: Al intentar obtener opcion de boton elimnar.');
                    }.bind(this)
                })
            },
        }

    }
</script>
