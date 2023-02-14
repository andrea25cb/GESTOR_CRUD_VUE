<template>
    <div class="container bg-dark rounded text-white" id="login">  
        <br>
      <h1 class="text-white"><strong>DETALLES DE: {{cliente.nombre}}</strong> </h1>  

        <div class="card">
     
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>NOMBRE</th>
                    <th>APELLIDOS</th>
                    <th>TLF</th>
                    <th>MUNICIPIO</th>
                    <th>CP</th>
                    <th>PROVINCIA</th>
                    <th>TIPO</th>
                </tr>
            </thead>
            <tbody>
                <tr >
                    <td>{{cliente.id}}</td>
                    <td>{{cliente.nombre}}</td>
                    <td>{{cliente.apellidos}}</td>
                    <td>{{cliente.tlf}}</td>
                    <td>{{cliente.municipio}}</td>
                    <td>{{cliente.cp}}</td>
                    <td>{{cliente.provincia}}</td>
                    <td>{{cliente.tipo}}</td>
                </tr>   
            </tbody>

        </table>
             
        </div><br> 
    </div>
       <br>     <h1 class="text-white"><strong>SUS POLIZAS</strong> </h1>  
    <div class="card">
        <router-link :to="{name:'crearPoliza'}" class="btn btn-success" style="float:none">NUEVA POLIZA</router-link>
       <div class="card-body">
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>IMPORTE</th>
                <th>FECHA</th>
                <th>ESTADO</th>
                <th>OBSERVACIONES</th>
                <th>ACCIONES</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="poliza in polizas" :key="poliza.id"  :class="colorSegunEstado(poliza.estado)">
                <td>{{poliza.id}}</td>
                <td>{{poliza.importe}}</td>
                <td>{{poliza.fecha}}</td>
                <td>{{poliza.estado}}</td>
                <td>{{poliza.observaciones}}</td>
                <td>  
                <div class="btn-group" role="group" aria-label="">
                    <!-- para que vaya a la ruta de editar y le pase el id: -->
                <router-link :to="{name:'editarPoliza',params:{id:poliza.id}}" class="btn btn-info">EDITAR</router-link>
                <button v-on:click="confirmarBorrado(poliza.id)" class="btn btn-danger">BORRAR</button>
                </div>
            </td>
            </tr>   
        </tbody>
        </table>
        <div class="btn-group" role="group" aria-label="">
           
            <router-link :to="{name:'listarPolizas'}" class="btn btn-info">VOLVER</router-link>
        </div>
        </div>
    </div><br>
</div>
</template>

<script>
const estados = {
  cobrada: 'cobrada',
  acuenta: 'a cuenta',
  liquidada: 'liquidada',
  anulada: 'anulada',
  preanulada: 'preanulada',
};
export default {
    
data(){

    return{
        cliente:{},
        polizas:[],
    }
},

    created:function() {
        this.detalles();    
        this.damePolizasCliente();

},
    methods:{
        colorSegunEstado(state) {
        console.log('Policy state ', state);
        var className = 'bg-none';
          if (!Object.keys(estados).includes(state)) return className; // default className if state is not mapped on state object
            return `bg-${state.toLowerCase()}`;
        },
      detalles(){
        fetch('http://localhost/proyectovuejs/?detallesCliente='+this.$route.params.id)
            .then(respuesta=>respuesta.json())
            .then((datosRespuesta)=>{

                console.log(datosRespuesta)
            
                this.cliente=datosRespuesta[0];
              
            })
            .catch(console.log)
      },

      damePolizasCliente(){
            fetch('http://localhost/proyectovuejs/?damePolizasCliente='+this.$route.params.id)
            .then(respuesta=>respuesta.json())
            .then((datosRespuesta)=>{

                console.log(datosRespuesta)
                this.polizas = []
                if(typeof datosRespuesta[0].success==='undefined')
                {
                    this.polizas = datosRespuesta;
                }
            })
            .catch(console.log)
        },
}
}
</script>

<!-- CREO UNA CLASE NUEVA PARA CADA ESTADO -->
<style>
.table th {
  text-align: center;
}
.table .bg-none {
  background-color: lightgray;
}
.table .bg-cobrada {
  background-color: rgb(255, 174, 25);
  opacity: 0.8;
}

.table .bg-acuenta {
  background-color: rgb(96, 240, 96);
  opacity: 0.8;
}
.table .bg-liquidada {
  background-color: rgb(140, 0, 255);
  opacity: 0.8;
}
.table .bg-anulada {
  background-color: rgb(255, 38, 0);
  opacity: 0.8;
}
.table .bg-preanulada {
  background-color: rgb(255, 71, 240);
  opacity: 0.8;
}
</style>