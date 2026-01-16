<template>
  <q-page class="q-pa-md">
    <q-card>
      <q-card-section class="q-pa-none" style="background-color: #b28f00;">
        <div class="text-h6 text-center q-pa-none text-white">Módulo del Carrusel</div>
      </q-card-section>
      <q-separator />
      <q-card-actions>
        <div class="row full-width">
          <div class="col-2 flex flex-center">
            <q-btn @click="dialogcarruseladd = true" color="primary" icon="add" label="Añadir Nueva Imagen" />
          </div>
        </div>
      </q-card-actions>
    </q-card>
    <q-card>
      <q-card-section>
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3" v-for="carrusel in carrusel" :key="carrusel.id">
            <q-card class="my-card q-ma-md">
              <q-card-section class="bg-primary text-white">
                <div class="text-h5">Titulo:<strong>{{ carrusel.titulo }}</strong></div>
                <div class="text-h6"><strong>{{ carrusel.descripcion }}</strong></div>
              </q-card-section>
              <!-- Mostrar imagen si existe -->
              <q-card-section v-if="carrusel.img_url">
                <q-img :src="getPdfUrl(carrusel.img_url)" style="max-height: 200px;" />
              </q-card-section>
              <q-separator />
              <q-card-section align="right">
                <q-btn flat color="negative" @click="Eliminar(carrusel)">Eliminar</q-btn>
                <q-toggle
                  :model-value="carrusel.visible"
                  @update:model-value="confirmarCambioEstado(carrusel, $event)"
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
    <q-dialog v-model="dialogcarruseladd" persistent>
      <q-card style="width: 700px;">
        <q-form @submit="Crearcarrusel" enctype="multipart/form-data">
          <q-card-section class="text-h6 text-center">
            REGISTRAR NUEVA IMAGEN EN EL CARRUSEL
            <hr />
            <div class="row q-col-gutter-md">
              <div class="col-12">
                <q-input v-model="docData.titulo" label="Título" outlined class="uppercase-input"/>
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
            <q-btn flat label="Cancelar" color="primary" @click="dialogcarruseladd = false" />
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
      dialogcarruseladd: false,
      docData: {
        titulo: '',
        fecha: formatDate(Date.now(), 'YYYY-MM-DD'),
        visible:true
      },
      img: null,
      imagePreview: null,
      carrusel: []
    }
  },
  created(){
    this.micarrusel();
  },
  methods: {
    onImageSelected(event) {
      const file = event.target.files[0]
      if (file) {
        this.img = file
        this.imagePreview = URL.createObjectURL(file)
      }
    },
    Crearcarrusel() {
      this.$q.dialog({
        title: 'Confirmación',
        message: '¿Está seguro de crear el registro?',
        ok: { push: true },
        cancel: { push: true, color: 'negative' },
        persistent: true
      }).onOk(() => {
        const formData = new FormData()
        formData.append('titulo', this.docData.titulo)
        formData.append('fecha', this.docData.fecha)
        formData.append('visible', this.docData.visible ? '1' : '0')
        if (this.img) {
          formData.append('img', this.img);
        }
        this.$q.loading.show();
        this.$api.post('crearcarrusel', formData, {
          headers: {
            'Content-Type': 'multipart/form-data'
          }
        }).then(res => {
          this.$q.loading.hide();
          this.micarrusel()
          this.docData = {
            titulo: '',
            fecha: formatDate(Date.now(), 'YYYY-MM-DD'),
            visible:true
          },
          this.img= null,
          this.dialogcarruseladd = false
          this.$q.notify({
            message:'Imagen registrada Correctamente',
            type: 'positive',
          })

        }).catch(err => {
          console.error('Error al crear:', err)
        })
      })
    },
    micarrusel(){
      this.$api.get('micarrusel').then(res=>{
        this.carrusel = res.data
        console.log(this.carrusel)
      })
    },
    getPdfUrl(archivo) {
      if (!archivo) return "";
      return `https://backend.gamo.gob.bo/${archivo}`;
    },
    Eliminar(carrusel) {
      this.$q.dialog({
        title: 'Confirmar',
        message: '¿Está seguro de eliminar esta carrusel?',
        cancel: true,
        persistent: true
      }).onOk(() => {
        this.$api.post('eliminarcarrusel', { datos: carrusel }).then(res => {
          this.carrusel = this.carrusel.filter(v => v.id !== carrusel.id);
          this.$q.notify({
            message: 'Carrusel eliminada correctamente',
            type: 'negative'
          });
        }).catch(err => {
          this.$q.notify({
            message: 'Error al eliminar la carrusel',
            type: 'warning'
          });
        });
      });
    },
    confirmarCambioEstado(carrusel, nuevoEstado) {
    this.$q.dialog({
      title: 'Confirmar',
      message: `¿Está seguro de cambiar el estado de visibilidad?`,
      cancel: true,
      persistent: true
    }).onOk(() => {
      this.$api.post('cambiarEstadocarrusel', {
        id: carrusel.id,
        visible: nuevoEstado
      }).then(res => {
        this.$q.notify({
          message: 'Estado actualizado correctamente',
          type: 'positive'
        });
        carrusel.visible = nuevoEstado; // Confirmamos visualmente el cambio
      }).catch(err => {
        this.$q.notify({
          message: 'Error al actualizar estado',
          type: 'negative'
        });
        carrusel.visible = !nuevoEstado;
      });
    }).onCancel(() => {
      carrusel.visible = !nuevoEstado;
    });
  }
  }

}
</script>
