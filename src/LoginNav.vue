<template>
  <div id="loginNav">
    <br>
    <div class="site-mobile-menu">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
            <span class="icon-close2 js-menu-toggle"></span>
        </div>
    </div>
    <div class="site-mobile-menu-body"></div>
  </div>
    <!-- <nav class="navbar navbar-expand-lg bg-dark text-uppercase fixed-top" id="mainNav">
      <div class="container">
          <a class="navbar-brand text-white" href="#page-top">GESTOR DE SEGUROS </a>
        
          <div class="collapse navbar-collapse" id="navbarResponsive">
              <ul class="navbar-nav ms-auto">
                <router-link to="/" class="nav-link text-white">HOME</router-link>
                 <router-link to="/listarClientes" class="nav-link text-white">CLIENTES</router-link> -->
                <!-- <router-link to="/listarUsuarios" class="nav-link text-white">USUARIOS</router-link>
                <router-link to="/listarPolizas" class="nav-link text-white">POLIZAS</router-link>
                <router-link to="/logout" style="float:right" class="nav-link text-white text-bg-danger rounded-5">CERRAR SESIÓN</router-link>
             </ul> 
            </div> 
      </div>
  </nav>  -->
    
    <br><br>
    <router-view/><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <footer class="text-white bg-dark fixed-bottom">
      Andrea Cordón Barrionuevo
    </footer>
  </div>
</template>

<style>
#loginNav {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  background-image: url('https://i.pinimg.com/564x/11/71/f8/1171f82f8594e8e6012f3d2ece638068.jpg');
  background-size: cover;
}

nav {
  padding: 30px;
}

nav a {
  font-weight: bold;
  color: #2c3e50;
}

nav a.router-link-exact-active {
  color: #42b983;
}

#login, #listar{ 
  background-image: url('https://i.pinimg.com/564x/30/ab/98/30ab98874d880b9a662fc77a03daec96.jpg');
}
</style>
