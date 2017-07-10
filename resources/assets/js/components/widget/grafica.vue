<template>

</template>

<script>

     var chart;

     function MostrarChart(datosChart, categoriachart) {
         chart = c3.generate({
             bindto: "#chart_tabla",
             data: {
                 type: 'bar',
                 columns: [datosChart]
             },
             bar: {
                 width: {
                     ratio: 0.5
                 }
             },
             axis: {
                 x: {
                     type: 'category',
                     // Cargamos las categorias dela sigte forma categories:['Enero', 'Febrero',...]
                     categories: [categoriachart]
                 }
             },
             legend: {
                 position: 'right'
             }
         });
     }



     export default{
         props: {
            titulo: {type: String, required: true},
            categorias:[],
            datos:[],
         },
         data: function () {
            return {
            }
         },
         ready: function () {
             this.generarChart();

         },
         methods: {
            generarChart: function () {
                MostrarChart('hola', ' Munda');


//                chart = c3.generate({
//                    bindto: "#chart_tabla",
//                    data: {
//                        type: 'bar',
//                        columns: JSON.stringify(this.datos)
//                    },
//                    bar: {
//                        width: {
//                            ratio: 0.5
//                        }
//                    },
//                    axis: {
//                        x: {
//                            type: 'category',
//                            // Cargamos las categorias dela sigte forma categories:['Enero', 'Febrero',...]
//                            categories: JSON.stringify(this.categorias)
//                        }
//                    },
//                    legend: {
//                        position: 'right'
//                    }
//                });
            },
         }
    }


</script>
