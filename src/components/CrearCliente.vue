<template>
    <div class="container rounded-5 " id="login">  
        <br>
      <h1 class="text-white"><strong>CREAR CLIENTE</strong> </h1>  

        <div class="card rounded-5">
     
        <div class="card-body">
           <form v-on:submit.prevent="agregarRegistro">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input v-model="cliente.nombre"  type="text" name="nombre" class="form-control" required>
            </div>
            <br>
            <div class="form-group">
                <label for="nombre">Apellidos</label>
                <input v-model="cliente.apellidos" required type="text" name="nombre" class="form-control">
            </div>
            <br>
            <div class="form-group">
                <label for="nombre">TLF</label>
                <input v-model="cliente.tlf" required type="number" name="tlf" class="form-control">
            </div>
            <br>
            <div class="form-group">
                <label for="nombre">Tipo</label>
                <select v-model="cliente.tipo" class="form-control" id="tipo">
                    <option>particular</option>
                    <option>empresa</option>
                </select>   
            </div>
            <br>
                <div class="form-group">
                    <label for="nombre">CP</label>
                    <input v-model="cliente.cp" required type="number" name="cp" class="form-control">
                </div>
                <br>
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
        </div><br>
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
        this.agregarRegistro();
        this.dameProvincias();
     
    },
    methods:{
        
        agregarRegistro(){
            console.log(this.cliente);

            var datosEnviar ={nombre:this.cliente.nombre,apellidos:this.cliente.apellidos,tlf:this.cliente.tlf,cp:this.cliente.cp,provincia:this.cliente.provincia,municipio:this.cliente.provincia,tipo:this.cliente.tipo}
       
            fetch('http://localhost/proyectovuejs/?insertarCliente=1',{

                method: 'POST',
                body:JSON.stringify(datosEnviar)

            })
            .then(respuesta=>respuesta.json())
            .then(datosRespuesta=>{
                console.log(datosRespuesta);
                window.location.href = "listarClientes";
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

