<template>

    <div class="container rounded-5" id="listar">   
      
        <h1 class="text-white"><strong>CLIENTES:</strong> </h1> 
        <br> 
        <router-link :to="{name:'crearCliente'}" class="btn btn-success" style="float:none">NUEVO CLIENTE</router-link><br><br><br>
        <div class="card rounded-5">
     
            <table id="myTable" class="table table-striped table-bordered text-center align-center" style="width:80%;margin-left:10%">
               
                <thead>
                <tr>
                    <th>ID</th>
                    <th>NOMBRE</th>
                    <th>APELLIDOS</th>
                    <th>TLF</th>
                    <th>MUNICIPIO</th>
                    <th>TIPO</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="cliente in clientes" :key="cliente.id">
                    <td>{{cliente.id}}</td>
                    <td>{{cliente.nombre}}</td>
                    <td>{{cliente.apellidos}}</td>
                    <td>{{cliente.tlf}}</td>
                    <td>{{cliente.municipio}}</td>
                    <td>{{cliente.tipo}}</td>
                   
                    <td>  
                    <div class="btn-group" role="group" aria-label="">
                     
                    <router-link :to="{name:'editarCliente',params:{id:cliente.id}}" class="btn btn-info">EDITAR</router-link>
                    <router-link :to="{name:'detallesCliente',params:{id:cliente.id}}" class="btn btn-warning">DETALLES</router-link>
                    <button v-on:click="confirmarBorrado(cliente.id)" class="btn btn-danger">BORRAR</button>
                    </div>
                </td>
                </tr>   
            </tbody>
            </table>
        </div><br>
        </div>
 
</template>

<script>

import $ from "jquery";
const Swal = require('sweetalert2');
const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
});

export default {

data(){

    return{
        clientes:[],
        id1:'',
        id2:''
    }
},
    mounted() {
        this.dameclientes();
        
  },
    methods:{
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
                this.$nextTick(function(){
                    $('#myTable').DataTable();
                })
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
                this.borrarcliente(id),
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

<style>
.table th {
  text-align: center;
}</style>
