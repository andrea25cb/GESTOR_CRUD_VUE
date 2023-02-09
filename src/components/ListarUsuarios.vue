<template>

    <div class="container rounded-5" id="listar">  
        <br>
        <input type="text" class="form-control" v-model="search" placeholder="BUSCAR USUARIO POR SU NOMBRE" style="float:right">
 <br>
        <h1 class="text-white"><strong>USUARIOS:</strong> </h1>  
        <router-link :to="{name:'crearUsuario'}" class="btn btn-success" style="float:none">NUEVO USUARIO</router-link><br><br><br>
        <div class="card rounded-5">
        <div class="card-body">
            <table class="table table-striped">
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
                <tr v-for="usuario in filteredData" :key="usuario.id">
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
        search: ""
    }
},

    created:function() {
        this.dameusuarios();

    },
    computed: {
        filteredData() {
        return this.usuarios.filter(usuarios => (usuarios.nombre).includes(this.search.toLowerCase()));
        },
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

