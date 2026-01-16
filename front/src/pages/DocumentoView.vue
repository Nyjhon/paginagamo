<template>
  <q-page class="q-pa-md">
    <q-card>
      <q-card-section class="q-pa-none" style="background-color: #b28f00;">
        <div class="text-h6 text-center q-pa-none text-white">CATEGORIAS</div>
      </q-card-section>
      <q-separator />
      <q-card-actions>
        <div class="row full-width">
          <div class="col-2 flex flex-center">
            <q-btn @click="dialogcategoryadd = true" color="primary" icon="add" label="Añadir Nueva Categoria" />
          </div>
        </div>
      </q-card-actions>
      <q-card-section>
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3" v-for="ventana in category" :key="ventana.id">
            <q-card class="my-card q-ma-md">
              <q-card-section class="bg-primary text-white">
                <div class="text-h5">Titulo:<strong>{{ ventana.titulo }}</strong></div>
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
    <q-card>
      <q-card-section class="q-pa-none" style="background-color: #b28f00;">
        <div class="text-h6 text-center q-pa-none text-white">CARPETAS</div>
      </q-card-section>
      <q-separator />
      <q-card-actions>
        <div class="row full-width">
          <div class="col-2 flex flex-center">
            <q-btn @click="dialogcarpetaadd = true" color="primary" icon="add" label="Añadir Nueva Carpeta" />
          </div>
        </div>
      </q-card-actions>
      <q-separator />
      <q-card-section class="q-pa-none">
        <div class="q-pa-md">
          <q-tree
            :nodes="folderTree"
            node-key="id"
            label-key="label"
            children-key="children_recursive"
            color="primary"
          >
            <template v-slot:default-header="prop">
              <div class="row items-center no-wrap q-gutter-sm">
                <q-icon name="folder" class="q-mr-sm" color="secondary" style="font-size: 30px;"/>
                <div>{{ prop.node.label }}</div>
                <!-- Mostrar botón eliminar solo si NO tiene subcarpetas ni documentos -->
                <q-btn
                  v-if="(prop.node.children_recursive.length === 0) && !prop.node.tieneDocumentos"
                  icon="delete"
                  flat
                  size="sm"
                  color="negative"
                  @click.stop="eliminarCarpeta(prop.node)"
                />
              </div>
            </template>
          </q-tree>

        </div>
      </q-card-section>
    </q-card>
    <q-card>
      <q-card-section class="q-pa-none" style="background-color: #b28f00;">
        <div class="text-h6 text-center q-pa-none text-white">DOCUMENTOS</div>
      </q-card-section>
      <q-separator />
      <q-card-actions>
        <div class="row full-width">
          <div class="col-2 flex flex-center">
            <q-btn @click="dialogdocumentoadd = true" color="primary" icon="add" label="Añadir Nuevo Documento" />
          </div>
        </div>
      </q-card-actions>
      <q-card-section>
        <q-table
          title="Documentos"
          :rows="filteredRows"
          :columns="columnasDocumentos"
          row-key="id"
          bordered
          class="q-mt-md"
          :pagination="{ rowsPerPage: 10 }"
        >
          <template v-slot:top-right>
            <q-input
              outlined
              bottom-slots
              dense
              debounce="300"
              v-model="filter"
              placeholder="Buscar"
            >
              <template v-slot:append>
                <q-icon v-if="filter !== ''" name="close" @click="clearFilter" class="cursor-pointer" />
                <q-icon name="search" />
              </template>
            </q-input>
          </template>
          <template v-slot:body-cell-titulo="props">
            <q-td :props="props">
              {{ props.row.titulo }}
              <q-tooltip class="bg-primary text-withe shadow-4" :offset="[10, 10]">
                RUTA: {{ props.row.ruta }}
              </q-tooltip>
              <div class="text-bold text-uppercase" style="color: #5d0004;">
                {{ props.row.folder.category.titulo }}
              </div>
            </q-td>
          </template>
          <template v-slot:body-cell-contenido="props">
            <q-td :props="props" style="white-space: normal;">
              {{ props.row.contenido }}
            </q-td>
          </template>
          <template v-slot:body-cell-archivo_url="props">
            <q-td :props="props">
              <q-btn
                flat
                round
                icon="cloud_download"
                @click="getDocUrl(props.row.archivo_url)"
                color="primary"
                size="lg" 
                target="_blank"
                v-if="props.row.archivo"
              />
            </q-td>
          </template>
          <template v-slot:body-cell-visible="props">
            <q-td :props="props">
              <q-btn
                flat
                round
                dense
                @click="CambioEstadoDoc(props.row)"
                :icon="props.row.visible ? 'visibility' : 'visibility_off'"
                :color="props.row.visible ? 'green' : 'red'"
                size="lg"
              />

            </q-td>
          </template>
          <template v-slot:body-cell-acciones="props">
            <q-td :props="props">
              <q-btn 
                icon="edit" 
                color="primary" 
                round 
                dense 
                @click="editarDocumento(props.row)" 
                title="Editar documento"
              />
            </q-td>
          </template>

        </q-table>

      </q-card-section>
    </q-card>
    

    <q-dialog v-model="dialogcategoryadd" persistent>
      <q-card style="width: 700px;">
        <q-form @submit="CrearCategory" enctype="multipart/form-data">
          <q-card-section class="text-h6 text-center">
            REGISTRAR NUEVA CATEGORIA DE DOCUMENTO
            <hr />
            <div class="row q-col-gutter-md">
              <div class="col-12">
                <q-input v-model="docCategory.titulo" label="Título" outlined class="uppercase-input" required />
              </div>
              <div class="col-4">
                <q-input label="Fecha" outlined type="date" v-model="docCategory.fecha" class="q-mt-md" readonly />
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
                  v-model="docCategory.visible"
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
    <q-dialog v-model="dialogcarpetaadd" persistent>
      <q-card style="width: 600px;">
        <q-form @submit="crearCarpeta">
          <q-card-section class="text-h6 text-center">
            REGISTRAR NUEVA CARPETA
            <hr />
            <div class="row q-col-gutter-md">
              <div class="col-12">
                <q-input v-model="nuevaCarpeta.nombre" label="Nombre de Carpeta" outlined required />
              </div>
              <div class="col-12">
                <q-select
                  v-model="nuevaCarpeta.category_id"
                  :options="category"
                  label="Seleccionar Categoría"
                  option-label="titulo"
                  option-value="id"
                  emit-value
                  map-options
                  outlined
                  required
                />
              </div>
              <div class="col-12">
                <q-select
                  v-model="nuevaCarpeta.parent_id"
                  :options="carpetasPadre"
                  label="¿Subcarpeta de?"
                  option-label="nombre"
                  option-value="id"
                  emit-value
                  map-options
                  outlined
                  clearable
                />
              </div>
            </div>
          </q-card-section>
          <q-card-actions align="right">
            <q-btn flat label="Cancelar" color="primary" @click="dialogcarpetaadd = false" />
            <q-btn flat label="Guardar" color="negative" type="submit" />
          </q-card-actions>
        </q-form>
      </q-card>
    </q-dialog>
    <q-dialog v-model="dialogdocumentoadd" persistent>
      <q-card style="width: 700px;">
        <q-form @submit="crearDocumento" enctype="multipart/form-data">
          <q-card-section class="text-h6 text-center">
            REGISTRAR NUEVO DOCUMENTO
            <hr />
            <div class="row q-col-gutter-md">
              <div class="col-12">
                <q-input v-model="documento.titulo" label="Título" outlined required />
              </div>
              <div class="col-12">
                <q-input v-model="documento.contenido" label="Descripción" outlined type="textarea" required/>
              </div>
              <div class="col-6">
                <q-input label="Fecha" type="date" outlined v-model="documento.fecha" required disable/>
              </div>
              <div class="col-6">
                <q-file color="teal" v-model="archivo" outlined counter label="Subir Archivo" accept=".pdf">
                  <template v-slot:prepend>
                    <q-icon name="cloud_upload" />
                  </template>
                </q-file>
              </div>
              <div class="col-6">
                <q-select
                  v-model="nuevaCarpeta.category_id"
                  :options="category"
                  label="Seleccionar Categoría"
                  option-label="titulo"
                  option-value="id"
                  emit-value
                  map-options
                  outlined
                  :rules="[val => !!val || 'Debe seleccionar una categoría']"
                />
              </div>
              <div class="col-6">
                <q-select
                  v-model="nuevaCarpeta.parent_id"
                  :options="carpetasPadre"
                  label="Seleccione la carpeta"
                  option-label="nombre"
                  option-value="id"
                  emit-value
                  map-options
                  outlined
                  clearable
                  :rules="[val => val !== null || 'Debe seleccionar una carpeta']"
                />
              </div>
              <div class="col-12">
                <q-toggle v-model="documento.visible" label="Visible" checked-icon="check" unchecked-icon="close" color="green" />
              </div>
            </div>
          </q-card-section>
          <q-card-actions align="right">
            <q-btn flat label="Cancelar" color="primary" @click="dialogdocumentoadd = false" />
            <q-btn flat label="Guardar" color="negative" type="submit" />
          </q-card-actions>
        </q-form>
      </q-card>
    </q-dialog>
    <q-dialog v-model="dialogEditar" persistent>
      <q-card style="width: 700px;">
        <q-form @submit.prevent="guardarCambios" enctype="multipart/form-data">
          <q-card-section class="text-h6 text-center">
            EDITAR DOCUMENTO
            <hr />
            <div class="row q-col-gutter-md">
              <div class="col-12">
                <q-input v-model="docSeleccionado.titulo" label="Título" outlined required />
              </div>
              <div class="col-12">
                <q-input v-model="docSeleccionado.contenido" label="Descripción" outlined type="textarea" required />
              </div>
              <div class="col-6">
                <q-input label="Fecha" type="date" outlined v-model="docSeleccionado.fecha" required disable/>
              </div>
              <div class="col-6">
                <q-file
                  color="teal"
                  v-model="archivo"
                  outlined
                  counter
                  :required="false"
                  label="Reemplazar Archivo (opcional)"
                  accept=".pdf"
                >
                  <template v-slot:prepend>
                    <q-icon name="cloud_upload" />
                  </template>
                </q-file>
              </div>
              <div class="col-6">
                <q-select
                  v-model="nuevaCarpeta.category_id"
                  :options="category"
                  label="Seleccionar Categoría"
                  option-label="titulo"
                  option-value="id"
                  emit-value
                  map-options
                  outlined
                />
              </div>
              <div class="col-6">
                <q-select
                  v-model="nuevaCarpeta.parent_id"
                  :options="carpetasPadre"
                  label="Seleccione la carpeta"
                  option-label="nombre"
                  option-value="id"
                  emit-value
                  map-options
                  outlined
                  clearable
                />
              </div>
            </div>
          </q-card-section>
          <q-card-actions align="right">
            <q-btn flat label="Cancelar" color="primary" @click="dialogEditar = false" />
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
      dialogcategoryadd: false,
      docCategory: {
        titulo: '',
        fecha: formatDate(Date.now(), 'YYYY-MM-DD'),
        visible:true
      },
      img: null,
      imagePreview: null,
      category: [],
      dialogcarpetaadd: false,
      nuevaCarpeta: {
        nombre: '',
        category_id: null,
        parent_id: null
      },
      carpetasPadre: [],
      folderTree: [],
      dialogdocumentoadd: false,
      documento: {
        titulo: '',
        contenido: '',
        fecha: formatDate(Date.now(), 'YYYY-MM-DD'),
        folders_id: null,
        visible: true
      },
      archivo: null,
      carpetasDisponibles: [],
      documentos: [],
      columnasDocumentos: [
        { name: 'titulo', label: 'Título', field: 'titulo', align: 'left', sortable: true },
        { name: 'contenido', label: 'Contenido', field: 'contenido', align: 'left', sortable: true },
        { name: 'fecha', label: 'Fecha Publicación', field: 'fecha', align: 'left', sortable: true },
        { name: 'visible', label: 'Visible', field: 'visible', align: 'center' },
        { name: 'archivo_url', label: 'Archivo', field: 'archivo_url', align: 'center' },
        { name: 'acciones', label: 'Acciones', align: 'center' }
      ],
      filter: '',
      dialogEditar: false,
      docSeleccionado: {}
    }
  },
  created(){
    this.micategory();
    this.cargarCarpetas();
    this.misdocumentos();
  },
  watch: {
    'nuevaCarpeta.category_id'(val) {
      if (val) this.obtenercarpetas(val)
    }
  },
  computed: {
    filteredRows() {
      if (!this.filter) {
        return this.documentos;
      }
      const search = this.filter.toLowerCase();
      return this.documentos.filter(row => 
        Object.values(row).some(value =>
          String(value).toLowerCase().includes(search)
        )
      );
    }
  },
  methods: {
    onImageSelected(event) {
      const file = event.target.files[0]
      if (file) {
        this.img = file
        this.imagePreview = URL.createObjectURL(file)
      }
    },
    CrearCategory() {
      this.$q.dialog({
        title: 'Confirmación',
        message: '¿Está seguro de crear el registro?',
        ok: { push: true },
        cancel: { push: true, color: 'negative' },
        persistent: true
      }).onOk(() => {
        const formData = new FormData()
        formData.append('titulo', this.docCategory.titulo)
        formData.append('fecha', this.docCategory.fecha)
        formData.append('visible', this.docCategory.visible ? '1' : '0')
        if (this.img) {
          formData.append('img', this.img);
        }
        this.$q.loading.show();
        this.$api.post('crearcategory', formData, {
          headers: {
            'Content-Type': 'multipart/form-data'
          }
        }).then(res => {
          console.log(res.data)
          this.$q.loading.hide();
          this.docCategory = {
            titulo: '',
            fecha: formatDate(Date.now(), 'YYYY-MM-DD'),
            visible:true
          },
          this.img= null,
          this.imagePreview= null,
          this.dialogcategoryadd = false
          this.micategory();
          this.cargarCarpetas();
          this.$q.notify({
            message:'Categoria de documentos creado Correctamente',
            type: 'positive',
          })

        }).catch(err => {
          console.error('Error al crear:', err)
        })
      })
    },
    micategory(){
      this.$api.get('micategory').then(res=>{
        this.category = res.data
      })
    },
    getPdfUrl(archivo) {
      if (!archivo) return "";
      return `https://backend.gamo.gob.bo/${archivo}`;
    },
    getDocUrl(archivo){
      window.open(`https://backend.gamo.gob.bo/${archivo}`, '_blank');
    },
    Eliminar(categoria) {
      this.$q.dialog({
        title: 'Confirmar',
        message: '¿Está seguro de eliminar esta ventana?',
        cancel: true,
        persistent: true
      }).onOk(() => {
        this.$api.post('eliminarcategory', { datos: categoria }).then(res => {
          this.micategory()
          this.cargarCarpetas();
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
    },
    obtenercarpetas(categoryId) {
      this.$api.get(`folders/categoria/${categoryId}`).then(res => {
        this.carpetasPadre = res.data
      })
    },
    crearCarpeta() {
      this.$api.post('folders/crear', this.nuevaCarpeta).then(res => {
        this.$q.notify({ type: 'positive', message: 'Carpeta creada' })
        this.dialogcarpetaadd = false
        this.nuevaCarpeta = { nombre: '', category_id: null, parent_id: null }
        this.cargarCarpetas()
      })
    },
    cargarCarpetas() {
      this.$api.get('/folders/arbol').then(res => {
        const agrupado = {};
        res.data.forEach(carpeta => {
          const categoriaId = carpeta.category_id;
          if (!agrupado[categoriaId]) {
            agrupado[categoriaId] = {
              id: `cat-${categoriaId}`,
              label: this.obtenerNombreCategoria(categoriaId), // función que busca el nombre
              children_recursive: []
            };
          }
          agrupado[categoriaId].children_recursive.push(this.formatearNodo(carpeta));
        });

        this.folderTree = Object.values(agrupado);
      });
    },
    obtenerNombreCategoria(id) {
      const cat = this.category.find(c => c.id === id);
      return cat ? cat.titulo : `Categoría ${id}`;
    },
    formatearNodo(carpeta) {
      return {
        id: carpeta.id,
        label: carpeta.nombre,
        children_recursive: (carpeta.children_recursive || []).map(this.formatearNodo),
        tieneDocumentos: carpeta.documents && carpeta.documents.length > 0
      };
    },
    eliminarCarpeta(nodo) {
      this.$q.dialog({
        title: 'Confirmar',
        message: `¿Eliminar la carpeta "${nodo.label}"?`,
        cancel: true,
        persistent: true
      }).onOk(() => {
        this.$api.get(`/folders/eliminar/${nodo.id}`).then(res => {
          if (res.data.error) {
            this.$q.notify({ type: 'negative', message: res.data.message });
          } else {
            this.$q.notify({ type: 'positive', message: res.data.message });
            this.cargarCarpetas(); // Recargar árbol
          }
        }).catch(() => {
          this.$q.notify({ type: 'negative', message: 'Error al intentar eliminar la carpeta.' });
        });
      });
    },
    misdocumentos() {
      this.$q.loading.show();
      this.$api.get('misdocumentos').then(res => {
        this.documentos = res.data.map(doc => {
          return {
            ...doc,
            fecha: doc.fecha?.substring(0, 10) // corta solo la fecha (YYYY-MM-DD)
          }
        });
      })
      .catch(err => {
        this.$q.notify({ type: 'negative', message: 'Error al cargar documentos' });
      })
      .finally(() => {
        this.$q.loading.hide();
      });
    },
    onArchivoSelected(event) {
      const file = event.target.files[0];
      if (file) {
        this.archivo = file;
      }
    },
    crearDocumento() {
      this.$q.dialog({
        title: 'Confirmación',
        message: '¿Desea registrar el documento?',
        cancel: true,
        persistent: true
      }).onOk(() => {
        this.$q.loading.show()
        const formData = new FormData();
        formData.append('titulo', this.documento.titulo);
        formData.append('contenido', this.documento.contenido || '');
        formData.append('fecha', this.documento.fecha);
        formData.append('folders_id', this.nuevaCarpeta.parent_id);
        formData.append('visible', this.documento.visible ? '1' : '0');
        if (this.archivo) {
          formData.append('archivo', this.archivo);
        }
        this.$q.loading.show();
        this.$api.post('/documents/crear', formData, {
          headers: { 'Content-Type': 'multipart/form-data' }
        }).then(res => {
          console.log(res.data)
          this.$q.loading.hide();
          this.$q.notify({ type: 'positive', message: 'Documento registrado' });
          this.dialogdocumentoadd = false;
          this.documento = {
            titulo: '',
            contenido: '',
            fecha: formatDate(Date.now(), 'YYYY-MM-DD'),
            visible: true
          };
          this.nuevaCarpeta= {
            category_id: null,
            parent_id: null
          },
          this.archivo = null;
          this.misdocumentos();
        }).catch(err => {
          console.log(err)
          this.$q.loading.hide();
          this.$q.notify({ type: 'negative', message: 'Error al registrar documento' });
        }).finally(() => {
          this.$q.loading.hide();
        });
      });
    },
    clearFilter() {
      this.filter = '';
    },
    CambioEstadoDoc(documento) {
      this.$q.dialog({
        title: 'Confirmar',
        message: `¿Está seguro de cambiar el estado de visibilidad?`,
        cancel: true,
        persistent: true
      }).onOk(() => {
          const nuevoEstado = documento.visible ? 0 : 1;
          this.$q.loading.show();
          this.$api.post(`/documents/cambiarestado/${documento.id}`, { visible: nuevoEstado })
            .then(() => {
              documento.visible = nuevoEstado;
              this.$q.notify({
                type: 'positive',
                message: `El documento ahora está ${nuevoEstado ? 'visible' : 'oculto'}.`,
              });
            })
            .catch(() => {
              this.$q.notify({
                type: 'negative',
                message: 'Error al cambiar el estado del documento.',
              });
            })
            .finally(() => {
              this.$q.loading.hide();
            });
      }).onCancel(() => {
      });
    },
    editarDocumento(doc) {
      this.docSeleccionado = { ...doc }  // Copia los datos para editar
      this.dialogEditar = true           // Muestra el diálogo
    },
    guardarCambios() {
    this.$q.dialog({
        title: 'Confirmar',
        message: `¿Está seguro de Modificar el Registro?`,
        cancel: true,
        persistent: true
      }).onOk(() => {
      const form = new FormData()
      this.$q.loading.show()
      form.append('titulo', this.docSeleccionado.titulo)
      form.append('contenido', this.docSeleccionado.contenido)
      form.append('folders_id', this.nuevaCarpeta.parent_id !== null ? this.nuevaCarpeta.parent_id : '');
      if (this.archivo) {
        form.append('archivo', this.archivo)
      }
      this.$api.post(`/documents/editar/${this.docSeleccionado.id}`, form, {
          headers: { 'Content-Type': 'multipart/form-data' }
        })
        .then(res => {
          console.log(res.data)
          this.dialogEditar = false
          this.misdocumentos()
          this.documento = {
            titulo: '',
            contenido: '',
            fecha: formatDate(Date.now(), 'YYYY-MM-DD'),
          };
          this.nuevaCarpeta= {
            category_id: null,
            parent_id: null
          },
          this.archivo = null;
          this.$q.notify({ type: 'positive', message: 'Documento actualizado' })
        })
        .catch(err => {
          this.$q.notify({ type: 'negative', message: 'Error al actualizar' })
        }).finally(() => {
          this.$q.loading.hide();
        });

      });
    }

  }
}
</script>
<style scoped>

</style>
