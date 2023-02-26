<template>
    <div class="container rounded-5" id="login">  
        <br>
      <h1 class="text-white"><strong>CREAR USUARIO</strong> </h1>  

        <div class="card rounded-5">
     
        <div class="card-body">
           <form v-on:submit.prevent="agregarRegistro">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input v-model="usuario.nombre" required type="text" name="nombre" class="form-control">
            
            </div><br>
            <div class="form-group">
                <label for="email">Email</label>
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
        </div><br>
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
        this.agregarRegistro();

    },
    methods:{
        
        agregarRegistro(){
            console.log(this.usuario);

            var datosEnviar ={nombre:this.usuario.nombre,email:this.usuario.email,pass:this.usuario.pass}
       
            fetch('php/?insertarUsuario=1',{

                method: 'POST',
                body:JSON.stringify(datosEnviar)

            })
            .then(respuesta=>respuesta.json())
            .then(datosRespuesta=>{
                console.log(datosRespuesta);
                window.location.href = "listarUsuarios";
            })
        },
}
}
</script>

