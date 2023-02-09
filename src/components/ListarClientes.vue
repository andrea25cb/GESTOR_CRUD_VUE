<template>

    <div class="container rounded-5" id="listar">   
        <br>
        <input type="text" class="form-control" v-model="search" placeholder="BUSCAR CLIENTE" style="float:right">
 <br>
        <h1 class="text-white"><strong>CLIENTES:</strong> </h1>  
        <router-link :to="{name:'crearCliente'}" class="btn btn-success" style="float:none">NUEVO CLIENTE</router-link><br><br><br>
        <div class="card rounded-5">
     
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>NOMBRE</th>
                    <th>APELLIDOS</th>
                    <th>TLF</th>
                    <th>MUNICIPIO</th>
                    <th>CP</th>
                    <th>PROVINCIA</th>
                    <th>TIPO</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="cliente in filteredData" :key="cliente.id">
                    <td>{{cliente.id}}</td>
                    <td>{{cliente.nombre}}</td>
                    <td>{{cliente.apellidos}}</td>
                    <td>{{cliente.tlf}}</td>
                    <td>{{cliente.municipio}}</td>
                    <td>{{cliente.cp}}</td>
                    <td>{{cliente.provincia}}</td>
                    <td>{{cliente.tipo}}</td>
                   
                    <td>  
                    <div class="btn-group" role="group" aria-label="">
                        <!-- para que vaya a la ruta de editar y le pase el id: -->
                    <router-link :to="{name:'editarCliente',params:{id:cliente.id}}" class="btn btn-info">EDITAR</router-link>
                    <router-link :to="{name:'detallesCliente',params:{id:cliente.id}}" class="btn btn-warning">DETALLES</router-link>
                    <button v-on:click="confirmarBorrado(cliente.id)" class="btn btn-danger">BORRAR</button>
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
        clientes:[],
        search: ''
    }
},

    created:function() {
        this.dameclientes();

    },
    computed: {
        filteredData() {
        return this.clientes.filter(cliente => (cliente.nombre).includes(this.search.toLowerCase()));
        
        },
    },
    methods:{
        //
        dameclientes(){
            fetch('http://localhost/proyectovuejs/?dameClientes')
            .then(respuesta=>respuesta.json())
            .then((datosRespuesta)=>{

                console.log(datosRespuesta)
                this.clientes = []
                if(typeof datosRespuesta[0].success==='undefined')
                {
                    this.clientes = datosRespuesta;
                }
            })
            .catch(console.log)
        },

        borrarcliente(id){
           console.log(id);
           //'borrar' es un metodo php que esta dentro de la carpeta clientes!!
           fetch('http://localhost/proyectovuejs/?borrarCliente='+id)
            .then(respuesta=>respuesta.json())
            .then((datosRespuesta)=>{

                console.log(datosRespuesta)
                window.location.href="listarClientes"
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
        this.borrarcliente(id),
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

