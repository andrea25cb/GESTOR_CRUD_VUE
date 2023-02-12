<template>

    <div class="container rounded-5" id="listar">
        <br>
        <input type="text" class="form-control" v-model="search" placeholder="BUSCAR POLIZA POR SU ID" style="float:right">
 <br>
        <h1 class="text-white"><strong>POLIZAS:</strong> </h1>
        <router-link :to="{name:'crearPoliza'}" class="btn btn-success" style="float:none">NUEVA POLIZA</router-link><br><br><br>
        <div class="card rounded-5">

        <div class="card-body">
      
            <table class="table">
              
                <thead>
                <tr>
                  <datatable-header
                  v-for="(headColumn, i) in normalizedColumns"
                  :key="i"
                  :column="headColumn"
                  :direction="getSortDirectionForColumn(headColumn)"
                  @change="setSortDirectionForColumn" />
                    <th>ID</th>
                    <th>IMPORTE</th>
                    <th>FECHA</th>
                    <th>ESTADO</th>
                    <th>OBSERVACIONES</th>
                    <th>CLIENTE</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="poliza in filteredData" :key="poliza.id"  :class="colorSegunEstado(poliza.estado)">
                    <td>{{poliza.id}}</td>
                    <td>{{poliza.importe}}</td>
                    <td>{{poliza.fecha}}</td>
                    <td>{{poliza.estado}}</td>
                    <td>{{poliza.observaciones}}</td>
                    <td>  <router-link :to="{name:'detallesCliente',params:{id:poliza.cliente_id}}" class="btn btn-warning">{{poliza.cliente_id}}</router-link></td>
                    <td>
                    <div class="btn-group" role="group" aria-label="">
                        <!-- para que vaya a la ruta de editar y le pase el id: -->
                    <router-link :to="{name:'editarPoliza',params:{id:poliza.id}}" class="btn btn-info">EDITAR</router-link>
                    <button v-on:click="confirmarBorrado(poliza.id)" class="btn btn-danger">BORRAR</button>
                    </div>
                </td>
                </tr>
            </tbody>
            </table>
            </div>
            </div><br>
        </div>

</template>

<script>
const Swal = require('sweetalert2')
const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
});

const estados = {
  cobrada: 'cobrada',
  acuenta: 'a cuenta',
  liquidada: 'liquidada',
  anulada: 'anulada',
  preanulada: 'preanulada',
};
export default {

data(){

    return{
        polizas:[],
        // colorSeleccionado:'',
        search: ''
    }
},

    created:function() {
        this.damePolizas();
        // this.actualizarColor();

    },
    computed: {
        filteredData() {
        return this.polizas.filter(poliza => (poliza.id).includes(this.search.toLowerCase()));

        },
    },
    methods:{
        colorSegunEstado(state) {
        console.log('Policy state ', state);
        var className = 'bg-none';
          if (!Object.keys(estados).includes(state)) return className; // default className if state is not mapped on state object
            return `bg-${state.toLowerCase()}`;
        },

        damePolizas(){
            fetch('http://localhost/proyectovuejs/?damePolizas')
            .then(respuesta=>respuesta.json())
            .then((datosRespuesta)=>{

                console.log(datosRespuesta)
                this.polizas = []
                if(typeof datosRespuesta[0].success==='undefined')
                {
                    this.polizas = datosRespuesta;
                }
            })
            .catch(console.log)
        },

        borrarpoliza(id){
           console.log(id);
           //'borrar' es un metodo php que esta dentro de la carpeta polizas!!
           fetch('http://localhost/proyectovuejs/?borrarPoliza='+id)
            .then(respuesta=>respuesta.json())
            .then((datosRespuesta)=>{

                console.log(datosRespuesta)

            })
            .catch(console.log)
        },
        confirmarBorrado(id) {
        swalWithBootstrapButtons.fire({
          title: '¿ESTÁS SEGURO DE QUE QUIERES BORRARLO?',
            text: "¡No habrá vuelta atrás!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'SÍ, ¡BORRA!',
            cancelButtonText: 'MEJOR NO...',
            reverseButtons: true
        }).then((result) => {
  if (result.isConfirmed) {

    swalWithBootstrapButtons.fire(
        this.borrarpoliza(id),
      '¡BORRADO!',
      'Tu dato ha sido borrado.',
      'success'
    )
      } else if ( /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel){
            swalWithBootstrapButtons.fire('Operación cancelada', 'Tu dato sigue a salvo.', 'info')
          }
        })
      }
    }
  }
  
</script>
<!-- CREO UNA CLASE NUEVA PARA CADA ESTADO -->
<style>
.table th {
  text-align: center;
}
.table .bg-none {
  background-color: lightgray;
}
.table .bg-cobrada {
  background-color: rgb(255, 174, 25);
  opacity: 0.8;
}

.table .bg-acuenta {
  background-color: rgb(96, 240, 96);
  opacity: 0.8;
}
.table .bg-liquidada {
  background-color: rgb(140, 0, 255);
  opacity: 0.8;
}
.table .bg-anulada {
  background-color: rgb(255, 38, 0);
  opacity: 0.8;
}
.table .bg-preanulada {
  background-color: rgb(255, 71, 240);
  opacity: 0.8;
}
</style>