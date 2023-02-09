<template>
    <div class="container">
        <br>
        <div class="card">
            <div class="card-header">
               EDITAR USUARIO {{ usuario.id }}
            </div>
        <div class="card-body">
           <form v-on:submit.prevent="actualizarRegistro">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input v-model="usuario.nombre" required type="text" name="nombre" class="form-control">
            </div>
            
            <div class="form-group">
                <label for="email">Correo</label>
                <input v-model="usuario.email" required type="email" name="email" class="form-control">
            </div><br>
            <div class="form-group">
                <label for="pass">Contraseña</label>
                <input v-model="usuario.pass" required type="password" name="pass" class="form-control">
            </div><br>

            <div class="btn-group" role="group" aria-label="">
                <button type="submit" class="btn btn-success">AGREGAR</button>
                <router-link :to="{name:'listarUsuarios'}" class="btn btn-danger">CANCELAR</router-link>
            </div>
           </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
data(){

    return{
        usuario:{},
    }
},

    created:function() {
        this.obtenerID();
    },
    methods:{
      obtenerID(){
        fetch('http://localhost/proyectovuejs/?detallesUsuario='+this.$route.params.id)
            .then(respuesta=>respuesta.json())
            .then((datosRespuesta)=>{

                console.log(datosRespuesta)
                  // para que se liste solo un usuario
                this.usuario=datosRespuesta[0];
              
            })
            .catch(console.log)
      },
      actualizarRegistro(){
        //creo un objeto json:
            var datosEnviar ={id:this.$route.params.id,nombre:this.usuario.nombre,email:this.usuario.email,pass:this.usuario.pass}
       
            fetch('http://localhost/proyectovuejs/?editarUsuario='+this.$route.params.id,{

                method: 'POST',
                body:JSON.stringify(datosEnviar)

            })
            .then(respuesta=>respuesta.json())
            .then(datosRespuesta=>{
                console.log(datosRespuesta);
                window.location.href = "../listar";
            })
      },
}
}
</script>

