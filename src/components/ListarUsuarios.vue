<template>

    <div class="container rounded-5" id="listar">  
        <br>
 
        <h1 class="text-white"><strong>USUARIOS:</strong> </h1>  
        <router-link :to="{name:'crearUsuario'}" class="btn btn-success" style="float:none">NUEVO USUARIO</router-link><br><br><br>
        <div class="card rounded-5">
        <div class="card-body">
            <table id="myTable" class="table table-striped table-bordered text-center align-center" style="width:80%;margin-left:10%">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>NOMBRE</th>
                    <th>EMAIL</th>
                    <th>PASSWORD</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="usuario in usuarios" :key="usuario.id">
                    <td>{{usuario.id}}</td>
                    <td>{{usuario.nombre}}</td>
                    <td>{{usuario.email}}</td>
                    <td>***********</td>
                    <td>  
                    <div class="btn-group" role="group" aria-label="">
                        <!-- para que vaya a la ruta de editar y le pase el id: -->
                    <router-link :to="{name:'editarUsuario',params:{id:usuario.id}}" class="btn btn-info">EDITAR</router-link>
                    <button v-on:click="confirmarBorrado(usuario.id)" class="btn btn-danger">BORRAR</button>
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
import $ from "jquery";
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
        usuarios:[],
       
    }
},

    created:function() {
        this.dameusuarios();

    },

    methods:{
        dameusuarios(){
            fetch('http://localhost/proyectovuejs/?dameUsuarios')
            .then(respuesta=>respuesta.json())
            .then((datosRespuesta)=>{

                console.log(datosRespuesta)
                this.usuarios = []
                if(typeof datosRespuesta[0].success==='undefined')
                {
                    this.usuarios = datosRespuesta;
                }
                this.$nextTick(function(){
                    $('#myTable').DataTable();
                })
            })
            .catch(console.log)
        },
       
        borrarusuario(id){
           console.log(id);
           //'borrar' es un metodo php que esta dentro de la carpeta usuarios!!
           fetch('http://localhost/proyectovuejs/?borrarUsuario='+id)
            .then(respuesta=>respuesta.json())
            .then((datosRespuesta)=>{

                console.log(datosRespuesta)
                window.location.href="listarUsuarios"
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
}
</style>