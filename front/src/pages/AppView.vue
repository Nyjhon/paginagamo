<template>
  <q-page class="q-pa-md">
    <q-card>
      <q-card-section class="q-pa-none" style="background-color: #b28f00;">
        <div class="text-h6 text-center q-pa-none text-white">Módulo de Aplicaciones y Servicios</div>
      </q-card-section>
      <q-separator />
      <q-card-actions>
        <div class="row full-width">
          <div class="col-2 flex flex-center">
            <q-btn @click="dialogappadd = true" color="primary" icon="add" label="Añadir Nueva App" />
          </div>
        </div>
      </q-card-actions>
    </q-card>
    <q-card>
      <q-card-section>
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3" v-for="ventana in app" :key="ventana.id">
            <q-card class="my-card q-ma-md">
              <q-card-section class="bg-primary text-white">
                <div class="text-h5">Titulo:<strong>{{ ventana.titulo }}</strong></div>
                <div class="text-h6"><strong>{{ ventana.url }}</strong></div>
                <a :href="ventana.url" target="_blank" class="text-h6" style="color: bisque;">
                  Ver URL
                </a>

              </q-card-section>
              <!-- Mostrar imagen si existe -->
              <q-card-section v-if="ventana.img_url">
                <q-img :src="getPdfUrl(ventana.img_url)" style="max-height: 200px;" />
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
                <q-toggle
                  :model-value="ventana.resaltar"
                  @update:model-value="resaltar(ventana, $event)"
                  label="Resaltar"
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
    <q-dialog v-model="dialogappadd" persistent>
      <q-card style="width: 700px;">
        <q-form @submit="Crearapp" enctype="multipart/form-data">
          <q-card-section class="text-h6 text-center">
            REGISTRAR NUEVA APLICACIÓN
            <hr />
            <div class="row q-col-gutter-md">
              <div class="col-12">
                <q-input v-model="docData.titulo" label="Título" outlined class="uppercase-input" required />
              </div>
              <div class="col-12">
                <q-input
                  v-model="docData.url"
                  outlined
                  class="uppercase-input"
                  required
                  type="url"
                  label="URL del App"
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
              <div class="col-4">
                <q-toggle
                  v-model="docData.visible"
                  label="Visible"
                  checked-icon="check"
                  unchecked-icon="close"
                  color="green"
                />
              </div>
              <div class="col-4">
                <q-toggle
                  v-model="docData.resaltar"
                  label="Resaltar"
                  checked-icon="check"
                  unchecked-icon="close"
                  color="green"
                />
              </div>
            </div>
          </q-card-section>

          <q-card-actions align="right">
            <q-btn flat label="Cancelar" color="primary" @click="dialogappadd = false" />
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
      dialogappadd: false,
      docData: {
        titulo: '',
        url: '',
        fecha: formatDate(Date.now(), 'YYYY-MM-DD'),
        visible:true,
        resaltar:false
      },
      img: null,
      imagePreview: null,
      app: []
    }
  },
  created(){
    this.miapp();
  },
  methods: {
    onImageSelected(event) {
      const file = event.target.files[0]
      if (file) {
        this.img = file
        this.imagePreview = URL.createObjectURL(file)
      }
    },
    Crearapp() {
      this.$q.dialog({
        title: 'Confirmación',
        message: '¿Está seguro de crear el registro?',
        ok: { push: true },
        cancel: { push: true, color: 'negative' },
        persistent: true
      }).onOk(() => {
        const formData = new FormData()
        formData.append('titulo', this.docData.titulo)
        formData.append('url', this.docData.url)
        formData.append('fecha', this.docData.fecha)
        formData.append('visible', this.docData.visible ? '1' : '0')
        formData.append('resaltar', this.docData.resaltar ? '1' : '0')
        if (this.img) {
          formData.append('img', this.img);
        }
        this.$q.loading.show();
        this.$api.post('crearapp', formData, {
          headers: {
            'Content-Type': 'multipart/form-data'
          }
        }).then(res => {
          this.$q.loading.hide();
          this.docData = {
            titulo: '',
            url: '',
            fecha: formatDate(Date.now(), 'YYYY-MM-DD'),
            visible:true,
            resaltar:false
          },
          this.img= null,
          this.dialogappadd = false
          this.miapp()
          this.$q.notify({
            message:'App creado Correctamente',
            type: 'positive',
          })

        }).catch(err => {
          console.error('Error al crear:', err)
        })
      })
    },
    miapp(){
      this.$api.get('miapp').then(res=>{
        this.app = res.data
        console.log(this.app)
      })
    },
    getPdfUrl(archivo) {
      if (!archivo) return "";
      return `https://backend.gamo.gob.bo/${archivo}`;
    },
    Eliminar(ventana) {
      this.$q.dialog({
        title: 'Confirmar',
        message: '¿Está seguro de eliminar app?',
        cancel: true,
        persistent: true
      }).onOk(() => {
        this.$api.post('eliminarapp', { datos: ventana }).then(res => {
          console.log(res.data)
          this.app = this.app.filter(v => v.id !== ventana.id);
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
        this.$api.post('cambiarestadoapp', {
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
    },
    resaltar(ventana, nuevoEstado) {
      this.$q.dialog({
        title: 'Confirmar',
        message: `¿Está seguro de resaltar App?`,
        cancel: true,
        persistent: true
      }).onOk(() => {
        this.$api.post('resaltarapp', {
          id: ventana.id,
          resaltar: nuevoEstado
        }).then(res => {
          this.$q.notify({
            message: 'Resaltado actualizado correctamente',
            type: 'positive'
          });
          ventana.resaltar = nuevoEstado; // Confirmamos visualmente el cambio
        }).catch(err => {
          this.$q.notify({
            message: 'Error al actualizar estado',
            type: 'negative'
          });
          ventana.resaltar = !nuevoEstado;
        });
      }).onCancel(() => {
        ventana.resaltar = !nuevoEstado;
      });
    }
  }

}
</script>
