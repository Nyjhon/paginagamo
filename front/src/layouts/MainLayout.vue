<template>
  <q-layout view="lHh Lpr lFf">
    <q-header elevated style="background-color: #5d0004;">
      <q-toolbar>
        <q-btn
          flat
          dense
          round
          icon="menu"
          aria-label="Menu"
          @click="toggleLeftDrawer"
          style="color: white;"
        />

        <q-toolbar-title>
          <div class="row">
            <div class="col-11 text-center text-white">
              ADMNISTRACIÓN DE LA PAGINA WEB DEL G.A.M.O.
            </div>
            <div class=" col-1 text-right">
              <q-btn label="Cambio de contraseña" @click="abrirdialogcambio"  color="secondary" icon="lock" size="xs"/>
            </div>
          </div>


        </q-toolbar-title>
      </q-toolbar>
      <div class="q-px-lg q-pt-xs q-mb-md" >
        <div class="text-h5 text-bold">
            <div>
              {{$store.user.name}}
            </div>
        </div>
        <div class="text-subtitle1">{{ now }}</div>
      </div>
      
      <q-img src="fondo.jpg" class="header-image absolute-top" />

      <q-dialog v-model="dialogCambio">
        <q-card style="width: 400px; max-width: 90vw;">
          <q-card-section>
            <div class="text-h6 text-center">Cambio de Contraseña</div>
          </q-card-section>

          <q-separator />

          <q-card-section>
            <q-form @submit.prevent="cambio" ref="formCambio">
              <!-- Campo Antigua Contraseña con el icono de visibilidad -->
              <q-input 
                required 
                v-model="cambiopas.passwordold" 
                label="Antigua Contraseña" 
                :type="TypePassword ? 'password' : 'text'" 
                dense 
                outlined 
                class="q-mb-md"
                :error="errorPasswordOld"
                :error-message="errorMessagePasswordOld"
              >
                <template v-slot:append>
                  <q-icon @click="TypePassword = !TypePassword" :name="TypePassword ? 'visibility' : 'visibility_off'" />
                </template>
              </q-input>

              <!-- Campo Nueva Contraseña sin el icono de visibilidad -->
              <q-input 
                required 
                v-model="cambiopas.passwordnew" 
                label="Nueva Contraseña" 
                type="password" 
                dense 
                outlined 
                class="q-mb-md"
                :error="errorPasswordNew"
                :error-message="errorMessagePasswordNew"
              />

              <!-- Campo Confirmar Contraseña sin el icono de visibilidad -->
              <q-input 
                required 
                v-model="cambiopas.passwordconf" 
                label="Confirmar Nueva Contraseña" 
                type="password" 
                dense 
                outlined 
                class="q-mb-md"
                :error="errorPasswordConf"
                :error-message="errorMessagePasswordConf"
              />

              <q-btn type="submit" label="Registrar" color="primary" class="full-width q-mb-sm" />
            </q-form>
          </q-card-section>

          <q-card-actions align="right">
            <q-btn flat label="Cerrar" color="primary" v-close-popup />
          </q-card-actions>
        </q-card>
      </q-dialog>

    </q-header>

    <q-drawer
      v-model="leftDrawerOpen"
      show-if-above
      bordered
      style="background-color: #5d0004; 
      color: white;"
    >
      <q-list>
        <q-item-label header style="padding: 0px;">
          <div style="display: flex; justify-content: center; align-items: center;">
            <q-img class="absolute-top" src="fondo.jpg" style="height: 130px; position: relative;">
            </q-img>
          </div>
        </q-item-label>

        <q-item clickable to="/inicio/adm" exact active-class="active-menu" class="menu-item">
          <q-item-section avatar>
            <q-icon name="home" />
          </q-item-section>
          <q-item-section>
            <q-item-label>INICIO</q-item-label>
            <q-item-label>Inicio</q-item-label>
          </q-item-section>
        </q-item>

        <!-- Menú desplegable de ADMINISTRACIÓN -->
        <q-expansion-item 
          label="ADMINISTRACIÓN"
          expand-separator
          switch-toggle-side
          v-if="$store.user.tipo == 1"
          >
          <template v-slot:header>

            <q-item-section>
              <q-item-label>ADMINISTRACIÓN</q-item-label>
            </q-item-section>
            <q-item-section avatar>
              <q-icon name="settings" color="white" /> <!-- Icono blanco -->
            </q-item-section>

          </template>

          <q-list>
            <q-item clickable to="/inicio/admin/users" active-class="active-menu" class="menu-subitem">
              <q-item-section>
                <q-item-label>Gestor de Usuarios</q-item-label>
              </q-item-section>
            </q-item>
            <q-item clickable to="/inicio/admin/units" active-class="active-menu" class="menu-subitem">
              <q-item-section>
                <q-item-label>Gestos de Unidades</q-item-label>
              </q-item-section>
            </q-item>
          </q-list>
        </q-expansion-item>

        <q-item clickable to="/inicio/popup" exact active-class="active-menu" class="menu-item" v-if="$store.user.unit_id == 1">
          <q-item-section avatar>
            <q-icon name="notifications_active" />
          </q-item-section>
          <q-item-section>
            <q-item-label>VENTANA EMERGENTES</q-item-label>
            <q-item-label>Notificaciones</q-item-label>
          </q-item-section>
        </q-item>

        <q-item clickable to="/inicio/carrusel" exact active-class="active-menu" class="menu-item" v-if="$store.user.unit_id == 1">
          <q-item-section avatar>
            <q-icon name="slideshow" />
          </q-item-section>
          <q-item-section>
            <q-item-label>CARRUSEL</q-item-label>
            <q-item-label>Imagenes de Presentación</q-item-label>
          </q-item-section>
        </q-item>

        <q-item clickable to="/inicio/documentos" exact active-class="active-menu" class="menu-item" v-if="$store.user.unit_id == 4 || $store.user.unit_id == 1">
          <q-item-section avatar>
            <q-icon name="description" />
          </q-item-section>
          <q-item-section>
            <q-item-label>DOCUMENTOS</q-item-label>
            <q-item-label>Publicación de archivos</q-item-label>
          </q-item-section>
        </q-item>

        <q-item clickable to="/inicio/noticias" exact active-class="active-menu" class="menu-item" v-if="$store.user.unit_id == 3 || $store.user.unit_id == 1">
          <q-item-section avatar>
            <q-icon name="article" />
          </q-item-section>
          <q-item-section>
            <q-item-label>NOTICIAS</q-item-label>
            <q-item-label>Publicación de Noticias</q-item-label>
          </q-item-section>
        </q-item>

          <q-item clickable to="/inicio/aplicaciones" exact active-class="active-menu" class="menu-item" v-if="$store.user.unit_id == 1">
          <q-item-section avatar>
            <q-icon name="apps" />
          </q-item-section>
          <q-item-section>
            <q-item-label>SERVICIOS Y APLICACIONES</q-item-label>
            <q-item-label>Sistemas Publicados</q-item-label>
          </q-item-section>
        </q-item>

        <q-item clickable @click="logout" exact active-class="menu-logout" class="menu-item">
          <q-item-section avatar>
            <q-icon name="logout" />
          </q-item-section>
          <q-item-section>
            <q-item-label>Salir</q-item-label>
            <q-item-label>Salir del sistema</q-item-label>
          </q-item-section>
        </q-item>
      </q-list>
    </q-drawer>

    <q-page-container>
      
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script>
import {date} from 'quasar'
import {globalStore} from 'stores/globalStore'
export default {
  data(){
    return{
      store:globalStore(),
      leftDrawerOpen : false,
      now :date.formatDate(Date.now(), 'dddd D  MMMM', {
        days: ['Domingo', 'Lunes','Martes','Miercoles','Jueves','Viernes','Sabado' /* and all the rest of days - remember starting with Sunday */],
        daysShort: ['Dum', 'Lun', /* and all the rest of days - remember starting with Sunday */],
        months: ['Enero', 'Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre' /* and all the rest of months */],
        monthsShort: ['Ian', 'Feb', /* and all the rest of months */]
      }),
      dialogCambio: false,
      TypePassword: true, // Controla solo la visibilidad de la contraseña antigua
      cambiopas: {
        passwordold: '',
        passwordnew: '',
        passwordconf: ''
      },
      errorPasswordOld: false,
      errorPasswordNew: false,
      errorPasswordConf: false,
      errorMessagePasswordOld: '',
      errorMessagePasswordNew: '',
      errorMessagePasswordConf: ''

    }
  },
  created() {
    if(!this.store.isLoggedIn)
    this.$router.push('/login')
  },
  methods:{
    toggleLeftDrawer () {
      this.leftDrawerOpen = !this.leftDrawerOpen
    },
    logout () {
      this.$q.loading.show()
      this.$api.post('/logout')
        .then(() => {
          this.$q.loading.hide()
          this.$router.push('/login')
        })
    },
    abrirdialogcambio(){
      this.cambiopas = {}
      this.errorPasswordOld= false,
      this.errorMessagePasswordOld= '',
      this.errorPasswordNew= false,
      this.errorMessagePasswordNew= '',
      this. errorPasswordConf= false,
      this.errorMessagePasswordConf= ''
      this.dialogCambio = true
    },
    cambio(){

      if (!this.cambiopas.passwordold) {
        this.errorPasswordOld = true;
        this.errorMessagePasswordOld = 'La antigua contraseña es requerida';
        this.errorPasswordNew= false,
        this.errorMessagePasswordNew= '',
        this. errorPasswordConf= false,
        this.errorMessagePasswordConf= ''
        return;
      }
      if (!this.cambiopas.passwordnew) {
        this.errorPasswordNew = true;
        this.errorMessagePasswordNew = 'La nueva contraseña es requerida';
        this.errorPasswordOld= false,
        this.errorMessagePasswordOld= '',
        this. errorPasswordConf= false,
        this.errorMessagePasswordConf= ''
        return;
      }

      if (this.cambiopas.passwordnew.length < 6) {
        this.errorPasswordNew = true;
        this.errorMessagePasswordNew = 'La nueva contraseña debe tener al menos 6 caracteres';
        this.errorPasswordOld= false,
        this.errorMessagePasswordOld= '',
        this. errorPasswordConf= false,
        this.errorMessagePasswordConf= ''
        return;
      }

      if (this.cambiopas.passwordnew !== this.cambiopas.passwordconf) {
        this.errorPasswordConf = true;
        this.errorMessagePasswordConf = 'Las contraseñas no coinciden';
        this.errorPasswordOld= false,
        this.errorMessagePasswordOld= '',
        this.errorPasswordNew= false,
        this.errorMessagePasswordNew= ''
        return;
      }

      this.$api.post('/updatePassword',{
        passwordold: this.cambiopas.passwordold,
        passwordnew: this.cambiopas.passwordnew
      })
        .then(res => {
          this.$q.notify({
            type: 'positive',
            message: 'Contraseña actualizada correctamente'
          });
          this.dialogCambio = false;
          this.$router.push('/login')
        })
        .catch(error => {
          this.$q.notify({
            type: 'negative',
            message: error.response?.data?.error || 'Error al cambiar la contraseña. Intenta de nuevo.'
          });

        });
    }

  },
  resetErrors() {
      this.errorPasswordOld = false;
      this.errorPasswordNew = false;
      this.errorPasswordConf = false;
      this.errorMessagePasswordOld = '';
      this.errorMessagePasswordNew = '';
      this.errorMessagePasswordConf = '';
    },

}
</script>
<style lang="scss">
.header-image{
  height: 100%;
  z-index: -1;
  opacity: 0.2;
  filter: grayscale(100%);
}
.q-item.active-menu {
  background-color:  #ffaa00;
  color: black;
}
.menu-logout {
  background-color:  #ffaa00;
  color: black;
}

.menu-item {
  color: #fff;
  transition: background-color 0.3s, color 0.3s;
}
.menu-item:hover {
  background-color: #b28f00;
  color: #fff;
}
.menu-subitem{
  margin: 0px 0px;
  color: #fff;
}
.menu-subitem:hover{
  background-color: #b28f00;
  color: #fff;
}
.color-icon{
color: #ffffff;
}
</style>

