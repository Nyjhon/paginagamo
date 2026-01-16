<template>
  <q-page class="q-pa-md">
    <q-card>
      <q-card-section class="q-pa-none" style="background-color: #b28f00;">
        <div class="text-h6 text-center q-pa-none text-white">MODULO DE NOTICIAS</div>
      </q-card-section>
      <q-separator />
      <q-card-actions>
        <div class="row full-width">
          <div class="col-2 flex flex-center">
            <q-btn @click="dialogcategoryadd = true" color="primary" icon="add" label="Añadir Nueva Noticia" />
          </div>
        </div>
      </q-card-actions>
    </q-card>
    <q-card>
      <q-card-section>
        <div>
          <div v-for="notis in noticias" :key="notis.id" class="q-mb-md">
            <q-card>
              <q-card-section class="bg-primary text-white">
                <div class="text-h5">Título: <strong>{{ notis.titulo }}</strong></div>
              </q-card-section>

              <!-- Contenido en fila: texto a la izquierda, imágenes a la derecha -->
              <q-card-section class="q-pa-md">
                <div class="row items-start">
                  <!-- Columna izquierda: texto -->
                  <div class="col-12 col-md-8">
                    <div class="text-h6 q-mb-md">
                      {{ notis.descripcion }}
                    </div>

                    <div class="q-mb-sm" v-if="notis.archivo">
                      <a :href="getUrl(notis.archivo)" target="_blank" class="text-primary">
                        Ver archivo
                      </a>
                    </div>

                    <div>
                      <q-btn flat color="negative" @click="Eliminar(notis)">Eliminar</q-btn>
                      <q-toggle
                        :model-value="notis.visible"
                        @update:model-value="confirmarCambioEstado(notis, $event)"
                        label="Visible"
                        checked-icon="check"
                        unchecked-icon="close"
                        color="green"
                      />
                    </div>
                  </div>

                  <!-- Columna derecha: imágenes -->
                  <div class="col-12 col-md-4" v-if="notis.imagenes && notis.imagenes.length">
                    <q-img
                      v-for="(img, index) in notis.imagenes"
                      :key="index"
                      :src="getUrl(img.ruta)"
                      style="width: 50%;"
                      class="q-mb-sm"
                      :ratio="4/3"
                    />
                  </div>
                </div>
              </q-card-section>
            </q-card>
          </div>
        </div>
      </q-card-section>
    </q-card>
    <q-dialog v-model="dialogcategoryadd" persistent>
      <q-card style="width: 700px;">
        <q-form @submit="Crearnoticia" enctype="multipart/form-data">
          <q-card-section class="text-h6 text-center">
            REGISTRAR NUEVA NOTICIA
            <hr />
            <div class="row q-col-gutter-md">
              <div class="col-12">
                <q-input v-model="docData.titulo" label="Título" outlined class="uppercase-input" required />
              </div>
              <div class="col-12">
                <q-input
                  v-model="docData.descripcion"
                  outlined
                  required
                  type="textarea"
                  label="Descripción"
                />
              </div>
              <div class="col-4">
                <q-input label="Fecha" outlined type="date" v-model="docData.fecha" class="q-mt-md" readonly />
              </div>

              <!-- Selector de Imágenes Múltiples -->
              <div class="col-4">
                <q-input outlined label="Seleccionar Imágenes">
                  <template v-slot:append>
                    <q-icon name="image" />
                  </template>
                  <input
                    type="file"
                    accept="image/*"
                    multiple
                    @change="onImagesSelected"
                    class="absolute-full"
                    style="opacity: 0; cursor: pointer;"
                  />
                </q-input>

                <div v-if="imagePreviews.length" class="q-mt-sm row q-col-gutter-sm">
                  <div v-for="(src, index) in imagePreviews" :key="index" class="col-6">
                    <q-img :src="src" style="max-height: 150px;" />
                  </div>
                </div>
              </div>


              <!-- Selector de Archivo -->
               <div class="col-4">
                <q-file color="teal" v-model="archivo" outlined dense rounded counter label="Subir Archivo" accept=".pdf" style="padding-top: 10px;">
                  <template v-slot:prepend>
                    <q-icon name="cloud_upload" />
                  </template>
                </q-file>
               </div>


              <div class="col-4">
                <q-toggle
                  v-model="docData.visible"
                  label="Visible"
                  checked-icon="check"
                  unchecked-icon="close"
                  color="green"
                />
              </div>

            </div>
          </q-card-section>

          <q-card-actions align="right">
            <q-btn flat label="Cancelar" color="primary" @click="dialogcategoryadd = false" />
            <q-btn flat label="Guardar" color="negative" type="submit" />
          </q-card-actions>
        </q-form>
      </q-card>
    </q-dialog>
  </q-page>
</template>

<script>
import {date} from 'quasar'
const { formatDate } = date
export default {
  data() {
    return {
      dialogcategoryadd: false,
      docData: {
        titulo: '',
        descripcion: '',
        fecha: formatDate(Date.now(), 'YYYY-MM-DD'),
        visible:true
      },
      archivo:null,
      img: null,
      selectedImages: [],
      imagePreviews: [],
      noticias:[],
    };
  },
  created(){
    this.misnoticias()
  },
  methods: {
    misnoticias(){
      this.$api.get('misnoticias').then(res =>{
        this.noticias = res.data
        console.log(res.data)
      })
    },
    Crearnoticia() {
      this.$q.dialog({
        title: 'Confirmación',
        message: '¿Está seguro de crear el registro?',
        ok: { push: true },
        cancel: { push: true, color: 'negative' },
        persistent: true
      }).onOk(() => {
          const formData = new FormData();
          formData.append('titulo', this.docData.titulo);
          formData.append('descripcion', this.docData.descripcion);
          formData.append('fecha', this.docData.fecha);
          formData.append('visible', this.docData.visible ? 1 : 0);
          if (this.archivo) {
            formData.append('archivo', this.archivo);
          }
          this.selectedImages.forEach((image, index) => {
            formData.append(`imagenes[]`, image);
          });
          this.$q.loading.show();
          this.$api.post('/crearnoticia', formData, {
              headers: {
                'Content-Type': 'multipart/form-data'
              }
          }).then(res => {     
              console.log(res.data)  
              this.docData = {
                titulo: '',
                descripcion: '',
                fecha: formatDate(Date.now(), 'YYYY-MM-DD'),
                visible:true
              },
              this.archivo = null,
              this.selectedImages= [],
              this.imagePreviews= [],
              this.misnoticias()       
              this.$q.loading.hide();
              this.dialogcategoryadd = false
              this.$q.notify({
                message:'Noticia creado Correctamente',
                type: 'positive',
              })
              }).catch(err => {
          console.error('Error al crear:', err)
        })
      })
    },
    onImagesSelected(event) {
      const files = Array.from(event.target.files);
      this.selectedImages = files;

      // Previsualización
      this.imagePreviews = files.map(file => URL.createObjectURL(file));
    },
    getUrl(ruta) {
      if (!ruta) return '';
      return `https://backend.gamo.gob.bo//storage/${ruta}`;
    },
    Eliminar(notis) {
      this.$q.dialog({
        title: 'Confirmar',
        message: '¿Está seguro de eliminar esta noticia?',
        cancel: true,
        persistent: true
      }).onOk(() => {
        this.$api.post('eliminarnoticia', { datos: notis }).then(res => {
          this.noticias = this.noticias.filter(v => v.id !== notis.id);
          this.$q.notify({
            message: 'Noticia eliminada correctamente',
            type: 'negative'
          });
        }).catch(err => {
          this.$q.notify({
            message: 'Error al eliminar la noticia',
            type: 'warning'
          });
        });
      });
    },
    confirmarCambioEstado(notis, nuevoEstado) {
      this.$q.dialog({
        title: 'Confirmar',
        message: `¿Está seguro de cambiar el estado de visibilidad?`,
        cancel: true,
        persistent: true
      }).onOk(() => {
        this.$api.post('cambiarEstadoNoticia', {
          id: notis.id,
          visible: nuevoEstado
        }).then(res => {
          this.$q.notify({
            message: 'Estado actualizado correctamente',
            type: 'positive'
          });
          notis.visible = nuevoEstado; // Confirmamos visualmente el cambio
        }).catch(err => {
          this.$q.notify({
            message: 'Error al actualizar estado',
            type: 'negative'
          });
          notis.visible = !nuevoEstado;
        });
      }).onCancel(() => {
        notis.visible = !nuevoEstado;
      });
    }
  }
}
</script>

<style scoped>
.my-card{
  width: 100%;
  max-width: 250px
}
.uppercase-input{
  text-transform: uppercase;
}
</style>
