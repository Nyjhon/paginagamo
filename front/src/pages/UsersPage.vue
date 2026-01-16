<template>
  <q-page class="q-pa-md">
    <q-card >
      <q-card-section class="q-pa-none" style="background-color: #b28f00;">
        <div class="text-h6 text-center q-pa-none text-white">Módulo de Usuarios</div>
      </q-card-section>
      <q-separator />
      <q-card-actions>
        <div class="row full-width">
          <div class="col-2 flex flex-center">
            <q-btn @click="dialoganuevouser=true" color="primary" icon="person_add" label="Añadir usuario" />
          </div>
        </div>
      </q-card-actions>
    </q-card>

    <q-card>
      <q-card-section>
        <q-table
          :filter="filter"
          title="REGISTRO DE USUARIOS"
          :rows="data"
          dense
          :columns="columns"
          row-key="name"
          :rows-per-page-options="[10, 100, 200, 0]"
        >
          <template v-slot:top-right>
            <q-input outlined dense debounce="300" v-model="filter" placeholder="Buscar">
              <template v-slot:append>
                <q-icon name="search" />
              </template>
            </q-input>
          </template>
          
          <template v-slot:body="props">
            <q-tr :props="props">
              <q-td key="name" :props="props">{{ props.row.name }}</q-td>
              <q-td key="email" :props="props">{{ props.row.email }}</q-td>
              <q-td key="carnet" :props="props">{{ props.row.carnet }}</q-td>
              <q-td key="unidad" :props="props">{{ props.row.unit.nombre }}</q-td>
              <q-td key="fechalimite" :props="props">{{ props.row.fechalimite }}</q-td>
              <q-td key="opcion" :props="props">
                <q-icon
                  name="edit"
                  color="secondary"
                  size="md"
                  class="cursor-pointer"
                  @click="editarUser(props)"
                />
                <q-icon
                  name="vpn_key"
                  color="positive"
                  size="md"
                  class="cursor-pointer"
                  @click="cambiopass(props)"
                />
                <q-icon
                  name="delete"
                  color="negative"
                  size="md"
                  class="cursor-pointer"
                  @click="deletedUsuario(props)"
                />
              </q-td>
            </q-tr>
          </template>
        </q-table>
      </q-card-section>
    </q-card>

    <q-dialog v-model="dialoganuevouser">
      <q-card style="width: 700px;">
        <form @submit.prevent="CrearUsuario">
        <q-card-section>
          <div class="text-h6">Editar Información</div>
        </q-card-section>
        <q-card-section>
          <div class="row">
            <div class="col-12">
              <q-input v-model="crearUser.nombre" label="Nombre Completo" class="uppercase-input" required/>
              <q-input v-model="crearUser.correo" type= "email" label="Correo" required/>
            </div>
            <div class="col-6">
              <q-input v-model="crearUser.carnet" label="Carnet" type= "number" required/>
            </div>
            <div class="col-6">
              <q-input v-model="crearUser.password" label="Contraseña" type="password" required/>
            </div>
            <div class="col-6">
              <q-input v-model="crearUser.fechalimite" label="Fecha Limite" type="date" required/>
            </div>
            <div class="col-6">
              <q-select
                  filled
                  v-model="crearUser.unit"
                  label="Seleccione Unidad"
                  :options="units"
                  @filter="filterFn"
                  use-input
                  clearable
                />
            </div>
            <div class="col-6">
              <q-select 
                :options="tipos" 
                v-model="crearUser.tipo" 
                clearable
                option-value="codigo"     
                option-label="label" 
                label="Selecciona un tipo de usuario"
                />
            </div>
          </div>
        </q-card-section>
        <q-card-actions align="right">
          <q-btn flat label="Cancelar" color="primary" @click="dialoganuevouser = false" />
          <q-btn flat label="Guardar" color="primary" type='submit'/>
        </q-card-actions>
      </form>
      </q-card>
    </q-dialog>

    <q-dialog v-model="dialogedit">
      <q-card style="width: 700px;">
        <form @submit.prevent="EditUsuario">
        <q-card-section>
          <div class="text-h6">Editar Información</div>
        </q-card-section>
        <q-card-section>
          <div class="row">
            <div class="col-12">
              <q-input v-model="editUser.name" label="Nombre Completo" class="uppercase-input" required/>
              <q-input v-model="editUser.email" type= "email" label="Correo" required/>
            </div>
            <div class="col-6">
              <q-input v-model="editUser.carnet" label="Carnet" type= "number" required/>
            </div>
            <div class="col-6">
              <q-input v-model="editUser.fechalimite" label="Fecha Limite" type="date" required/>
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <q-select
                  filled
                  v-model="editUser.unitedit"
                  label="Seleccione Unidad"
                  :options="units"
                  @filter="filterFn"
                  use-input
                  clearable
                />
            </div>
            <div class="col-6">
              <q-select
                :options="tipos"
                v-model="editUser.tipoedit"
                clearable
                option-value="codigo"     
                option-label="label" 
                label="Selecciona un tipo de usuario"
              />
            </div>
          </div>
        </q-card-section>
        <q-card-actions align="right">
          <q-btn flat label="Cancelar" color="primary" @click="dialogedit = false" />
          <q-btn flat label="Guardar" color="primary" type='submit'/>
        </q-card-actions>
      </form>
      </q-card>
    </q-dialog>
    <q-dialog v-model="dialog_del">
      <q-card>
        <q-card-section class="row items-center">
          <q-avatar icon="clear" color="red" text-color="white" />
          <span class="q-ml-sm">Seguro de eliminar Registro.</span>
        </q-card-section>

        <q-card-actions align="right">
          <q-btn flat label="Eliminar" color="deep-orange" @click="onDel" />
          <q-btn flat label="Cancelar" color="primary" v-close-popup />
        </q-card-actions>
      </q-card>
    </q-dialog>


  </q-page>
</template>

<script>
import {date} from 'quasar'

const { addToDate } = date
export default {
  name: 'UsersPage', // Asegúrate de que el nombre esté en formato multi-palabra
  data() {
    return {
      crearUser: {
        nombre: '',
        correo: '',
        carnet: '',
        celular: '',
        password:'',
        fechalimite: date.formatDate(Date.now(),'YYYY-MM-DD'),
        unit:'',
        tipo:'',
      },
      editUser: {
        nombre: '',
        correo: '',
        carnet: '',
        celular: '',
        password:'',
        fechalimite: date.formatDate(Date.now(),'YYYY-MM-DD'),
        unitedit:'',
        tipoedit:'',
      },
      dialog_del:false,
      dialogedit: false,
      dialoganuevouser: false,
      titulo: 'Lista de Usuarios',
      usuarios: [],
      units:[],
      units2:[],
      tipos:[
          {label:"NORMAL",codigo:"0"},
          {label:"ADMINISTRADOR DE USUARIOS",codigo:"1"},
        ],
      data: [],
      columns: [
        { name: "name", align: "left", label: "NOMBRE", field: "name", sortable: true },
        { name: "email", align: "left", label: "E-MAIL", field: "email", sortable: true },
        { name: "carnet", align: "left", label: "Carnet", field: "carnet", sortable: true },
        { name: "unidad", align: "left", label: "UNIDAD", field: "unidad", sortable: true },
        { name: "fechalimite", align: "left", label: "FECHA LÍMITE", field: "fechalimite", sortable: true },
        { name: "opcion", label: "OPCIONES", field: "action", sortable: false }
      ],
      filter: ""
    };
  },
  created(){
    this.cargarUsuarios()
    this.cargarUnits()
    
  },
  methods: {
    cargarUsuarios() {
      this.$api.get('listausers')
        .then(res => {
          console.log(res.data)
          this.data=res.data
        })
        .catch(err => {
          console.error('Error al cargar usuarios:', err) // Maneja el error adecuadamente
        });
    },
    editarUser(item){
      this.editUser = item.row
      this.editUser.tipoedit = this.tipos.find(tipo => tipo.codigo === item.row.tipo);
      this.editUser.unitedit = item.row.unit.nombre
      this.dialogedit = true;
    },
    EditUsuario(){
      if (this.editUser.unitedit=='' || this.editUser.unitedit==undefined){
        this.$q.notify({
          message:'Debe seleccionar unidad',
          color:'red',
          icon:'error'
        })
        return false
      }
      if (this.editUser.tipoedit=='' || this.editUser.tipoedit==undefined){
        this.$q.notify({
          message:'Debe seleccionar tipo de usuario',
          color:'red',
          icon:'error'
        })
        return false
      }
      console.log(this.editUser)
      this.$api.post('editarusuario',{
      id:this.editUser.id,
      name:this.editUser.name,
      email:this.editUser.email,
      carnet: this.editUser.carnet,
      fechalimite:this.editUser.fechalimite,
      unit_id:this.editUser.unitedit.id,
      tipo:this.editUser.tipoedit.codigo 
        }).then(res=>{
          this.cargarUsuarios()
          this.$q.notify({
          message:'Editado Correctamente',
          color:'secondary',
          icon:'check_circle'
        })
        this.dialogedit = false

      }).catch(err => {
          console.error('Error al editar el usuario:', err) // Maneja el error adecuadamente
        });
    },
    cambiopass (i) {
      this.$q.dialog({
        title: 'CAMBIAR PASSWORD',
        message: 'Ingresar nueva contraseña',
        prompt: {
          model: '',
          type: 'password'
        },
        cancel: true,
        persistent: true
      }).onOk(data => {
        this.$api.post('/cambiopassword/'+i.row.id,{password:data}).then(res=>{
          console.log(res.data)
          this.$q.notify({
          color: "green-4",
          textColor: "white",
          icon: "cloud_done",
          message: "Contraseña Modificada correctamente",
        });
        })
      }).onCancel(() => {
      }).onDismiss(() => {
      })
    },
    deletedUsuario(item){
      this.dato2 = item.row;
      this.dialog_del = true;
    },
    onDel() {
      const data = {
        id: this.dato2.id
      };
      this.$api.post("deleteduser",data)
        .then((res) => {
          console.log(res.data)
          this.$q.notify({
            color: "green-4",
            textColor: "white",
            icon: "cloud_done",
            message: "Eliminado correctamente",
          });
          this.dialog_del = false;
          this.cargarUsuarios()
        }).catch(error => {
          console.error("Error al asignar tipos:", error);
        });
    },
    cargarUnits() {
      this.$api.get('listaunits')
      .then(res => {
        this.units=[]
        res.data.forEach(r=>{
          r.label=r.nombre
          this.units.push(r)
        })
        this.units2=this.units
      })
      .catch(err => {
        console.error('Error al cargar usuarios:', err)
      });
    },
    filterFn (val, update) {
      if (val === '') {
        update(() => {
          this.units = this.units2
        })
        return
      }
      update(() => {
        const needle = val.toLowerCase()
        this.units = this.units2.filter(v => v.label.toLowerCase().indexOf(needle) > -1)
      })
    },
    CrearUsuario(){
      if (this.crearUser.unit=='' || this.crearUser.unit==undefined){
        this.$q.notify({
          message:'Debe seleccionar unidad',
          color:'red',
          icon:'error'
        })
        return false
      }
      if (this.crearUser.tipo=='' || this.crearUser.tipo==undefined){
        this.$q.notify({
          message:'Debe seleccionar tipo de usuario',
          color:'red',
          icon:'error'
        })
        return false
      }
      this.$api.post('crearusuario',{
      name:this.crearUser.nombre,
      email:this.crearUser.correo,
      carnet: this.crearUser.carnet,
      password:this.crearUser.password,
      fechalimite:this.crearUser.fechalimite,
      unit_id:this.crearUser.unit.id,
      tipo:this.crearUser.tipo.codigo 
        }).then(res=>{
          this.cargarUsuarios()
          this.$q.notify({
          message:'Usuario Creado',
          color:'secondary',
          icon:'check_circle'
        })
        this.dialoganuevouser=false

      }).catch(err => {
          console.error('Error al crear el usuario:', err) // Maneja el error adecuadamente
        });
    },
  }
};
</script>

<style scoped>
h1 {
  color: #1976d2;
}
</style>
