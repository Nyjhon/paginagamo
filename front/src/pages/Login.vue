<template>
<q-layout view="hHr LpR lFf" class="background-image">
    <div class="wrapper">
        <div id="formContent">
            <!-- Tabs Titles -->
             <div class="row">
                <div class="col-12">
                  <img  class ='imagen fadeIn first' src="img/gamo.png" id="icon" alt="User Icon" />
                </div>
             </div>
            <div class="row">
                <div class="col-12">
                  <h2 class="texth2 fadeIn first" >ADMINISTRACIÓN DE LA PAGINA WEB G.A.M.O.</h2>
                </div>
            </div>
            <q-form @submit.prevent="login">
              <!-- Login Form -->
                  <q-input id="login" class=" edit1 fadeIn first" name="login" placeholder="Correo" v-model="email" type="email"/>
                  <q-input :type="typePassword?'password':'text'" id="password" class=" edit1 fadeIn first" name="login" placeholder="Contraseña" v-model="password" required>
                  <template v-slot:append>
                      <q-icon @click="typePassword=!typePassword" :name="typePassword?'visibility':'visibility_off'" />
                  </template>
                  </q-input>
              <q-btn type="submit" class="boton1 fadeIn first" label="INGRESAR" />
            </q-form>
        </div>
    </div>
</q-layout>   
</template>
<script>
import {globalStore} from 'stores/globalStore'
  export default {
    name: 'LoginPage',
    data () {
      return {
        email:'',
        usuario: {},
        TypePassword: true,
        name: '',
        password: '',
        remember: false,
        typePassword: true,
        loading: false,
        store:globalStore()
      }
    },
    mounted () {
      if (this.store.isLoggedIn) {
        this.$router.push('/login')
      }
    }, 
    methods: {
      login () {
        this.loading = true
        this.$api.post('login', {
          email: this.email,
          password: this.password
        }).then(res => {
          this.$q.notify({
            message: 'Bienvenido',
            color: 'positive',
            icon: 'check_circle',
            position: 'top'
          })
          this.store.user = res.data.user
          this.store.isLoggedIn = true
          this.$api.defaults.headers.common.Authorization = 'Bearer ' + res.data.token
          localStorage.setItem('token', res.data.token)
          this.$router.push('/inicio/adm')
        }).catch(error => {
          this.$q.notify({
            message: error.response.data.message,
            color: 'negative',
            position: 'top',
            timeout: 2000
          })
        }).finally(() => {
          this.loading = false
        })
      }
    }
}
</script>
<style>
@import url('https://fonts.googleapis.com/css?family=Poppins');

/* BASIC */
.background-image {
  background-image: url('/fondo.jpg');
  background-size: cover;
  background-position: center;
  height: 100%; /* Para que ocupe toda la altura de la pantalla */
  width: 100%;
}
body {
  font-family: "Poppins", sans-serif;
  height: 100vh;
}

a {
  color: #92badd;
  display:inline-block;
  text-decoration: none;
  font-weight: 400;
}
.text-bottom {
  color: #ffffff;
  font-size: 15px;
  font-weight: bold;
  text-align: center;
  padding: 0px 5px 5px 5px;
  margin-top: -20px;
  margin-left: 20px;
  margin-right: 20px;
  text-transform: uppercase;
}
.bottom-yellow {
  color: #2C3E50 ;
}
.texth2 {
  text-align: center;
  font-size: 16px;
  font-weight: bold;
  text-transform: uppercase;
  display:inline-block;
  margin: 0px 8px 10px 8px;
  line-height:40px;
  font-family: 'Times New Roman', sans-serif;
  color: #2C3E50 ;
}

.imagen {
    width: 30%;
}

.registro-link {
  display: inline-block;
  margin-top: 10px;
  color: #007bff;
  text-decoration: none;
  font-size: 14px;
}

.registro-link:hover {
  text-decoration: underline;
}
/* STRUCTURE */

.wrapper {
  display: flex;
  align-items: center;
  flex-direction: column; 
  justify-content: center;
  width: 100%;
  min-height: 90vh; /* Cambiado para mejor cobertura en dispositivos móviles */
  padding: 25px;
  box-sizing: border-box; /* Asegura que el padding no sobrepase el tamaño del contenedor */
}

#formContent {
  border-radius: 10px;
  background: #ffffff;
  padding: 20px;
  width: 100%;
  max-width: 600px;
  box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
  text-align: center;
  box-sizing: border-box; /* Asegura que el padding no sobrepase el tamaño del contenedor */
  margin: 20px; /* Añadido para un pequeño margen exterior */
}

.fadeInDown {
  animation-name: fadeInDown;
  animation-duration: 1s;
  animation-fill-mode: both;
}
#formFooter {
  background-color: #f6f6f6;
  border-top: 1px solid #dce8f1;
  padding: 25px;
  text-align: center;
  -webkit-border-radius: 0 0 10px 10px;
  border-radius: 0 0 10px 10px;
}



/* TABS */

h2.inactive {
  color: #cccccc;
}

h2.active {
  color: #0d0d0d;
  border-bottom: 2px solid #5fbae9;
}



/* FORM TYPOGRAPHY*/



input[type=button]:hover, input[type=submit]:hover, input[type=reset]:hover  {
  background-color: #39ace7;
}

input[type=button]:active, input[type=submit]:active, input[type=reset]:active  {
  -moz-transform: scale(0.95);
  -webkit-transform: scale(0.95);
  -o-transform: scale(0.95);
  -ms-transform: scale(0.95);
  transform: scale(0.95);
}

.edit1 {
  background-color: #dadada;
  border: none;
  color: #000000;
  padding: 5px 15px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin-bottom: 5px;
  width: 100%;
  border: 2px solid #ffffff;
  -webkit-transition: all 0.5s ease-in-out;
  -moz-transition: all 0.5s ease-in-out;
  -ms-transition: all 0.5s ease-in-out;
  -o-transition: all 0.5s ease-in-out;
  transition: all 0.5s ease-in-out;
  -webkit-border-radius: 5px 5px 5px 5px;
  border-radius: 5px 5px 5px 5px;
}
.boton1 {
  background-color: #5d0004;
  border: none;
  color: white;
  padding: 10px 80px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  text-transform: uppercase;
  font-size: 13px;
  -webkit-box-shadow: 0 10px 30px 0 rgba(95,186,233,0.4);
  box-shadow: 0 10px 30px 0 rgba(95,186,233,0.4);
  -webkit-border-radius: 5px 5px 5px 5px;
  border-radius: 5px 5px 5px 5px;
  width: 100%;
  -webkit-transition: all 0.3s ease-in-out;
  -moz-transition: all 0.3s ease-in-out;
  -ms-transition: all 0.3s ease-in-out;
  -o-transition: all 0.3s ease-in-out;
  transition: all 0.3s ease-in-out;
}
input[type=text]:focus {
  background-color: #fff;
  border-bottom: 2px solid #5fbae9;
}

input[type=text]:placeholder {
  color: #cccccc;
}

/* ANIMATIONS */

/* Simple CSS3 Fade-in-down Animation */

@-webkit-keyframes fadeInDown {
  0% {
    opacity: 0;
    -webkit-transform: translate3d(0, -100%, 0);
    transform: translate3d(0, -100%, 0);
  }
  100% {
    opacity: 1;
    -webkit-transform: none;
    transform: none;
  }
}

@keyframes fadeInDown {
  0% {
    opacity: 0;
    -webkit-transform: translate3d(0, -100%, 0);
    transform: translate3d(0, -100%, 0);
  }
  100% {
    opacity: 1;
    -webkit-transform: none;
    transform: none;
  }
}

/* Simple CSS3 Fade-in Animation */
@-webkit-keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
@-moz-keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
@keyframes fadeIn { from { opacity:0; } to { opacity:1; } }

.fadeIn {
  opacity:0;
  -webkit-animation:fadeIn ease-in 1;
  -moz-animation:fadeIn ease-in 1;
  animation:fadeIn ease-in 1;

  -webkit-animation-fill-mode:forwards;
  -moz-animation-fill-mode:forwards;
  animation-fill-mode:forwards;

  -webkit-animation-duration:1s;
  -moz-animation-duration:1s;
  animation-duration:1s;
}

.fadeIn.first {
  -webkit-animation-delay: 0.4s;
  -moz-animation-delay: 0.4s;
  animation-delay: 0.4s;
}

.fadeIn.second {
  -webkit-animation-delay: 0.6s;
  -moz-animation-delay: 0.6s;
  animation-delay: 0.6s;
}

.fadeIn.third {
  -webkit-animation-delay: 0.8s;
  -moz-animation-delay: 0.8s;
  animation-delay: 0.8s;
}

.fadeIn.fourth {
  -webkit-animation-delay: 1s;
  -moz-animation-delay: 1s;
  animation-delay: 1s;
}

/* Simple CSS3 Fade-in Animation */
.underlineHover:after {
  display: block;
  left: 0;
  bottom: -10px;
  width: 0;
  height: 2px;
  background-color: #56baed;
  content: "";
  transition: width 0.2s;
}

.underlineHover:hover {
  color: #0d0d0d;
}

.underlineHover:hover:after{
  width: 100%;
}



/* OTHERS */

*:focus {
    outline: none;
} 

* {
  box-sizing: border-box;
}
@media (max-width: 600px) {
  #formContent {
    max-width: 90%; /* Ajusta el ancho para pantallas pequeñas */
    padding: 15px; /* Reduce el padding en pantallas más pequeñas */
  }

  .wrapper {
    padding: 15px; /* Reduce el padding general en pantallas más pequeñas */
  }

  .edit1 {
    font-size: 14px; /* Ajusta el tamaño de fuente para mejor visibilidad */
  }

  .boton1 {
    width: 100%; /* El botón ocupa todo el ancho disponible */
  }
}
</style>