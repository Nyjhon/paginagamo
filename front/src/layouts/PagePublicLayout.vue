<template>
  <q-layout view="hHh LpR fFf">
    <q-header elevated style="background-color: #5d0004; position: relative;">
      <q-toolbar>

        <!-- Logo -->
        <q-img src="/img/gamo2.png" class="logo" />
        
        <!-- Título -->
        <q-toolbar-title class="text-white">
          
        </q-toolbar-title>

        <!-- Menú para pantallas grandes -->
        <div class="q-gutter-sm gt-sm">
          <q-btn flat label="Inicio" to="/" class="text-white" :class="{ 'active-link': $route.path === '/' }"/>
          <q-fab
            class="text-white"
            v-model="fab1"
            label="MUNICIPIO"
            vertical-actions-align="left"
            flat
            padding="5px"
            icon="keyboard_arrow_down"
            direction="down"
          >
            <q-fab-action padding="8px" color="secondary" to="/historia" label="Historia de Oruro"
              style="border-radius: 5%;" :class="{ 'active-link': $route.path === '/historia' }" />
            <q-fab-action padding="8px" color="secondary" to="/alcalde" label="Nuestro Alcalde"
              style="border-radius: 5%;" :class="{ 'active-link': $route.path === '/alcalde' }" />
          </q-fab>

          <q-btn flat label="M.O.F." to="/organigrama" class="text-white" :class="{ 'active-link': $route.path === '/organigrama' }"/>

          <a href="https://www.facebook.com/AlcaldiaDeOruro" target="_blank">
            <q-icon name="fab fa-facebook" size="32px" class="text-white" />
          </a>
        </div>

        <!-- Menú hamburguesa para pantallas pequeñas -->
        <q-btn dense flat icon="menu" class="lt-md text-white" @click="leftDrawerOpen = !leftDrawerOpen" />
      </q-toolbar>

      <!-- Imagen de fondo en el header -->
      <q-img src="fondo.jpg" class="header-image absolute-top" />
    </q-header>

    <!-- Drawer solo para móvil -->
    <q-drawer
      v-model="leftDrawerOpen"
      side="right"
      behavior="mobile"
      style="background-color: #5d0004; color: white;"
    >
      <q-list>
        <q-item clickable to="/" :class="{ 'active-link': $route.path === '/' }">
          <q-item-section>Inicio</q-item-section>
        </q-item>

        <q-expansion-item
          label="Municipio"
          dense
          expand-separator
          header-class="text-white"
        >
          <q-item clickable to="/alcalde" :class="{ 'active-link': $route.path === '/alcalde' }">
            <q-item-section>Nuestro Alcalde</q-item-section>
          </q-item>
          <q-item clickable to="/historia" :class="{ 'active-link': $route.path === '/historia' }">
            <q-item-section>Historia de Oruro</q-item-section>
          </q-item>
        </q-expansion-item>

        <q-item clickable to="/organigrama" :class="{ 'active-link': $route.path === '/organigrama' }">
          <q-item-section>M.O.F.</q-item-section>
        </q-item>
         <!-- <q-item clickable to="/servicios" :class="{ 'active-link': $route.path === '/servicios' }">
          <q-item-section>Servicios</q-item-section>
        </q-item>-->
      </q-list>
    </q-drawer>

    <!-- Contenido dinámico -->
    <q-page-container style="padding-top: 0px; padding-bottom: 0px;">
      <router-view />
    </q-page-container>
    <q-page-container class="fondo-section q-pa-md">
      <div class="mision-vision-content q-pa-md">
        <div class="row q-col-gutter-md items-center" >
          <!-- LOGO -->
          <div class="col-12 col-md-3 text-center q-pa-sm">
            <img src="gamob.png" style="width: 80%;"/>
          </div>
          <!-- INFORMACIÓN -->

          <div class="col-12 col-md-4 text-white q-pa-sm">
            <h2 class="text-h6 text-bold">OPERADORES AUTORIZADOS POR EL G.A.M.O.</h2>
            <ul style="list-style: none; padding-left: 0;">
                <li class="q-mb-sm">
                  <q-icon name="local_phone" size="sm" class="q-mr-sm" />
                  <strong>Empresa Municipal de Aseo Oruro "E.M.A.O.":</strong> 252 - 70972
                </li>
                <li class="q-mb-sm">
                  <q-icon name="local_phone" size="sm" class="q-mr-sm" />
                  <strong>Empresa "ECO MANAGER":</strong> 73836311
                </li>
                <li class="q-mb-sm">
                  <q-icon name="local_phone" size="sm" class="q-mr-sm" />
                  <strong>Asociación de Acopiadores de Residuos Solidos y Reciclables Oruro "ACOGEL":</strong> 73821108
                </li>
                <li class="q-mb-sm">
                  <q-icon name="local_phone" size="sm" class="q-mr-sm" />
                  <strong>Asociación recicladores los Angel "ARLA":</strong> 63583168
                </li>
              </ul>
            <h2 class="text-h6 text-bold">DIRECCIÓN DEL G.A.M.O.</h2>
            <ul style="list-style: none; padding-left: 0;">
              <li><q-icon name="place" style="font-size: 40px;"/> Calle Bolivar y Calle La Plata</li>
              <li><q-icon name="email" style="font-size: 40px;"/> despacho@gamo.gob.bo</li>
              <li><q-icon name="access_time	" style="font-size: 40px;"/> Horarios de Atención: 08:30 a 16:30 hrs.</li>
            </ul>
          </div>

          <!-- MAPA -->
          <div class="col-12 col-md-5 q-pa-sm">
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d564.1576474610946!2d-67.11455783898899!3d-17.97012108534078!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x93e2b0bc341aaaab%3A0xbf07b76e06c0553f!2sAlcald%C3%ADa%20Municipal!5e0!3m2!1ses!2sbo!4v1749490890880!5m2!1ses!2sbo"
              width="100%"
              height="250"
              style="border:0; border-radius: 8px;"
              allowfullscreen=""
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade"
            ></iframe>
          </div>
        </div>
      </div>
    </q-page-container>
    <!-- Pie de página -->
    <q-footer class="text-white q-pa-md text-center" style="background-color: #5d0004; margin-top: 5px;">
      <div class="row">
        <div class="col-3"></div>
        <div class="col-6 text-center">
          Derechos Reservados ® Gobierno Autónomo Municipal de Oruro © 2025
        </div>
        <div class="col-3">
          <a href="https://www.facebook.com/AlcaldiaDeOruro" target="_blank">
            <q-icon name="fab fa-facebook" size="32px" class="text-white" />
          </a>
        </div>
      </div>
    </q-footer>
  </q-layout>
</template>

<script setup>
import { ref } from 'vue'
const fab1 = ref(false)
const fab2 = ref(false)
const fab3 = ref(false)
const leftDrawerOpen = ref(false)
</script>
<style scoped>
.active-link {
  background-color: #a30000 !important;
  color: white !important;
}
.logo {
  height: 40%;
  width: 20%;
  margin-right: 0px;
}
.header-image {
  height: 100%;
  width: 100%;
  position: absolute;
  top: 0;
  z-index: -1;
  opacity: 0.2;
  filter: grayscale(100%);
  object-fit: cover;
}
.mision-vision-content {
  background-color: rgba(0, 0, 0, 0.5);
  border-radius: 12px 12px 0px 0px;
  padding: 10px;
  width: 100%;
}
.fondo-section {
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 50vh;
  background-color: #5d0004;
  background-image: url('/alcaldia.jpg'); /* asegúrate que exista o cambia la ruta */
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  color: white;
  position: relative;
}

.fondo{
  background-color: hsl(227, 60%, 97%); 
}
h2 {
  font-size: 24px;
  margin-top: 30px;
  color: #ffd700; /* dorado elegante */
}
p {
  font-size: 16px;
  line-height: 1.6;
}
li {
  font-size: 20px;
  line-height: 1.6;
}
</style>
