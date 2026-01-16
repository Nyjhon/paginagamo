<template>
  <q-page class="q-pa-md">
    <q-card >
      <q-card-section class="q-pa-none" style="background-color: #b28f00;">
        <div class="text-h6 text-center q-pa-none text-white">Módulo de Unidades</div>
      </q-card-section>
      <q-separator />
      <q-card-actions>
        <div class="row full-width">
          <div class="col-2 flex flex-center">
            <q-btn @click="dialoganuevounits=true" color="primary" icon="person_add" label="Añadir Unidad" />
          </div>
        </div>
      </q-card-actions>
      <q-separator />
      <q-card-section class="q-pa-none">
          <q-table
            title="Lista de Unidades"
            :rows="rows"
            :columns="columns"
            row-key="id"
            :rows-per-page-options="[100]"
          >
          <!-- Slot para mostrar los documentos asignados 
          <template v-slot:body-cell-documentosAsignados="props">
            <q-td :props="props">
              <div v-if="props.row.tipos && props.row.tipos.length">
                <ul>
                  <li v-for="tipo in props.row.tipos" :key="tipo.id">{{ tipo.nombre }}</li>
                </ul>
              </div>
              <div v-else>
                Sin documentos asignados
              </div>
            </q-td>
          </template>-->

          <!-- Slots para los botones de acción -->
          <template v-slot:body-cell-opciones="props">
            <q-td :props="props">
              <q-icon
                name="edit"
                color="secondary"
                size="md"
                class="cursor-pointer"
                @click="editarUnits(props.row)"
              />
              <!-- <q-icon
                name="assignment_ind"
                color="primary"
                size="md"
                class="cursor-pointer"
                @click="abrirDialogoAsignarTipos(props.row)"
              />-->
            </q-td>
          </template>
        </q-table>

      </q-card-section>
    </q-card>
    <q-dialog v-model="dialoganuevounits" persistent>
      <q-card style="width: 700px; max-width: 80vw;"> 
        <form @submit.prevent="guardarUnits">
          <q-card-section class="text-h6">Registrar Unidad</q-card-section>
          <q-card-section>
            <q-input v-model="UnitsData.codigo" label="Código de Unidad" outlined class="uppercase-input" required/>
            <q-input v-model="UnitsData.nombre" label="Nombre de Unidad" outlined class="q-mt-md uppercase-input" required/>
          </q-card-section>
          <q-card-actions align="right">
            <q-btn flat label="Cancelar" color="primary" @click="dialoganuevounits = false" />
            <q-btn flat label="Guardar" color="primary" type='submit'/>
          </q-card-actions>
        </form>
      </q-card>
    </q-dialog>
    <q-dialog v-model="dialogaeditarunits" persistent>
      <q-card style="width: 700px; max-width: 80vw;"> 
        <form @submit.prevent="editUnits">
          <q-card-section class="text-h6">Editar Unidad</q-card-section>
          <q-card-section>
            <q-input v-model="UnitsData.codigo" label="Código de Unidad" outlined class="uppercase-input" required/>
            <q-input v-model="UnitsData.nombre" label="Nombre de Unidad" outlined class="q-mt-md uppercase-input" required/>
          </q-card-section>
          <q-card-actions align="right">
            <q-btn flat label="Cancelar" color="primary" @click="dialogaeditarunits = false" />
            <q-btn flat label="Guardar" color="primary" type='submit'/>
          </q-card-actions>
        </form>
      </q-card>
    </q-dialog>
    <!-- Dialogo para Asignar Tipos de Documento -->
    <q-dialog v-model="dialogoAsignarTipos">
      <q-card style="width: 500px; max-width: 80vw;">
        <q-card-section class="text-h6">
          Asignar Tipos de Documentos a: {{ unidadSeleccionada?.nombre }}
        </q-card-section>
        <q-card-section>
          <q-list bordered>
            <q-item v-for="tipo in tiposDocumentos" :key="tipo.id">
              <q-item-section>
                <q-checkbox
                  v-model="tiposSeleccionados"
                  :label="tipo.nombre"
                  :val="tipo.id"
                />
              </q-item-section>
            </q-item>
          </q-list>
        </q-card-section>
        <q-card-actions align="right">
          <q-btn flat label="Cancelar" color="primary" @click="dialogoAsignarTipos = false" />
          <q-btn flat label="Guardar" color="primary" @click="asignarTipos()" /> 
        </q-card-actions>
      </q-card>
    </q-dialog>


  </q-page>
</template>

<script>
export default {
  name: 'UnitsPage', // Asegúrate de que el nombre esté en formato multi-palabra
  data() {
    return {
      dialoganuevounits: false,
      dialogoAsignarTipos: false,
      dialogaeditarunits: false,
      unidadSeleccionada: null,
      tiposSeleccionados: [],
      UnitsData: {
        codigo: '',
        nombre: '',
      },
      rows: [],
      columns: [
        { name: 'codigo', label: 'Código', field: 'codigo', align: 'left' },
        { name: 'nombre', label: 'Nombre', field: 'nombre', align: 'left' },
        //{ name: 'documentosAsignados', label: 'Documentos Asignados', field: 'tipos', align: 'left' },
        { name: 'opciones', label: 'Opciones', align: 'center' }
      ],
      tiposDocumentos: [],
    };
  },
  created(){
    this.cargarUnits()
    //this.cargarTipos()
    
  },
  methods: {
    cargarUnits() {
      this.$api.get('listaunits')
        .then(res => {
          console.log(res.data)
          this.rows = res.data;
        })
        .catch(err => {
          console.error('Error al cargar usuarios:', err) // Maneja el error adecuadamente
        });
    },
    cargarTipos() {
      this.$api.get('listatipos')
        .then(res => {
          this.tiposDocumentos = res.data;
        })
        .catch(err => {
          console.error('Error al cargar usuarios:', err) // Maneja el error adecuadamente
        });
    },
    abrirDialogoAsignarTipos(unidad) {
      this.unidadSeleccionada = unidad;
      this.tiposSeleccionados = unidad.tipos ? unidad.tipos.map(tipo => tipo.id) : [];
      this.dialogoAsignarTipos = true;
    },
    asignarTipos() {
      const payload = {
        unit_id: this.unidadSeleccionada.id,
        tipos: this.tiposSeleccionados,
      };
      console.log(payload)
      this.$api.post('asignarTipos', payload)
        .then(() => {
          this.cargarUnits();
          this.dialogoAsignarTipos = false;
          this.$q.notify({ type: 'positive', message: 'Tipos asignados con éxito' });
        })
        .catch(error => {
          console.error("Error al asignar tipos:", error);
        });
    },
    guardarUnits(){
      const datos = this.UnitsData;
      this.$api.post('crearunits',datos).then(res=>{
        console.log(res.data)  
        this.cargarUnits()
        this.dialoganuevounits = false;
        this.$q.notify({
            type: 'positive',
            message: 'Unidad Creado Exitosamente'
        });
      }).catch(error => {
        console.error("Error al Crear la unidad:", error);
      });
    },
    editarUnits(Item){
      this.UnitsData.codigo = Item.codigo
      this.UnitsData.nombre = Item.nombre
      this.UnitsData.id = Item.id
      this.dialogaeditarunits = true;
    },
    editUnits(){
      const datos = this.UnitsData;
      this.$api.post('editardoc',datos).then(res=>{
        console.log(res.data)
        this.cargarUnits()
        this.dialogaeditarunits = false;
        this.$q.notify({
            type: 'positive',
            message: 'Unidad Modificado Exitosamente'
        });
      }).catch(error => {
        console.error("Error al Modificar la Unidad:", error);
      });
    }
  }
};
</script>

<style scoped>
h1 {
  color: #1976d2;
}
.uppercase-input{
  text-transform: uppercase;
}
</style>
