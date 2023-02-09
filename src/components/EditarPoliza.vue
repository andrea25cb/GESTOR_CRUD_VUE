<template>
    <div class="container">
        <br>
        <div class="card">
            <div class="card-header">
               EDITAR POLIZA {{ poliza.id }}
            </div>
        <div class="card-body">
           <form v-on:submit.prevent="actualizarRegistro">
            <div class="form-group">
                <label for="importe">IMPORTE</label>
                <input v-model="poliza.importe" required type="text" name="importe" class="form-control">
            
            </div>
            <div class="form-group">
                <label for="fecha">FECHA</label>
                <input v-model="poliza.fecha" required type="date" name="fecha" class="form-control">
            
            </div><br>
            <div class="form-group, selectedClass">
                <label for="estado">ESTADO</label>
                <select v-model="colorLocal" class="form-control" id="estado">
                    <option class="bg-success">cobrada</option>
                    <option class="bg-info">a cuenta</option>
                    <option class="bg-warning">liquidada</option>
                    <option class="bg-danger">anulada</option>
                    <option class="bg-primary">pre-anulada</option>
                </select>
                <div :style="{'background-color': colorLocal }">hola</div>
            </div><br>
            <div class="form-group">
                <label for="municipio">OBSERVACIONES</label>
                <input v-model="poliza.observaciones" type="text" name="observaciones" class="form-control">
            </div><br>

            <div class="form-group">
                <label for="cliente_id">CLIENTE</label>
                <select v-model="poliza.cliente_id" class="form-control" id="clientes">
                    <option v-for="cliente in clientes" :key="cliente.id" :value="cliente.id">{{cliente.nombre}}</option>
                </select>
            
            </div><br>
            <div class="btn-group" role="group" aria-label="">
                <button type="submit" class="btn btn-success">ACTUALIZAR</button>
                <router-link :to="{name:'listarPolizas'}" class="btn btn-danger">CANCELAR</router-link>
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
        poliza:{},
        colorLocal: '',
        clientes:{}
    }
},

    created:function() {
        this.obtenerID();
        this.dameClientes();
       
    },
    watch: {
  colorLocal (color) {
    this.$emit('actualizarColor', color)
  }
  },
    methods:{
      obtenerID(){
        fetch('http://localhost/proyectovuejs/?detallesPoliza='+this.$route.params.id)
            .then(respuesta=>respuesta.json())
            .then((datosRespuesta)=>{

                console.log(datosRespuesta)
                  // para que se liste solo un poliza
                this.poliza=datosRespuesta[0];
              
            })
            .catch(console.log)
      },
      actualizarRegistro(){
        //creo un objeto json:
        var datosEnviar ={importe:this.poliza.importe,fecha:this.poliza.fecha,estado:this.poliza.estado,observaciones:this.poliza.observaciones,cliente_id:this.poliza.cliente_id}
       
       
            fetch('http://localhost/proyectovuejs/?editarPoliza='+this.$route.params.id,{

                method: 'POST',
                body:JSON.stringify(datosEnviar)

            })
            .then(respuesta=>respuesta.json())
            .then(datosRespuesta=>{
                console.log(datosRespuesta);
                window.location.href = "../listarPolizas";
            })
      },
      
      dameClientes(){
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
}
}
</script>

