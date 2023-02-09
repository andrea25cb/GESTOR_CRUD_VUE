 <template>
 
  <div class="container bg-dark rounded" style="width:400px">   
    <br>
    <h1 class="text-white"><strong>REGISTER:</strong> </h1>  
    <div class="card bg-danger-subtle">

      <div class="card-body">
 
      <form @submit.prevent="">
        <div class="form-group">
          <label for="email">Email</label>
          <input v-model="email" required type="email" name="email" class="form-control">
      
      </div><br>
      <div class="form-group">
          <label for="pass">Contraseña</label>
          <input v-model="pass" required type="password" name="pass" class="form-control">
      </div><br>
      <div class="form-group">
        <label for="pass">Repetir Contraseña</label>
        <input v-model="pass" required type="password" name="pass" class="form-control">
    </div><br>
    
          <button type="submit" class="btn btn-dark">LOGIN</button>

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
            type:0, // 0 = Login , 1 = Registro 2- Recuperar contraseña
            email:"",
            password:"", 
            passwordos:""}
    },
    methods:{
        sendForm(){
            if(this.validaType()){
                console.log(this.form);
            }
        },
        validaType(){
            if(this.form.type==0 && !this.validaEmail && !this.validaPassword){
                return true;
            }
            else if(this.form.type==1 && !this.validaEmail && !this.validaRepetirPassword){
                return true;
            }
            else if(this.form.type==2 && !this.validaEmail){
                return true;
            }
            return false;
        }
    },
    computed:{
        validaEmail(){
            var exp = /^(([^<>()[\].,;:\s@"]+(\.[^<>()[\].,;:\s@"]+)*)|(".+"))@(([^<>()[\].,;:\s@"]+\.)+[^<>()[\].,;:\s@"]{2,})$/i;
            if(exp.test(this.form.email)){
                return false;
            } else{
                return true;
            }
        },
        validaPassword(){
            var exp = /^(?=.*\d)(?=.*[a-záéíóúüñ]).*[A-ZÁÉÍÓÚÜÑ]/;
            if(exp.test(this.form.password)){
                return false;
            } else{
                return true;
            }
        },
        validaRepetirPassword(){
            if(this.form.password==this.form.passwordos){
                return false;
            } else{
                return true;
            }
        },
        title(){
            return (this.form.type==0)?'Login':(this.form.type==1)?'Registro':'Recuperar contraseña';
        }
    }
}
  </script>
