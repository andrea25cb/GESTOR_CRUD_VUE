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
        <table class="table table-striped">
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
            <tr v-for="poliza in polizas" :key="poliza.id">
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
        </div>
    </div><br>
</div>
</template>

<script>
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

