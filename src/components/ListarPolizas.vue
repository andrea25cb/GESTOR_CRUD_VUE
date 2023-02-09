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
                <tr v-bind:class="{'background-color': colorSeleccionado }" v-for="poliza in filteredData" :key="poliza.id">
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
const Swal = require('sweetalert2');
const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
})
export default {

data(){

    return{
        polizas:[],
        colorSeleccionado:'',
        search: ''
    }
},

    created:function() {
        this.damePolizas();
        this.actualizarColor

    },
    computed: {
        filteredData() {
        return this.polizas.filter(poliza => (poliza.id).includes(this.search.toLowerCase()));
        
        },
    },
    methods:{
  
        actualizarColor (color) {
            console.log(color);
    this.colorSeleccionado = color
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
                window.location.href="listarPolizas"
            })
            .catch(console.log)
        },
        confirmarBorrado(id) {
        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
  if (result.isConfirmed) {

    swalWithBootstrapButtons.fire(
        this.borrarpoliza(id),
      'Deleted!',
      'Your file has been deleted.',
      'success'
    )
      } else if ( /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel){
            swalWithBootstrapButtons.fire('Cancelled', 'Your file is still intact', 'info')
          }
        })
      }
    }
  }
</script>