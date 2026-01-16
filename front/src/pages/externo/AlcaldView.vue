<template>
  <q-layout view="hHh LpR fFf">
    <transition name="slide-fade" class="q-pa-xl" style="background-color: #5d0004;">
      <div v-if="mostrarTitulo" >
        <div class="text-h3 text-white text-bold">
          NUESTRO ALCALDE
        </div>
        <hr>
      </div>
    </transition>
    <q-page-container style="padding: 0px;">
      <q-card style="margin: 40px;">
        <div class="row">
          <div class="col-12 col-md-6">
            <div class="text-bold text-h4" style="padding: 40px;">
              Ing. Adhemar Wilcarani Morales
            </div>
            <div class="text-h6" style="padding: 40px;">
              ALCALDE MUNICIPAL DE ORURO
              <hr >
            </div>
            <div class="text-justify" style="padding: 40px; font-size: 1.3em;">
              Nació en la ciudad de Oruro, el 9 de diciembre de 1978. Ingeniero Eléctrico de la Universidad Técnica de Oruro y músico.
              <br>
              Es parte y miembro activo de la Organización Nacional «Jóvenes por la Dignidad».
              <br>
              En su niñez aprendió a interpretar notas musicales a través de la trompeta. Llego a dirigir la banda de música de su colegio Antonio José de Sainz y también formo arte del mariachi «Arenal».
              <br>
              Simultáneamente fue miembro de la banda de música Imperial, siendo parte así de la Obra Maestra del Patrimonio Oral e Intangible de la Humanidad.
              <br>
              Wilcarani es hijo de Ponciano Wilcarani y Esther Morales, hermana del expresidente del Estado, Evo Morales.
            </div>
          </div>
          <div class="col-12 col-md-6">
            <q-img src="historia/alcalde.png" style="border-radius: 40px; display: block; margin: 0 auto;" width="50%"/>
          </div>
        </div>
      </q-card>
    </q-page-container>
    <q-dialog v-model="dialogImagen">
      <q-card class="bg-dark text-white" style="width: 700px; max-width: 80vw;">
        <q-img
          :src="getUrl(imagenAmpliada)"
          style="width: 100%; object-fit: contain;"
          spinner-color="white"
        />
        <q-card-actions align="center" class="bg-dark">
          <q-btn label="Cerrar" color="white" flat @click="dialogImagen = false" />
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
        dialogImagen: false,
        imagenAmpliada: ''
      }
    },
    mounted() {
       this.mostrarTitulo = true
    },
    methods: {

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