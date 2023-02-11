<template>
  <div id="app">
    <nav v-if="!$route.meta.hideNavbar" class="navbar navbar-expand-lg bg-dark text-uppercase fixed-top">
      <div class="container">

          <div class="container d-flex align-items-center flex-column">
              <a class="mx-0 mx-lg-1" href="/homeView"><img width="50px" src="https://images.vexels.com/media/users/3/132714/isolated/preview/74d58196411ca35175184c3436cb31fc-witch-cat-face.png"></a>
          </div>
          <div class="container d-flex align-items-center flex-column">
              <button class="navbar-toggler text-uppercase font-weight-bold bg-black text-white rounded" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                          Home
                          <i class="fas fa-bars"></i>
                      </button></div>
          <div class="collapse navbar-collapse text-white text-center align-items-center" id="navbarResponsive">
              <ul class="navbar-nav ms-auto text-white ">
                  <li type="button" class="nav-item mx-0 mx-lg-1 text-white rounded"><router-link to="/listarClientes" class="nav-link py-3 px-0 px-lg-3 rounded text-white">CLIENTES</router-link></li>
                  <li type="button" class=" nav-item mx-0 mx-lg-1 text-white rounded"><router-link to="/listarUsuarios" class="nav-link py-3 px-0 px-lg-3 rounded text-white">USUARIOS</router-link></li>
                  <li type="button" class="nav-item mx-0 mx-lg-1 text-white rounded"><router-link to="/listarPolizas" class="nav-link py-3 px-0 px-lg-3 rounded text-white">POLIZAS</router-link></li>
                  <li type="button" class="nav-item mx-0 mx-lg-1 text-white rounded"><router-link to="/" class="nav-link py-3 px-0 px-lg-3 rounded-5 bg-danger text-white">LOGOUT</router-link></li>
              </ul>
          </div>
      </div>
  </nav>
   
    <router-view/><br><br><br><br><br><br><br><br><br>
    <div class="bg-dark fixed-bottom text-white text-center align-items-center"> Andrea Cordón Barrionuevo</div>
  </div>
</template>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  
}

body{
  background-image: url('https://i.pinimg.com/564x/11/71/f8/1171f82f8594e8e6012f3d2ece638068.jpg');
  background-size:100% 100%;
}

nav { 
overflow:hidden;
transition: 1s all; 
}

nav a {
  font-weight: bold;
  
}

nav a.router-link-exact-active {
  color: #42b983;
}

#login, #listar{
  background-image: url('https://i.pinimg.com/564x/f0/2a/0a/f02a0aae53793aac368a6344ba31f773.jpg');
  background-size: cover;
}
</style>
