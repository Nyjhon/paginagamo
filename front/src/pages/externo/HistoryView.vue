<template>
  <q-layout view="hHh LpR fFf">
    <transition name="slide-fade" class="q-pa-xl" style="background-color: #5d0004;">
      <div v-if="mostrarTitulo" >
        <div class="text-h3 text-white text-bold">
          HISTORIA DE NUESTRO ORURO
        </div>
        <hr>
      </div>
    </transition>
    <q-page-container class="q-pa-xl">
      <div class="row q-col-gutter-xl q-mb-xl">
        <!-- Texto izquierda -->
        <q-intersection transition="slide-left" once class="col-12 col-md-6">
          <q-card flat bordered class="q-pa-md" style="background: #fff9f9;">
            <div class="text-justify">
              El 10 de febrero de 1781 estalló la revolución contra la tiranía colonial, siendo encabezada por don Sebastián Pagador, los Menacho y otros patriotas más. Los hermanos Juan de Dios y Jacinto Rodríguez fueron los cerebros de la rebelión. Fue en la Villa Real de San Felipe de Austria (Oruro) que se produjo uno de los primeros gritos libertarios de América Latina, continuando con las rebeliones contra la corona española.            
            </div>
          </q-card>
        </q-intersection>

        <!-- Imagen derecha -->
        <q-intersection transition="fade" once class="col-12 col-md-6">
          <q-card flat class="q-pa-none">
            <q-img src="/historia/1.jpg" style="border-radius: 10px; display: block; margin: 0 auto;" width="80%" class="q-mx-auto"/>
          </q-card>
        </q-intersection>
      </div>

      <div class="row q-col-gutter-xl q-mb-xl">
        <!-- Imagen izquierda -->
        <q-intersection transition="fade" once class="col-12 col-md-6">
          <q-card flat class="q-pa-none">
            <q-img src="/historia/2.jpg" style="border-radius: 10px; display: block; margin: 0 auto;" width="80%"/>
          </q-card>
        </q-intersection>

        <!-- Texto derecha -->
        <q-intersection transition="slide-right" once class="col-12 col-md-6">
          <q-card flat bordered class="q-pa-md" style="background: #fff9f9;">
            <div class="text-justify">
              Es entonces que Sebastián Pagador emite la siguiente proclama: “Amigos paisanos y compañeros; en ninguna ocasión podemos dar mejores pruebas de nuestro amor a la patria, sino en ésta. No estimemos en nada nuestras vidas, sacrifiquémosla gustosos en defensa de la libertad; convirtiendo toda la humildad y rendimiento que hemos tenido con los españoles europeos en ira y furor...”. Se sacaron a las milicias para evitar atropellos contra el edificio de las Cajas Reales, cuya seguridad estaba a cargo de Sebastián Pagador, que en medio de los incidentes acaecidos, fue asesinado por la turba indígena.
            </div>
          </q-card>
        </q-intersection>
      </div>

      <div class="q-mb-xl">
        <div class="text-h3 text-bold text-primary">FUNDACIÓN DE ORURO:</div>
          <div class="text-h6 text-center text-italic q-pa-md" transition="slide-right">
            La ciudad fue fundada el 1º de noviembre de 1606, por el oidor de la real audiencia de Charcas del alto, pero Manuel de Castro del Castillo y Padilla, se llamo “Villa de Sana Felipe de Austria”, en honor al rey de España Felipe III, 7 nieto del emperador Carlos V del sacro imperio romano. Fue una de las villas españolas de la audiencia de Charcas actual de Bolivia, que fue diseñada por ingenieros, en forma de damero, reeditando los clasicos esquemas urbanos eurepeos de aquella epoca (siglo XVII).        
          </div>
      </div>
      <q-carousel
        v-model="slide"
        animated
        infinite
        autoplay
        arrows
        navigation
        class="bg-grey-2 shadow-2 rounded-borders q-mb-xl"
      >
        <q-carousel-slide
          v-for="(img, index) in miGaleria"
          :key="index"
          :name="index"
          :img-src="img"
          @click="ampliarImagen(img)"
        />
      </q-carousel>
  
      <q-dialog v-model="dialogImagen">
        <q-card class="bg-dark text-white" style="width: 700px; max-width: 90vw;">
          <q-img
            :src="imagenAmpliada"
            style="width: 100%; object-fit: contain;"
            spinner-color="white"
          />
          <q-card-actions align="center" class="bg-dark">
            <q-btn label="Cerrar" color="white" flat @click="dialogImagen = false" />
          </q-card-actions>
        </q-card>
      </q-dialog>
      <div class="q-mb-xl">
        <div class="text-h3 text-bold text-primary">PROCESOS DEL DESARROLLO DE ORURO:</div>
      </div>

      <div class="row q-col-gutter-xl q-mb-xl">
        <!-- Texto izquierda -->
        <q-intersection transition="slide-left" once class="col-12 col-md-7">
          <q-card bordered class="my-card q-pa-md">
            <div class="text-justify text-subtitle1">
              Don Francisco de Medrano, hacia el año 1585, bautizo con el nombre de San Miguel de Oruro un pueblo denominado Ururu, notable en su desarrollo por la cerámica.
              <br><hr>
              10 de febrero de 1781, se da el grito libertario en Oruro. El artífice fue Sebastián Pagador y un grupo de cautillos que lanzaron uno de los primeros gritos libertarios. Muere en una turbulencia y el mando de la revuelta libertaria de toma de Jacinto Rodríguez de Herrera.
              <br><hr>
              La revolución del 6 de octubre de 1810, encabezada por Tomás Barrón, tiene una significativa importancia en el proceso de emancipación que se desarrolló en el Alto Perú, además influyó significativamente en la victoria patriota, frente a las tropas realistas en la Batalla de Aroma.
              <br><hr>
              El departamento fue creado durante el gobierno del mariscal de Ayacucho Antonio José de Sucre el 5 de septiembre de 1826 mediante Ley. El departamento está conformado por 16 provincias las cuales a la vez se dividen en 35 municipios.      
            </div>
          </q-card>
        </q-intersection>

        <!-- Imagenes derecha -->
        <q-intersection transition="slide-right" once class="col-12 col-md-5">
          <q-card bordered class="q-pa-md">
            <q-scroll-area style="height: 360px;">
              <div class="column items-center q-gutter-md">
                <q-card
                  v-for="(img, i) in miHistory"
                  :key="i"
                  flat
                  style="width: 80%; max-width: 300px;"
                  @click="ampliarImagen(img)"
                >
                  <q-img :src="img" style="border-radius: 12px;" />
                </q-card>
              </div>
            </q-scroll-area>
          </q-card>
        </q-intersection>
      </div>

      <q-card class="q-ma-md">
        <div class="row">
          <div class="col-12 col-md-6">
            <video controls width="100%" class="q-pa-md">
              <source src="historia/gamo1.mp4" type="video/mp4" />
              Tu navegador no soporta videos.
            </video>
          </div>
          <div class="col-12 col-md-6">
            <video controls width="100%" class="q-pa-md">
              <source src="historia/gamo2.mp4" type="video/mp4" />
              Tu navegador no soporta videos.
            </video>
          </div>
        </div>
      </q-card>
      <q-card class="q-ma-md">
        <q-img src="historia/mapade-oruro.gif" style="border-radius: 10px; display: block; margin: 0 auto;" width="80%"/>
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
        leftDrawerOpen: false,
        mostrarTitulo: false,
        slide: 0,
        miGaleria: [
          'historia/3.jpg',
          'historia/4.jpg',
          'historia/5.jpg',
          'historia/6.jpg',
        ],
        miHistory: [
          'historia/11.jpg',
          'historia/12.jpg',
          'historia/13.jpg',
          'historia/14.jpg',
          'historia/15.jpg',
          'historia/16.jpg',
        ],
        dialogImagen: false,
        imagenAmpliada: ''
      }
    },
    mounted() {
       this.mostrarTitulo = true
    },
    methods: {
      ampliarImagen(img) {
        this.imagenAmpliada = img
        this.dialogImagen = true
      }
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