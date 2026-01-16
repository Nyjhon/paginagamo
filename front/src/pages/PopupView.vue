<template>
  <q-page class="q-pa-md">
    <q-card>
      <q-card-section class="q-pa-none" style="background-color: #b28f00;">
        <div class="text-h6 text-center q-pa-none text-white">Módulo de Ventanas Emergentes</div>
      </q-card-section>
      <q-separator />
      <q-card-actions>
        <div class="row full-width">
          <div class="col-2 flex flex-center">
            <q-btn @click="dialogventanaadd = true" color="primary" icon="add" label="Añadir Nueva Ventana" />
          </div>
        </div>
      </q-card-actions>
    </q-card>
    <q-card>
      <q-card-section>
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3" v-for="ventana in popup" :key="ventana.id">
            <q-card class="my-card q-ma-md">
              <q-card-section class="bg-primary text-white">
                <div class="text-h5">Titulo:<strong>{{ ventana.titulo }}</strong></div>
                <div class="text-h6"><strong>{{ ventana.descripcion }}</strong></div>
              </q-card-section>

              <!-- Mostrar imagen si existe -->
              <q-card-section v-if="ventana.img_url">
                <q-img :src="getPdfUrl(ventana.img_url)" style="max-height: 200px;" />
              </q-card-section>

              <!-- Mostrar enlace al archivo si existe -->
              <q-card-section v-if="ventana.archivo_url">
                <a :href="getPdfUrl(ventana.archivo_url)" target="_blank" class="text-primary">
                  Ver archivo
                </a>
              </q-card-section>

              <q-separator />

              <q-card-section align="right">
                <q-btn flat color="negative" @click="Eliminar(ventana)">Eliminar</q-btn>
                <q-toggle
                  :model-value="ventana.visible"
                  @update:model-value="confirmarCambioEstado(ventana, $event)"
                  label="Visible"
                  checked-icon="check"
                  unchecked-icon="close"
                  color="green"
                />
              </q-card-section>
            </q-card>

          </div>
        </div>
      </q-card-section>
    </q-card>
    <q-dialog v-model="dialogventanaadd" persistent>
      <q-card style="width: 700px;">
        <q-form @submit="Crearventana" enctype="multipart/form-data">
          <q-card-section class="text-h6 text-center">
            REGISTRAR NUEVA VENTANA EMERGENTE
            <hr />
            <div class="row q-col-gutter-md">
              <div class="col-12">
                <q-input v-model="docData.titulo" label="Título" outlined class="uppercase-input" required />
              </div>
              <div class="col-12">
                <q-input
                  v-model="docData.descripcion"
                  outlined
                  class="uppercase-input"
                  required
                  type="textarea"
                  label="Descripción"
                />
              </div>
              <div class="col-4">
                <q-input label="Fecha" outlined type="date" v-model="docData.fecha" class="q-mt-md" readonly />
              </div>

              <!-- Selector de Imagen -->
              <div class="col-4">
                <q-input outlined label="Seleccionar Imagen">
                  <template v-slot:append>
                    <q-icon name="image" />
                  </template>
                  <input
                    type="file"
                    accept="image/*"
                    @change="onImageSelected"
                    class="absolute-full"
                    style="opacity: 0; cursor: pointer;"
                    required
                  />
                </q-input>

                <div v-if="imagePreview" class="q-mt-sm">
                  <q-img :src="imagePreview" style="max-height: 150px;" />
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
            <q-btn flat label="Cancelar" color="primary" @click="dialogventanaadd = false" />
            <q-btn flat label="Guardar" color="negative" type="submit" />
          </q-card-actions>
        </q-form>
      </q-card>
    </q-dialog>
  </q-page>
</template>

<script>
import { date } from 'quasar'
const { formatDate } = date
export default {
  data() {
    return {
      dialogventanaadd: false,
      docData: {
        titulo: '',
        descripcion: '',
        fecha: formatDate(Date.now(), 'YYYY-MM-DD'),
        visible:true
      },
      archivo:null,
      img: null,
      imagePreview: null,
      popup: []
    }
  },
  created(){
    this.miventanas();
  },
  methods: {
    onImageSelected(event) {
      const file = event.target.files[0]
      if (file) {
        this.img = file
        this.imagePreview = URL.createObjectURL(file)
      }
    },
    Crearventana() {
      this.$q.dialog({
        title: 'Confirmación',
        message: '¿Está seguro de crear el registro?',
        ok: { push: true },
        cancel: { push: true, color: 'negative' },
        persistent: true
      }).onOk(() => {
        const formData = new FormData()
        formData.append('titulo', this.docData.titulo)
        formData.append('descripcion', this.docData.descripcion)
        formData.append('fecha', this.docData.fecha)
        formData.append('visible', this.docData.visible ? '1' : '0')
        if (this.img) {
          formData.append('img', this.img);
        }
        if (this.archivo) {
          formData.append('archivo', this.archivo);
        }
        this.$q.loading.show();
        this.$api.post('crearventana', formData, {
          headers: {
            'Content-Type': 'multipart/form-data'
          }
        }).then(res => {
          console.log(res.data)
          this.$q.loading.hide();
          this.docData = {
            titulo: '',
            descripcion: '',
            fecha: formatDate(Date.now(), 'YYYY-MM-DD'),
            visible:true
          },
          this.archivo = null,
          this.img= null,
          this.dialogventanaadd = false
          this.$q.notify({
            message:'Ventana Emergente creado Correctamente',
            type: 'positive',
          })
          this.miventanas();
        }).catch(err => {
          console.error('Error al crear:', err)
        })
      })
    },
    miventanas(){
      this.$api.get('misventanas').then(res=>{
        this.popup = res.data
        console.log(this.popup)
      })
    },
    getPdfUrl(archivo) {
      if (!archivo) return "";
      return `https://backend.gamo.gob.bo/${archivo}`;
    },
    Eliminar(ventana) {
      this.$q.dialog({
        title: 'Confirmar',
        message: '¿Está seguro de eliminar esta ventana?',
        cancel: true,
        persistent: true
      }).onOk(() => {
        this.$api.post('eliminarventana', { datos: ventana }).then(res => {
          this.popup = this.popup.filter(v => v.id !== ventana.id);
          this.$q.notify({
            message: 'Ventana eliminada correctamente',
            type: 'negative'
          });
        }).catch(err => {
          this.$q.notify({
            message: 'Error al eliminar la ventana',
            type: 'warning'
          });
        });
      });
    },
    confirmarCambioEstado(ventana, nuevoEstado) {
      this.$q.dialog({
        title: 'Confirmar',
        message: `¿Está seguro de cambiar el estado de visibilidad?`,
        cancel: true,
        persistent: true
      }).onOk(() => {
        this.$api.post('cambiarEstadoVentana', {
          id: ventana.id,
          visible: nuevoEstado
        }).then(res => {
          this.$q.notify({
            message: 'Estado actualizado correctamente',
            type: 'positive'
          });
          ventana.visible = nuevoEstado; // Confirmamos visualmente el cambio
        }).catch(err => {
          this.$q.notify({
            message: 'Error al actualizar estado',
            type: 'negative'
          });
          ventana.visible = !nuevoEstado;
        });
      }).onCancel(() => {
        ventana.visible = !nuevoEstado;
      });
    }
  }

}
</script>
