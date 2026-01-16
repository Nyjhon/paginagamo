<template>
  <q-layout view="hHh LpR fFf">
    <transition name="slide-fade" class="q-pa-xl" style="background-color: #5d0004;">
      <div v-if="mostrarTitulo">
        <div class="text-h3 text-white text-bold">
          Política de Privacidad
        </div>
        <hr>
      </div>
    </transition>

    <q-page-container style="padding: 0px;">
      <q-card style="margin: 40px; padding: 40px; font-size: 1.1em; line-height: 1.6;">
        
        <div class="text-h6 text-bold">
          Fecha de última actualización: 01 de Junio de 2025
        </div>
        <p>
          El Gobierno Autónomo Municipal de Oruro (en adelante, "GAMO"), a través de la aplicación móvil ASC,
          informa a sus usuarios sobre la forma en que recopila, utiliza, protege y almacena sus datos personales
          en cumplimiento de la legislación boliviana vigente, así como las políticas internacionales aplicables
          en materia de privacidad.
        </p>

        <div class="text-h6 text-bold q-mt-md">1. Información que recopilamos</div>
        <ul>
          <li>Ubicación geográfica en tiempo real, a través del GPS del dispositivo.</li>
          <li>Datos de identificación funcional, como nombre, número de cédula de identidad, unidad administrativa y código de funcionario.</li>
          <li>Registro de hora de ingreso y salida, mediante geolocalización al momento de llegada y salida de una zona predefinida.</li>
        </ul>

        <div class="text-h6 text-bold q-mt-md">2. Finalidad del tratamiento de datos</div>
        <ul>
          <li>Verificar la presencia física de los funcionarios en sus lugares de trabajo.</li>
          <li>Registrar de forma automática y segura las horas de ingreso y salida del personal municipal.</li>
          <li>Generar reportes administrativos y de cumplimiento de horario para las unidades de Recursos Humanos y Supervisión Institucional.</li>
          <li>Mejorar la eficiencia de la gestión pública mediante tecnologías de trazabilidad y transparencia.</li>
        </ul>

        <div class="text-h6 text-bold q-mt-md">3. Base legal para el tratamiento</div>
        <ul>
          <li>Ley N.º 164, artículo 103, sobre protección de datos personales.</li>
          <li>Autorización institucional expresa del funcionario público, en el marco de sus funciones.</li>
          <li>Principios de transparencia, legalidad, necesidad y proporcionalidad establecidos en el ordenamiento jurídico boliviano.</li>
        </ul>

        <div class="text-h6 text-bold q-mt-md">4. Uso de la ubicación en segundo plano</div>
        <ul>
          <li>El funcionario haya iniciado sesión activamente.</li>
          <li>Exista una tarea activa de control de horarios.</li>
        </ul>
        <p>Esta información no se utilizará con fines comerciales ni será compartida con terceros no autorizados.</p>

        <div class="text-h6 text-bold q-mt-md">5. Compartición de información</div>
        <ul>
          <li>Unidades Organizacionales del GAMO con competencias sobre control y supervisión de personal.</li>
          <li>Entidades públicas fiscalizadoras, si así lo exige la normativa vigente.</li>
          <li>En ningún caso se venderá, comercializará ni compartirá la información con terceros privados o externos.</li>
        </ul>

        <div class="text-h6 text-bold q-mt-md">6. Seguridad de los datos</div>
        <ul>
          <li>Transmisión cifrada mediante HTTPS.</li>
          <li>Autenticación segura de los usuarios.</li>
          <li>Almacenamiento protegido en servidores institucionales del GAMO, cumpliendo estándares de disponibilidad y confidencialidad.</li>
        </ul>

        <div class="text-h6 text-bold q-mt-md">7. Derechos del usuario</div>
        <ul>
          <li>Acceder, rectificar o actualizar sus datos personales.</li>
          <li>Revocar su consentimiento para el tratamiento de ubicación, salvo que sea necesario para el cumplimiento de sus funciones laborales.</li>
          <li>Presentar reclamos ante la unidad de transparencia del GAMO si considera vulnerados sus derechos.</li>
        </ul>
        <p>
          Para ejercer estos derechos, puede contactar a:<br>
          <b>Unidad de Sistemas GAMO</b><br>
          Correo: sistemas@gamo.gob.bo<br>
          Teléfono: 252 - 52311
        </p>

        <div class="text-h6 text-bold q-mt-md">8. Conservación de datos</div>
        <p>Los datos se conservarán por el tiempo necesario para cumplir las finalidades mencionadas, o mientras persista la relación laboral del funcionario con el GAMO.</p>

        <div class="text-h6 text-bold q-mt-md">9. Cambios en la política de privacidad</div>
        <p>Cualquier cambio o modificación sustancial a esta Política será notificada a través de la aplicación y publicada en el portal web institucional del GAMO.</p>

        <div class="text-h6 text-bold q-mt-md">10. Contacto</div>
        <p>
          Para cualquier consulta relacionada con esta Política de Privacidad:<br>
          <b>Gobierno Autónomo Municipal de Oruro</b><br>
          Unidad de Sistemas<br>
          Correo electrónico: sistemas@gamo.gob.bo<br>
          Página web: <a href="https://gamo.gob.bo" target="_blank">https://gamo.gob.bo</a>
        </p>

        <p class="q-mt-lg">
          <i>Nota:</i> Esta aplicación no recopila información sin el consentimiento informado del usuario.
          Al utilizar esta aplicación, el funcionario reconoce haber leído y comprendido esta Política de Privacidad.
        </p>

      </q-card>
    </q-page-container>
  </q-layout>
</template>

<script>
import { ref } from 'vue'
  export default {
    data () {
      return {
        mostrarTitulo: false,
        slide: 0,
      }
    },
    mounted() {
       this.mostrarTitulo = true
    },
    methods: {

    }
}
</script>
<style scoped>

.text-justify {
  text-align: justify;
}
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