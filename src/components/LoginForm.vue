 <template>

  <div class="container bg-dark rounded-5" style="width:400px; margin-top:6%" id="login">   
    <br> <br> 
    <h1 class="text-white"><strong>LOGIN:</strong> </h1>  
    <div class="card bg-success-subtle rounded-5">

      <div class="card-body">
 
      <form @submit.prevent="login">
        <div class="form-group">
          <label for="email">Email</label>
          <input v-model="usuario.email" required type="email" name="email" class="form-control" placeholder="admin@gmail.com">
      
      </div><br>
      <div class="form-group">
          <label for="pass">Contraseña</label>
          <input v-model="usuario.pass" required type="password" name="pass" class="form-control" placeholder="1234">
      </div>
      <div v-if="error" class="error bg-danger rounded-5 text-white">CORREO O CONTRASEÑA ERRÓNEOS</div><br>
          <button type="submit" class="btn btn-dark text-white">LOGIN</button>
      </form>
    </div>
    <br>
  </div><br>
</div>

  </template>

  <script>
 export default {
  data() {
    return {
      usuario:{},
      error:false
    }
  },

    created:function() {

    },
  methods: {
    login(){
            fetch('http://localhost/proyectovuejs/?dameUsuarios')
            .then(respuesta=>respuesta.json())
            .then((datosRespuesta)=>{

                console.log(datosRespuesta)
                this.usuarios = []
                if(typeof datosRespuesta[0].success==='undefined')
                {
                    this.usuarios = datosRespuesta;
                }
                this.usuarios.forEach(usuario => {
                
              if(this.usuario.email==usuario.email && this.usuario.pass==usuario.pass){
                this.error=false;
                window.location.href="homeView"

              }else{
                this.error = true;
              }
            })
             })
             .catch(console.log)
        },
  },
};
</script>

<style>
body{
  background-image: url('https://i.pinimg.com/564x/11/71/f8/1171f82f8594e8e6012f3d2ece638068.jpg');
  background-size:100% 100%;
}
</style>