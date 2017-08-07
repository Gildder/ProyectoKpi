<template>
    <div class="table-responsive col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
        <div id="chart_Eficacia"></div>
    </div>
    <div class="table-responsive col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
        <table id="myTable1" class="table table-bordered table-hover table-response">
            <thead>
            <tr>
                <th>Nro</th>
                <th>Mes</th>
                <th>Semana</th>
                <th>Actividades Programadas</th>
                <th>Actividades Realizadas</th>
                <th>Eficacia</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="item in tabla">
                <td>{{$contador++ }}</td>
                <td class="m-{{item.mes}}">{{ item.mes) }}</td>
                <td >Semana {{item.semana}}</td>
                <td>{{item.actpro}}</td>
                <td>{{item.actrea}}</td>
                <td><span class="{{item.semana}}"> {{item.efeser}}%</span></td>
            </tr>
            </tbody>
        </table>
    </div>
</template>



<script>
    export default {
        props:[
            'indicador_id',
            'user_id'
        ],
        data: function () {
            return {

            };
        },
        ready: function () {
//            this.jxObtenerDatos();
        },
        methods: {
            jxObtenerDatos: function ($event) {
                $event.preventDefault();

             ;
            }
        }

    }
</script>
