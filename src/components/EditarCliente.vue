<template>
    <div class="container">
        <br>
        <div class="card-body">
            <form v-on:submit.prevent="actualizarRegistro">
             <div class="form-group">
                 <label for="nombre">Nombre</label>
                 <input v-model="cliente.nombre" required type="text" name="nombre" class="form-control">
             </div>
 
             <div class="form-group">
                 <label for="nombre">Apellidos</label>
                 <input v-model="cliente.apellidos" required type="text" name="nombre" class="form-control">
             </div>
 
             <div class="form-group">
                 <label for="nombre">TLF</label>
                 <input v-model="cliente.tlf" required type="text" name="tlf" class="form-control">
             </div>
 
             <div class="form-group">
                 <label for="nombre">Tipo</label>
                 <select v-model="cliente.tipo" class="form-control" id="tipo">
                     <option>particular</option>
                     <option>empresa</option>
                 </select>   
             </div>
 
                 <div class="form-group">
                     <label for="nombre">CP</label>
                     <input v-model="cliente.cp" required type="text" name="cp" class="form-control">
                 </div>
            
                 <div class="form-group">
                    <label for="provincia">Provincia</label>
                    <select v-model="cliente.provincia" @change="provinciaSeleccionada(cliente.provincia), provIsSelected=true, dameMunicipios(cliente.provincia)" class="form-control" id="provincias">
                        <option v-for="provincia in provincias" :key="provincia.id" :value="provincia.id">{{provincia.provincia}}</option>
                    </select>
                
                </div><br>
                <div v-if="provIsSelected" class="form-group">
                    <label for="municipio">Municipio</label>
                    <select v-model="cliente.municipio" class="form-control" id="municipios">
                        <option v-for="municipio in municipios" :key="municipio.id" :value="municipio.municipio">{{municipio.municipio}}</option>
                    </select>
                </div><br>
             <div class="btn-group" role="group" aria-label="">
                 <button type="submit" class="btn btn-success">AGREGAR</button>
                 <router-link :to="{name:'listarClientes'}" class="btn btn-danger">CANCELAR</router-link>
             </div>
           </form>
            </div>
        </div>

</template>

<script>
export default {
data(){

    return{
        cliente:{},
        provincias:{},
        municipios:{},
        codProvinciaSelected: '',
        provIsSelected: false,
    }
},

    created:function() {
        this.obtenerID();
        this.dameProvincias();
    },
    methods:{
      obtenerID(){
        fetch('http://localhost/proyectovuejs/?detallesCliente='+this.$route.params.id)
            .then(respuesta=>respuesta.json())
            .then((datosRespuesta)=>{

                console.log(datosRespuesta)
                  // para que se liste solo un cliente
                this.cliente=datosRespuesta[0];
              
            })
            .catch(console.log)
      },
      actualizarRegistro(){
        //creo un objeto json:
        var datosEnviar ={nombre:this.cliente.nombre,apellidos:this.cliente.apellidos,tlf:this.cliente.tlf,cp:this.cliente.cp,provincia:this.cliente.provincia,municipio:this.cliente.municipio,tipo:this.cliente.tipo}
       
       
            fetch('http://localhost/proyectovuejs/?editarCliente='+this.$route.params.id,{

                method: 'POST',
                body:JSON.stringify(datosEnviar)

            })
            .then(respuesta=>respuesta.json())
            .then(datosRespuesta=>{
                console.log(datosRespuesta);
                window.location.href = "../listarClientes";
            })
      },

      dameProvincias(){
        fetch('http://localhost/proyectovuejs/?dameProvincias')
        .then(respuesta=>respuesta.json())
            .then((datosRespuesta)=>{

                console.log(datosRespuesta)
                this.provincias = []
                if(typeof datosRespuesta[0].success==='undefined')
                {
                    this.provincias = datosRespuesta;
                }
              
            })
            .catch(console.log)
      },
      provinciaSeleccionada(cod) {
        this.codProvinciaSelected = cod;
        console.log(this.codProvinciaSelected);
        },
        
      //segun la provincia que seleccione, salen unos municipios u otros
      dameMunicipios(cod){
        fetch('http://localhost/proyectovuejs/?dameMunicipios='+cod)       
        .then(respuesta=>respuesta.json())
            .then((datosRespuesta)=>{

                console.log(datosRespuesta)
                this.municipios = []
                if(typeof datosRespuesta[0].success==='undefined')
                {
                    this.municipios = datosRespuesta;
                }
            })
            .catch(console.log)
      },
}
}
</script>

