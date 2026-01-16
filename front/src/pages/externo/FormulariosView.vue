<template>
  <q-layout view="hHh LpR fFf">
    <transition name="slide-fade" class="q-pa-xl" style="background-color: #5d0004;">
      <div v-if="mostrarTitulo" >
        <div class="text-h3 text-white text-bold">
          FORMULARIOS G.A.M.O.
        </div>
        <hr>
      </div>
    </transition>
    <q-page-container class="flex flex-center q-pa-lg bg-grey-2">
      <div class="row justify-center">
        <div class="col-12 col-sm-8 col-md-6 col-lg-4">
          <q-card class="my-card shadow-4 rounded-2xl overflow-hidden">
            <!-- Imagen superior -->
            <q-img
              src="alcaldia.jpg"
              ratio="16/9"
              spinner-color="primary"
              class="rounded-borders"
            >
              <div class="absolute-bottom bg-primary text-white text-subtitle1 q-pa-sm text-center">
                UNIDAD DE ACTIVIDADES ECONÓMICAS
              </div>
            </q-img>

            <!-- Contenido -->
            <q-card-section class="q-py-md text-center">
              <div class="text-h6 text-bold text-primary q-mb-xs">
                Declaración Jurada
              </div>
              <div class="text-body2 text-grey-8">
                Formularios oficiales para trámites de Actividades Económicas.
              </div>
            </q-card-section>

            <!-- Botón -->
            <q-card-actions align="center" class="q-pb-md">
              <q-btn
                color="secondary"
                glossy
                icon="description"
                label="Ver Formularios"
                @click="dialogformularios = true"
                class="q-px-md"
              />
            </q-card-actions>
          </q-card>
        </div>
      </div>
    </q-page-container>


    <q-dialog v-model="dialogformularios" persistent>
      <q-card class="q-pa-md" style="min-width: 400px;">
        <q-card-section class="text-center">
          <div class="text-h6 text-primary">Descargar Formularios</div>
          <div class="text-subtitle2 text-grey-7">
            Selecciona el archivo que deseas descargar
          </div>
        </q-card-section>

        <q-separator />

        <q-card-section class="q-gutter-md">
          <div class="row q-col-gutter-md">
            <div class="col-6">
              <q-btn 
                color="primary" 
                glossy 
                icon="cloud_download" 
                label="Formulario para Registro Nuevo" 
                @click="descargarnuevo('formA.pdf')" 
                class="full-width"
              />
            </div>
            <div class="col-6">
              <q-btn 
                color="secondary" 
                glossy 
                icon="acloud_download" 
                label="Formulario para Modificación de Datos" 
                @click="descargarmodificacion('formB.pdf')" 
                class="full-width"
              />
            </div>
            <div class="col-6">
              <q-btn 
                color="accent" 
                glossy 
                icon="cloud_download" 
                label="Formulario para Baja o Cierre de Actividad" 
                @click="descargarbaja('formC.pdf')" 
                class="full-width"
              />
            </div>
            <div class="col-6">
              <q-btn 
                color="positive" 
                glossy 
                icon="cloud_download" 
                label="Formulario para Renovación de Licencia" 
                @click="descargarrenovacion('formD.pdf')" 
                class="full-width"
              />
            </div>
          </div>
        </q-card-section>

        <q-separator />

        <q-card-actions align="right">
          <q-btn flat label="Cerrar" color="negative" v-close-popup />
        </q-card-actions>
      </q-card>
    </q-dialog>

  </q-layout>
</template>
<script>
import { ref } from 'vue'
  export default {
    data () {
      return {
        mostrarTitulo: false,
        slide: 0,
        dialogformularios: false,
        imagenAmpliada: '',

      }
    },
    mounted() {
       this.mostrarTitulo = true
    },
    methods: {
      descargarnuevo(){
        const url = `/formularios/NUEVO.xlsx` // ruta dentro de /public

        // Crea un enlace temporal para forzar la descarga
        const enlace = document.createElement('a')
        enlace.href = url
        enlace.download = nombreArchivo // esto fuerza que el navegador descargue el archivo
        enlace.click()
      },
      descargarmodificacion(){

      },
      descargarbaja(){

      },
      descargarrenovacion(){

      },

    }
}
</script>
<style scoped>

.text-justify {
  text-align: justify;
}
.slide-fade-enter-active {
  transition: all 0.8s ease;
}
.slide-fade-enter-from {
  transform: translateX(-100%);
  opacity: 0;
}
.slide-fade-enter-to {
  transform: translateX(0);
  opacity: 1;
}
</style>