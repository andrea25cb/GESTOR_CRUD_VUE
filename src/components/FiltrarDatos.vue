    <template>
        <div class="container rounded-5" id="listar">
          <h1 class="text-white"><strong>BUSCAR:</strong> </h1>
          <div class="row bg-white rounded-5" style="margin-right:330px;margin-left:350px;"><br>
            <form v-on:submit.prevent="filtrarDatos">
              Clientes entre:
              <select v-model="id1" style="width:150px" class="form-control rounded-5" id="clienteId1">
                <option v-for="cliente in clientes" :key="cliente.id" :value="cliente.id">{{cliente.id}}</option>
              </select>y
              <select v-model="id2" style="width:150px" class="form-control rounded-5" id="clienteId2">
                <option v-for="cliente in clientes" :key="cliente.id" :value="cliente.id">{{cliente.id}}</option>
              </select>
              Fechas entre
              <input class="form-control rounded-5" style="width:150px;margin-right:10px;" type="date" v-model="fecha1">
              y
              <input class="form-control rounded-5" style="width:150px;margin-right:10px;" type="date" v-model="fecha2">
              Estado:
              <select class="form-control rounded-5" style="width:150px" v-model="estado">
                <option value="">Todas</option>
                <option>cobrada</option>
                <option>acuenta</option>
                <option>liquidada</option>
                <option>anulada</option>
                <option>preanulada</option>
              </select>
              <button type="submit" class="btn btn-dark text-white">FILTRAR</button>
              <!-- <button v-on:click="filtrarDatos()" class="btn btn-dark">FILTRAR</button> -->
            </form>
          </div>
          <br>
          <h1 class="text-white"><strong>POLIZAS:</strong> </h1>
          <div class="card rounded-5">
            <table id="myTable" class="table text-center align-center" style="width:80%;margin-left:10%">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>IMPORTE</th>
                  <th>FECHA</th>
                  <th>ESTADO</th>
                  <th>OBSERVACIONES</th>
                  <th>CLIENTE</th>
                  <th>ACCIONES</th>
                </tr>
              </thead>
              <tbody>
                <tr v-if="!hayResultados">
                  <td colspan="7">No hay resultados</td>
                </tr>
                <tr v-for="poliza in datosfiltrados" :key="poliza.id" v-bind:class="{ 'sin-liquidar': poliza.estado !== 'liquidada','liquidada': poliza.estado == 'liquidada'  }">
                  <td>{{poliza.id}}</td>
                  <td>{{poliza.importe}}</td>
                  <td>{{poliza.fecha}}</td>
                  <td>{{poliza.estado}}</td>
                  <td>{{poliza.observaciones}}</td>
                  <td>{{poliza.cliente_id}}</td>
                  
                    <!-- <td>  <router-link :to="{name:'detallesCliente',params:{id:poliza.cliente_id}}" class="btn btn-warning">{{poliza.cliente_id}}</router-link></td> -->
                    <td>
                    <div class="btn-group" role="group" aria-label="">
                        <!-- para que vaya a la ruta de editar y le pase el id: -->
                    <router-link :to="{name:'editarPoliza',params:{id:poliza.id}}" class="btn btn-info">EDITAR</router-link>
                    <!-- <button v-on:click="confirmarBorrado(poliza.id)" class="btn btn-danger">BORRAR</button> -->
                    </div>
                </td>
                </tr>
            </tbody>
            </table>
        </div><br>
        </div>
        
 
</template>

<script>

// import $ from "jquery";
const Swal = require('sweetalert2');
const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
});

const estados = {
  cobrada: 'cobrada',
  acuenta: 'acuenta',
  liquidada: 'liquidada',
  anulada: 'anulada',
  preanulada: 'preanulada',
};
export default {

data(){

    return{
        clientes:[],
        polizas:[],
        id1:'',
        id2:'',
        fecha1:'',
        fecha2:'',
        estado:'',
        datosfiltrados:[],
        hayResultados:true
    }
},
    mounted() {
        this.dameclientes();
        // this.damePolizas();
        this.filtrarDatos(); 
  },
    methods:{
        async filtrarDatos() {
  const datosEnviar = {
    fecha1: this.fecha1,
    fecha2: this.fecha2,
    id1: this.id1,
    id2: this.id2,
    estado: this.estado
  };
  console.log(datosEnviar);
  try {
    const respuesta = await fetch('http://localhost/proyectovuejs/?filtrarDatos=true', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(datosEnviar)
    });
    const datosRespuesta = await respuesta.json();

    console.log(datosRespuesta);

    if (datosRespuesta.length === 0) {
      console.log('No hay datos');
      this.hayResultados = false;
      return;
    }
   this.hayResultados = true;
    this.datosfiltrados = datosRespuesta.filter(dato => {
      return this.estado === '' || dato.estado === this.estado;
    });
  } catch (error) {
    console.log(error);
  }
},
        colorSegunEstado(state) {
        console.log('Policy state ', state);
        var className = 'bg-none';
          if (!Object.keys(estados).includes(state)) return className; // default className if state is not mapped on state object
            return `bg-${state.toLowerCase()}`;
        },
        dameclientes(){
            fetch('http://localhost/proyectovuejs/?dameClientes')
            .then(respuesta=>respuesta.json())
            .then((datosRespuesta)=>{
              
                console.log(datosRespuesta)
                this.clientes = []
                if(typeof datosRespuesta[0].success==='undefined')
                {
                    this.clientes = datosRespuesta;
                }
                // this.$nextTick(function(){
                //     $('#myTable').DataTable();
                // })
            })
            .catch(console.log)
        },
        damePolizas(){
          fetch('http://localhost/proyectovuejs/?damePolizas')
            .then(respuesta=>respuesta.json())
            .then((datosRespuesta)=>{

                console.log(datosRespuesta)
                this.polizas = []
                if(typeof datosRespuesta[0].success==='undefined')
                {
                    this.polizas = datosRespuesta;
                }
            //     this.$nextTick(function(){
            //         $('#myTable').DataTable();
            //     })
             })
            .catch(console.log)
        },

        confirmarBorrado(id) {
        swalWithBootstrapButtons.fire({
            title: '¿ESTÁS SEGURO DE QUE QUIERES BORRARLO?',
            text: "¡No habrá vuelta atrás!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'SÍ, ¡BORRA!',
            cancelButtonText: 'MEJOR NO...',
            reverseButtons: true
        }).then((result) => {
        if (result.isConfirmed) {

            swalWithBootstrapButtons.fire(
                this.borrarcliente(id),
                '¡BORRADO!',
      'Tu dato ha sido borrado.',
      'success'
    )
      } else if ( /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel){
            swalWithBootstrapButtons.fire('Operación cancelada', 'Tu dato sigue a salvo.', 'info')
          }
        })
            }
}
}
</script>

<style>
.sin-liquidar {
    background-color: rgba(255, 0, 0, 0.664);
  }
  .liquidada {
    background-color: rgba(72, 255, 0, 0.664);
  }
.table th {
  text-align: center;
}

</style>