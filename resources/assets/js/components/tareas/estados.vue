<template>

</template>

<script>


    export default {

        data: function(){
            return {
//                //Tarea
//                btnEliminar: 1,
            }
        },
        ready: function () {
            this.obtenerEstadoBtnEliminarTarea();
        },
        methods: {
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
