<template>
    <li class="col-sm-12" style="list-style:none; font-size:12px;">

        <div class="col-xs-12 col-sm-12" style="border-bottom: 1px outset darkgray; margin-bottom: 8px;">

            <div style="display: inline-block; ">
                <div style="display: inline-block; ">
                    <span class="fa fa-pie-chart"></span>
                    <strong>{{ titulo }}</strong><br>
                </div>
                <p style="font-style: italic; font-size: small;"> {{ descripcion }}</p>
            </div>

            <div style="display: inline-block; float: right; margin-bottom: 10px;">
                <!--data-toggle="modal"-->

                <button class="btn btn-primary btn-xs"
                     @click="mostrarModal($event)" >
                     Agregar</button>
            </div>
        </div>

    </li>
</template>

<script>


    export default {
        props:{
            id:{type:Number, required:true },
            titulo:{type:String, required:true },
            descripcion:{type:String, required:true },
        },
        methods: {
            mostrarModal: function ($event) {
                $event.preventDefault();

                let modelo =  $('#modal-nuevo-widget-' + this.id);
                modelo.modal('show');
            }
        }

    }
</script>
