$(document).ready(function(){
    /* Mensajes de ALertJS */
    // var alert = new Alert('#notificacion');
    // alert.success('El Js Funciona');


    /**
     * Created by gguerrero on 19/05/2017.
     */
    new Vue({
        el: '#contenedorEv',
        data:{
            tipoVista: 0
        },
        ready: function () {
            this.$http.get('obtenerVista').then(function (response) {
                this.tipoVista = response.data;
            });
        },
        methods: {
            cambiarVista: function () {
                var vista = $('#selectVer option:selected').val();

               this.$http.post('opcionVista/'+ vista ).then(function (response) {
                   alert(response.data.tipoVista);
                   this.tipoVista = response.data.tipoVista
               });
            },
            obtenerFiltroMes: function()
            {
                var opcionMes = $('#selectOpcion option:selected').val();

                this.$http.post('filtroMes/'+ opcionMes ).then(function (response) {
                    // this.primerMes = response.data.primerMes;
                    // alert(response.data.primerMes);
                });
            },
            anteriorMes: function () {

            },
            siguienteMes: function () {

            }


        }
    });
});