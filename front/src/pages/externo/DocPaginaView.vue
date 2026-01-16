<template>
  <q-layout view="hHh LpR fFf">
    <transition name="slide-fade" class="q-pa-xl" style="background-color: #5d0004;">
      <div v-if="mostrarTitulo" >
        <div class="text-h3 text-white text-bold text-uppercase">
          {{ this.categoria.titulo }}
        </div>
        <hr>
      </div>
    </transition>
    <q-page-container style="padding: 20px;" ref="contenedorPagina">
        <q-card>
          <q-card-section>
            <div class="row q-col-gutter-md">
              <!-- Carpeta -->
              <div  class="col-12 col-md-4">
              <q-tree
                :nodes="folders"
                node-key="id"
                label-key="nombre"
                children-key="children_recursive"
                default-expand-all
              >
              <template v-slot:default-header="prop">
                <div
                  class="row items-center no-wrap q-gutter-sm full-width cursor-pointer"
                  :class="{
                    'bg-blue-1 text-primary': selectedFolderId === prop.node.id
                  }"
                  @click="handleNodeClick(prop)"
                >
                  <q-icon name="folder" class="q-mr-sm" color="secondary" style="font-size: 40px;" />
                  <div>{{ prop.node.nombre }}</div>
                </div>
              </template>
              </q-tree>

              </div>
              <!-- Documentos -->
              <div class="col-12 col-md-8" v-if="table" ref="tablaDocumentos">
                <div class="text-bold" v-if="this.ruta">{{ this.ruta }}</div>
                <q-table
                  :rows="filteredRows"
                  :columns="columns"
                  row-key="id"
                  flat
                  bordered
                  :rows-per-page-options="[10, 20, 50, 100,500]"
                >
                <template v-slot:top-right>
                  <q-input
                    outlined
                    bottom-slots
                    dense
                    debounce="250"
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
                    <q-td :props="props" style="white-space: normal;">
                      <div class="text-bold" style="font-size: 1.3em;">
                        {{ props.row.titulo }}
                      </div>
                    </q-td>
                  </template>
                <template v-slot:body-cell-contenido="props">
                  <q-td :props="props" style="white-space: normal;">
                    <div style="font-size: 1.0em;" class="text-justify">
                      <span v-if="expandedRows[props.row.id]">
                        {{ props.row.contenido }}
                        <q-btn flat dense size="sm" color="primary" @click="expandedRows[props.row.id] = false">
                          Ver menos
                        </q-btn>
                      </span>
                      <span v-else>
                        {{ props.row.contenido.substring(0, 250) }}<span v-if="props.row.contenido.length > 250">...</span>
                        <q-btn v-if="props.row.contenido.length > 250" flat dense size="sm" color="primary" @click="expandedRows[props.row.id] = true">
                          Ver más
                        </q-btn>
                      </span>
                    </div>
                  </q-td>
                </template>
                <template v-slot:body-cell-fecha="props">
                  <q-td :props="props" style="white-space: normal;">
                    <div style="font-size: 1.1em;">
                      {{ formatDate(props.row.fecha) }}
                    </div>
                  </q-td>
                </template>
                  <template v-slot:body-cell-archivo="props">
                    <q-td :props="props">
                      <q-btn
                        round
                        dense
                        flat
                        icon="visibility"
                        color="primary"
                        @click="previewFile(props.row.id)" 
                        label="Descargar"
                        v-if="props.row.archivo"
                      />
                    </q-td>
                  </template>
                </q-table>
              </div>
            </div>
          </q-card-section>
        </q-card>
    </q-page-container>

  </q-layout>
</template>
<script>
import { ref } from 'vue'

export default {
  props: ['id'],
  data () {
    return {
      mostrarTitulo: false,
      categoria: { titulo: null },
      folders: [],
      documentos: [],
      selectedNodeId: null,
      expanded: [],
      search: '',
      filter: '',
      columns: [
        { name: 'titulo', label: 'TITULO', field: 'titulo', align: 'left'},
        { name: 'contenido', label: 'CONTENIDO', field: 'contenido', align: 'left' },
        { name: 'fecha', label: 'FECHA DE PUBLICACIÓN', field: 'fecha', sortable: true, align: 'left' },
        { name: 'archivo', label: 'ENLACE', field: 'archivo' }
      ],
      selectedFolderId: null,
      folderUnico: null,
      ruta:'',
      table :false,
      expandedRows: {}
    }
  },
  mounted () {
    this.mostrarTitulo = true
    this.cargarDocumentos(this.id) // carga principal
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
    previewFile(id) {
      this.$q.loading.show({ message: 'Cargando archivo...' });

      this.$api.get(`/ver-documento/${id}`, {
        responseType: 'blob'
      })
      .then(response => {
        const blob = new Blob([response.data], { type: response.headers['content-type'] });
        const url = URL.createObjectURL(blob);
        window.open(url, '_blank'); // o crea un enlace invisible para descargar directamente
      })
      .catch(error => {
        this.$q.notify({
          type: 'negative',
          message: 'No se pudo abrir el documento.',
        });
        console.error(error);
      })
      .finally(() => {
        this.$q.loading.hide();
      });
    },

    formatDate (fechaStr) {
      if (!fechaStr) return '';
      const fecha = new Date(fechaStr);
      const dia = String(fecha.getDate()).padStart(2, '0');
      const mes = String(fecha.getMonth() + 1).padStart(2, '0');
      const año = fecha.getFullYear();
      return `${dia}/${mes}/${año}`;
    },
    clearFilter () {
      this.filter = ''
    },
    cargarDocumentos (id) {
      this.$api.get('/documentospagina/' + id).then(res => {
        console.log(res.data)
        this.categoria = res.data.categoria
        this.folders = res.data.folders // árbol de carpetas/subcarpetas
      })
    },
    handleNodeClick(prop) {
      // Forzar selección siempre
      const folderId = prop.node.id;
      this.selectedFolderId = folderId;
      // Expandir solo si se puede (si tiene hijos)
      if (typeof prop.expand === 'function') {
        prop.expand();
      }
      // Cargar documentos
      this.onSelectFolder(folderId);
    },
    onSelectFolder(folderId) {
      if (!folderId) return;
      this.clearFilter();
      this.$q.loading.show({
        message: 'Cargando documentos...',
        spinnerColor: 'primary',
      });

      this.$api.get('/documentospaginafolders/' + folderId)
        .then(res => {
          this.documentos = res.data.documentos;
          this.folderUnico = res.data.folder;
          this.ruta = res.data.ruta;
          this.table = true;

          this.$nextTick(() => {
            setTimeout(() => {
              this.$refs.contenedorPagina.scrollTop = this.$refs.tablaDocumentos.offsetTop;
              this.$refs.tablaDocumentos?.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
              });
            }, 100); // pequeño delay para asegurar render completo
          });
        })
        .catch(error => {
          console.error(error);
          this.$q.notify({
            type: 'negative',
            message: 'Ocurrió un error al cargar los documentos',
          });
        })
        .finally(() => {
          this.$q.loading.hide();
        });
    },
    filteredDocumentos (id) {
      if (!this.search) return this.documentos[id] || []
      const term = this.search.toLowerCase()
      return (this.documentos[id] || []).filter(doc =>
        doc.titulo.toLowerCase().includes(term)
      )
    }
  }
}
</script>
<style scoped>
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