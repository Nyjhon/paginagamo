<template>
  <q-layout view="hHh LpR fFf">
    <q-page-container class="carrusel">
      <q-carousel
        animated
        v-model="slide"
        arrows
        infinite
        :autoplay="4000"
        height="600px"
        navigation
      >
        <q-carousel-slide
          v-for="(item, index) in images"
          :key="item.id"
          :name="index"
          :img-src="getPdfUrl(item.img_url)"
        >
        <div class="absolute-bottom custom-caption">
          <div class="text-h2"><strong>{{ item.titulo }}</strong></div>
        </div>
      </q-carousel-slide>
      </q-carousel>
    </q-page-container>

    <q-page-container class="fondo" style="padding-top: 0px; padding-bottom: 0px;">
        <div class="mision-vision-section">
          <div class="contenido">
            <h2><strong> MISIÓN</strong></h2>
            <p>
              El Gobierno Autónomo Municipal de Oruro. A través del Órgano Legislativo:  delibera  políticas, estrategias  de desarrollo, fiscaliza la gestión municipal. A través del Órgano Ejecutivo: planifica, organiza, coordina y ejecuta planes, programas y proyectos; con eficiencia, transparencia y participación social para alcanzar un desarrollo local sostenible e integral.            </p>
            <h2><strong> VISIÓN</strong></h2>
            <p>
              Oruro, municipio moderno, desarrollado y organizado territorial ambiental y económicamente, con una cultura integrada, articuladora y competitiva.            </p>
          </div>
        </div>
    </q-page-container>

    <q-page-container class="fondo" style="padding-top: 0px; padding-bottom: 5px;">
      <!-- TÍTULO SERVICIOS -->
      <div class="text-center">
        <div class="q-pa-md">
          <div class="elegante-caja q-pa-md shadow-3">
            <h4 class="titulo-con-sombra">NUESTROS SERVICIOS Y APLICACIONES</h4>
          </div>
        </div>
        <!-- CARRUSEL DE APPS -->
        <div class="q-pa-md">
          <div class="row items-center q-gutter-sm bg-white q-pa-sm shadow-2 rounded-borders relative-position" style="overflow: hidden;">
            <!-- Botón Izquierda -->
            <q-btn dense flat round icon="chevron_left" @click="scrollLeft" class="absolute-left bg-white z-top" />

            <!-- Carrusel -->
            <div
              ref="carruselapp"
              class="row no-wrap scroll-hide"
              :style="{ transform: `translateX(${translateX}px)`, transition: isAnimating ? 'transform 0.5s ease' : 'none' }"
            >
              <div
                v-for="(itemapp, indexapp) in app"
                :key="indexapp"
                class="q-mx-md"
                style="min-width: 150px; display: flex; flex-direction: column; justify-content: center; align-items: center;"
              >
                <a :href="itemapp.url" target="_blank" class="no-decoration text-dark">
                  <img
                    :src="getPdfUrl(itemapp.img_url)"
                    :alt="itemapp.titulo"
                    style="height: 90px; max-width: 120px;"
                  />
                  <div class="text-h6 text-center q-mt-sm">{{ itemapp.titulo }}</div>
                </a>
              </div>
            </div>

            <!-- Botón Derecha -->
            <q-btn dense flat round icon="chevron_right" @click="scrollRight" class="absolute-right bg-white z-top" />
          </div>
        </div>
      </div>
    </q-page-container>


    <q-page-container class="fondo-section-documento q-pa-md" >
      <div class="q-pa-md text-center">
        <div class="elegante-caja q-pa-md shadow-3">
          <h4 class="titulo-con-sombra">DOCUMENTOS</h4>
        </div>
      </div>
      <div class="mision-vision-content q-pa-md">
        <div class="row q-col-gutter-md items-center">
          <div
            v-for="cat in category"
            :key="cat.id"
            class="col-12 col-md-4 flex flex-center"
          >
            <q-card
              style="width: 220px;"
              class="q-pa-md cursor-pointer"
              @click="verCategoria(cat.id)"
            >
              <div class="column items-center">
                <q-img
                  :src="getUrl(cat.img)"
                  style="width: 50%; max-height: 120px; object-fit: contain;"
                />
                <div class="text-subtitle1 q-mt-sm text-center text-black">
                  <strong>{{ cat.titulo }}</strong>
                </div>
              </div>
            </q-card>
          </div>
        </div>
      </div>
    </q-page-container>
    <!--<q-page-container class="fondo" style="padding-top: 0px; padding-bottom: 5px;">
      <div class="text-center">
        <div class="q-pa-md">
          <div class="elegante-caja q-pa-md shadow-3">
            <h4 class="titulo-con-sombra">DESCARGA DE FORMULARIOS</h4>
          </div>
        </div>
        <div class="row justify-center">
          <div class="col-12 col-sm-8 col-md-6 col-lg-4">
            <q-card class="my-card shadow-4 rounded-2xl overflow-hidden">

              <div class="bg-primary text-white text-subtitle1 q-pa-sm text-center">
                UNIDAD DE ACTIVIDADES ECONÓMICAS
              </div>

              <q-card-section class="q-py-md text-center">
                <div class="text-h4 text-bold text-primary q-mb-xs">
                  Declaración Jurada
                </div>
                <div class="text-body1 text-grey-8">
                  Formularios oficiales para trámites de Actividades Económicas.
                </div>
              </q-card-section>


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
      </div>
    </q-page-container>-->
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

    <!-- SECCIÓN NOTICIAS Y FACEBOOK -->
    <q-page-container class="q-py-md fondo" style="padding-top: 0px;">
      <div class="row q-col-gutter-md">
        <!-- NOTICIAS -->
        <div class="col-12 col-md-8">
          <div class="q-pa-md">
            <div class="elegante-caja q-pa-md shadow-3">
              <h4 class="titulo-con-sombra">ÚLTIMAS NOTICIAS</h4>
            </div>
            <q-card>
              <q-card-section>
                <div style="max-height: 950px; overflow-y: auto;" class="scroll-container">
                  <div
                    v-for="notis in noticias"
                    :key="notis.id"
                    class="q-mb-md"
                  >
                    <q-card class="q-pa-sm" style="min-height: 300px;">
                      <q-card-section class="bg-info text-white">
                        <div class="text-h6"><strong>{{ notis.titulo }}</strong></div>
                      </q-card-section>

                      <!-- Contenido en fila -->
                      <q-card-section class="q-pa-md">
                        <div class="row items-start q-col-gutter-sm">
                          <!-- Columna izquierda: texto -->
                          <div class="col-12 col-md-8">
                            <div class="q-mb-md">
                              <div class="text-justify">
                                <span v-if="!notis.mostrarTodo">
                                  {{ notis.descripcion.substring(0, 400) }}...
                                  <q-btn flat dense @click="notis.mostrarTodo = true" label="Ver más" color="primary" />
                                </span>
                                <span v-else>
                                  {{ notis.descripcion }}
                                  <q-btn flat dense @click="notis.mostrarTodo = false" label="Ver menos" color="primary" />
                                </span>
                              </div>
                            </div>

                            <div class="q-mb-sm" v-if="notis.archivo">
                              <a :href="getUrl(notis.archivo)" target="_blank" class="text-primary">
                                Ver archivo
                              </a>
                            </div>
                          </div>

                          <!-- Columna derecha: imágenes -->
                          <div class="col-12 col-md-4">
                            <div v-if="notis.imagenes && notis.imagenes.length">
                              <!-- Primera imagen grande -->
                              <q-img
                                :src="getUrl(notis.imagenes[0].ruta)"
                                class="q-mb-sm"
                                style="width: 100%; max-height: 200px; object-fit: cover; cursor: pointer;"
                                :ratio="16/9"
                                @click="verImagen(notis.imagenes[0].ruta)"
                              />

                              <!-- Resto de imágenes más pequeñas -->
                              <div class="row q-col-gutter-xs" v-if="notis.imagenes.length > 1">
                                <div
                                  v-for="(img, index) in notis.imagenes.slice(1)"
                                  :key="index"
                                  class="col-6"
                                >
                                  <q-img
                                    :src="getUrl(img.ruta)"
                                    style="width: 100%; max-height: 80px; object-fit: cover; cursor: pointer;"
                                    :ratio="1"
                                    @click="verImagen(img.ruta)"
                                  />
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </q-card-section>
                    </q-card>
                  </div>
                </div>
              </q-card-section>
            </q-card>
          </div>
        </div>

        <!-- FACEBOOK -->
        <div class="col-12 col-md-4">
          <div class="q-pa-md text-center">
            <div class="elegante-caja q-pa-md shadow-3">
              <h4 class="titulo-con-sombra">Nuestra Página de Facebook</h4>
            </div>
            <div class="q-mt-md">
              <div id="fb-root"></div>
              <div
                class="fb-page"
                data-href="https://www.facebook.com/AlcaldiaDeOruro"
                data-tabs="timeline"
                data-width="350"
                data-height="900"
                data-small-header="false"
                data-adapt-container-width="true"
                data-hide-cover="false"
                data-show-facepile="true"
              ></div>
            </div>
          </div>
        </div>
      </div>
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

    <q-dialog
        v-for="ventana in ventanas"
        :key="ventana.id"
        v-model="ventana.visible"
        :persistent="false"
      >
      <q-card class="q-ma-md q-pa-md" style="width: 700px; max-width: 80vw; position: relative; background-color: #fff9f9;">

        <q-card-section class="row items-center q-pb-none">
          <q-space />
          <q-btn icon="close" flat round dense v-close-popup />
        </q-card-section>
        <q-card-section class="text-h5 text-center text-primary">
          <strong>{{ ventana.titulo }}</strong>
        </q-card-section>
        <q-card-section class="text-body1 text-center">
          {{ ventana.descripcion }}
        </q-card-section>
        <q-card-section
          v-if="ventana.img_url"
          class="flex flex-center"
        >
          <q-img
            :src="getPdfUrl(ventana.img_url)"
            style="max-width: 80%; border-radius: 2%;"
            contain
          />
        </q-card-section>

        <q-card-section v-if="ventana.archivo_url" align="center">
          <q-btn
            :href="getPdfUrl(ventana.archivo_url)"
            target="_blank"
            color="primary"
            icon="picture_as_pdf"
            label="Ver archivo"
            glossy
            unelevated
            class="q-mt-sm"
          />
        </q-card-section>
      </q-card>
    </q-dialog>
  </q-layout>
</template>
<script>
import {globalStore} from 'stores/globalStore'
import { ref } from 'vue'
  export default {
    name: 'InitpaginaPage',
    data () {
      return {
        fab1: ref(false),
        fab2: ref(false),
        fab3: ref(false),
        slide: 0,
        tab: "gaceta",
        images: [],
        store:globalStore(),
        ventanas: [],
        app: [],
        noticias: [],
        category:[],
        isAnimating: false,
        translateX: 0,
        itemWidth: 180,
        imagenAmpliada: null,
        dialogImagen: false,
        leftDrawerOpen: false,
        dialogformularios: false,
      }
    },
    mounted() {
      this.$api.get('categorydoc').then(res =>{
        this.category = res.data.filter(v => v.visible);
      })
      this.$api.get('noticias').then(res =>{
        this.noticias = res.data.filter(v => v.visible).map(n => ({ ...n, mostrarTodo: false }));
      })
      this.$api.get('ventanas').then(res => {
        this.ventanas = res.data.filter(v => v.visible); // Solo las visibles
      });
      this.$api.get('carrusel').then(res => {

        this.images = res.data.filter(v => v.visible); // Solo las visibles
      });
      this.$api.get('app').then(res => {
        console.log(res.data)
        this.app = res.data.filter(v => v.visible); // Solo las visibles
      });
          // Auto scroll cada 2 segundos
      this.autoScrollInterval = setInterval(() => {
        this.scrollRight();
      }, 2000);
      
      if (!document.getElementById('facebook-jssdk')) {
        let js = document.createElement('script');
        js.id = 'facebook-jssdk';
        js.src = "https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v19.0";
        document.body.appendChild(js);
      }
      window.fbAsyncInit = function () {
        if (typeof FB !== 'undefined') {
          FB.XFBML.parse();
        }
      };
    },
    beforeUnmount() {
      clearInterval(this.autoScrollInterval);
    },
    methods: {
      verCategoria(id) {
        this.$router.push(`/documentos/${id}`);
      },
      verImagen(ruta) {
        this.imagenAmpliada = ruta;
        this.dialogImagen = true;
      },
      goTo(url) {
        window.open(url, "_blank");
      },
      getPdfUrl(archivo) {
        if (!archivo) return "";
        return `https://backend.gamo.gob.bo/${archivo}`;
      },
      getUrl(ruta) {
        if (!ruta) return '';
        return `https://backend.gamo.gob.bo//storage/${ruta}`;
      },
      scrollRight() {
        if (this.isAnimating) return;
        this.isAnimating = true;
        this.translateX = -this.itemWidth;

        setTimeout(() => {
          const first = this.app.shift();
          this.app.push(first);
          this.translateX = 0;
          this.isAnimating = false;
        }, 500);
      },
      scrollLeft() {
        if (this.isAnimating) return;
        this.isAnimating = true;
        
        const last = this.app.pop();
        this.app.unshift(last);
        this.translateX = -this.itemWidth;

        // Sin transición en este primer paso
        this.$nextTick(() => {
          this.translateX = 0;
        });

        setTimeout(() => {
          this.isAnimating = false;
        }, 500);
      },
      descargarnuevo() {
        const url = `/formularios/NUEVO.xlsx` // ruta dentro de /public

        const enlace = document.createElement('a')
        enlace.href = url
        enlace.download = 'NUEVO.xlsx' // nombre del archivo a descargar
        enlace.click()
      },
      descargarmodificacion(){
        const url = `/formularios/MODIFICACION.xlsx` // ruta dentro de /public

        const enlace = document.createElement('a')
        enlace.href = url
        enlace.download = 'MODIFICACION.xlsx' // nombre del archivo a descargar
        enlace.click()
      },
      descargarbaja(){
        const url = `/formularios/BAJA.xlsx` // ruta dentro de /public

        const enlace = document.createElement('a')
        enlace.href = url
        enlace.download = 'BAJA.xlsx' // nombre del archivo a descargar
        enlace.click()
      },
      descargarrenovacion(){
        const url = `/formularios/RENOVACION.xlsx` // ruta dentro de /public

        const enlace = document.createElement('a')
        enlace.href = url
        enlace.download = 'RENOVACION.xlsx' // nombre del archivo a descargar
        enlace.click()
      },
    }
}
</script>
<style scoped>
@import "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css";
.text-primary {
  color: #5d0004;
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
.custom-caption{
  text-align: center;
  padding: 50px;
  color: white;
  background-color: rgba(0, 0, 0, .3);
}
.rounded-borders {
  border-radius: 30px;
}
.scroll-hide::-webkit-scrollbar {
  display: none;
}
.scroll-hide {
  -ms-overflow-style: none;
  scrollbar-width: none;
}
.titulo-con-sombra {
  text-shadow: 0 4px 6px rgba(0, 0, 0, 0.5);
  color: #ffffff;
  margin-bottom: 0px;
  margin-top: 5px;
}
.elegante-caja {
  background-color: #5d0004;
  border-radius: 8px;
  color: white;
}
.no-decoration {
  text-decoration: none;
}
.text-dark {
  color: #212121;
}
.fondo{
  background-color: hsl(227, 60%, 97%); 
}
.mision-vision-section {
  background-color: #5d0004;
  background-image: url('/alcaldia.jpg'); /* Asegúrate que esté en la carpeta /public */
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  padding: 50px 20px;
  color: white;
  text-align: center;
  position: relative;
  z-index: 1;
}
.mision-vision-section::before {
  content: '';
  position: absolute;
  inset: 0;
  background: rgba(93, 0, 4, 0.85); /* fondo semi-transparente encima de la imagen */
  z-index: 0;
}
.contenido {
  position: relative;
  z-index: 1;
  max-width: 800px;
  margin: auto;
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
.fondo-section-documento {
  background-color: #5d0004;
  background-image: url('/fondo.jpg'); /* asegúrate que exista o cambia la ruta */
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  color: white;
  position: relative;
}
.mision-vision-content {
  background-color: rgba(0, 0, 0, 0.5); /* fondo semitransparente */
  border-radius: 12px;
  padding: 20px;
}
</style>