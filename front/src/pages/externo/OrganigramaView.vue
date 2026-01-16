<template>
  <q-layout view="hHh LpR fFf">
    <transition name="slide-fade" class="q-pa-xl" style="background-color: #5d0004;">
      <div v-if="mostrarTitulo">
        <div class="text-h3 text-white text-bold text-uppercase">
          MANUAL DE ORGANIZACIÓN Y FUNCIONES
        </div>
        <hr />
      </div>
    </transition>
    <q-page-container>
      <template>
        <div class="q-pa-md q-gutter-md">
          <div class="row justify-between">

          <q-parallax
            src="https://cdn.quasar.dev/img/parallax2.jpg"
          >
            <h1 class="text-white">Basic</h1>
          </q-parallax>

          </div>
        </div>
      </template>
    </q-page-container>
    <q-page-container class="q-pa-md">
      <q-card>
          <div class="q-px-lg q-py-md">
            <q-timeline :layout="layout" color="secondary">
              <q-timeline-entry heading>
                MANUAL DE ORGANIZACIÓN Y FUNCIONES (MOF-2025) DEL ÓRGANO EJECUTIVO MUNICIPAL DEL GOBIERNO AUTÓNOMO MUNICIPAL DE ORURO
                <br>
                <br>
                Despacho Alcalde Municipal 
              </q-timeline-entry>
                <div style="padding-bottom: 20px;" class="text-justify">
                  Formular políticas públicas, estrategias y lineamientos institucionales, en el marco de las políticas
                  del desarrollo municipal, ejecutando planes, programas y proyectos relacionados con el Plan
                  Territorial de Desarrollo Integral (PTDI), Plan Estratégico Institucional (PEI) y el Plan Operativo
                  Anual (POA),para mejorar las condiciones de vida y elevar los niveles de bienestar social (vivir
                  bien) en el municipio de Oruro, a través de una gestión municipal eficiente, responsable y
                  transparente, en coordinación con los actores sociales e institucionales. Constituyéndose en el
                  promotor de su desarrollo integral, así como preservar, fomentar y difundir los valores culturales,
                  sociales, familiares, derechos humanos y equidad de género.
                </div>
              <q-timeline-entry
                title="Objetivo:"
                subtitle="DIRECCIÓN DE DESARROLLO ORGANIZACIONAL Y TECNOLOGÍAS DE LA INFORMACIÓN Y LAS COMUNICACIONES"
                side="left"
              >
                <div>
                  Mejorar y consolidar la capacidad organizativa del Gobierno Autónomo Municipal de Oruro,
                  enmarcadas en disposiciones generales y específicas reguladas por las Normas Básicas del
                  Sistema de Organización Administrativa (NB-SOA) y colaborar en la elaboración de la normativa
                  de los sistemas regulados por la Ley N° 1178, manuales de procedimientos administrativos y
                  reglamentos de control interno, conforme a disposiciones en vigencia.                
                </div>
              </q-timeline-entry>

              <q-timeline-entry
                title="Objetivo:"
                subtitle="DIRECCIÓN DE GESTIÓN DE RECURSOS HUMANOS"
                side="right"
              >
                <div>
                  Planificar, organizar, coordinar y controlar políticas, que promuevan el desempeño eficiente del
                  personal, mediante la implementación y ejecución de procesos de bienestar social y del Sistema
                  de Administración de Personal y su reglamento específico y la aplicación de la Ley General del
                  Trabajo, Reglamento Interno de Personal, Estatuto del Funcionario Público y otras normas
                  vigentes en materia del talento humano para el logro de los objetivos de la institución.
                </div>
              </q-timeline-entry>

              <q-timeline-entry
                title="Objetivo:"
                subtitle="DIRECCIÓN DE PLANIFICACIÓN INTEGRAL"
                side="left"
              >
                <div>
                  Contribuir en garantizar el cumplimiento de los planes de corto, mediano y largo plazo, a través
                  de instrumentos normativos metodológicos del Ministerio de Planificación del Desarrollo
                  proporcionando información de proyectos de inversión y actividades elegibles de inversión.
                </div>
              </q-timeline-entry>
              <q-timeline-entry
                title="Objetivo:"
                subtitle="DIRECCIÓN DE COMUNICACIÓN"
                side="right"
              >
                <div>
                  Formular y desarrollar políticas, proyectos, programas y acciones comunicacionales,
                  consolidando la imagen institucional del Órgano Ejecutivo del Gobierno Autónomo Municipal de
                  Oruro, transmitiendo la información oportuna y directa de las actividades del municipio hacia la
                  comunidad, en función a la visión y misión de la institución, promoviendo la imagen del municipio
                  como una institución sólida, transparente que garantice el derecho al acceso de la información en
                  favor de la población.
                </div>
              </q-timeline-entry>

              <q-timeline-entry heading>Secretaría General</q-timeline-entry>
                <div style="padding-bottom: 20px;" class="text-justify">
                  Asistir a la Alcaldesa o Alcalde Municipal, en el ejercicio de sus funciones con eficiencia y eficacia,
                  administrar y controlar los sistemas tecnológicos orientados a fortalecer un gobierno abierto digital
                  innovador y de mejora continua, procesar la documentación interna y externa que ingrese al
                  Gobierno Autónomo Municipal de Oruro, para su cumplimiento, consideración, atención de la
                  Máxima Autoridad Ejecutiva MAE, así como la despachada por éste, hacia las instancias
                  correspondientes (internas o externas), aplicando normas y procedimientos para el registro,
                  control y salvaguarda de la documentación en general; supervisar el flujo de trámites municipales
                  de atención ciudadana conforme a los canales de comunicación establecidos, brindando a los
                  usuarios internos y externos, información institucional general y específica sobre requisitos,
                  procedimientos y ubicación de los distintos tipos de trámites que son revisados y registrados.                
                </div>
              <q-timeline-entry
                title="Objetivo:"
                subtitle="UNIDAD DE SISTEMAS"
                side="left"
              >
                <div>
                  Liderar la transformación digital del Gobierno Autónomo Municipal de Oruro, mediante la
                  planificación, coordinación, gestión y supervisión integral de los servicios y sistemas de
                  información, abarcando infraestructura tecnológica, aplicaciones, gestión de datos y seguridad
                  cibernética, buscando garantizar la eficiencia, eficacia, seguridad y continuidad operativa de los
                  servicios tecnológicos, fomentando la innovación y la colaboración interinstitucional, con el
                  propósito de consolidar un gobierno abierto, transparente y centrado en el servicio a la
                  ciudadanía.                
                </div>
              </q-timeline-entry>

              <q-timeline-entry
                title="Objetivo:"
                subtitle="ARCHIVO CENTRAL"
                side="right"
              >
                <div>
                  Administrar, organizar, conservar, proteger, controlar, custodiar y mantener debidamente
                  sistematizada y organizada la documentación generada en la institución, por constituir
                  información de tipo oficial, determinando su valor administrativo, histórico o hasta la total
                  prescripción de su vigencia con la finalidad de preservar la memoria institucional de tal forma que
                  la información institucional sea recuperable para el uso de la Administración en el servicio al
                  ciudadano y como fuente de la Historia Municipal.
                </div>
              </q-timeline-entry>

              <q-timeline-entry
                title="Objetivo:"
                subtitle="GACETA MUNICIPAL AUTONÓMICA"
                side="left"
              >
                <div>
                  Publicación de manera virtual y/o impresa de Leyes Municipales, Ordenanzas Municipales,
                  Decretos Municipales, Decretos Ediles que promulguen el Órgano Legislativo o Ejecutivo y otros
                  instrumentos jurídicos emitidos por el Concejo Municipal o la Alcaldesa o Alcalde Municipal.                
                </div>
              </q-timeline-entry>

              <q-timeline-entry heading>Secretaría Municipal de Asuntos Jurídicos</q-timeline-entry>
                <div style="padding-bottom: 20px;" class="text-justify">
                  Ejercer la representación legal del Gobierno Autónomo Municipal de Oruro, realizando gestiones
                  en defensa de los bienes jurídicos, brindar asesoramiento jurídico al Despacho del Alcalde, resguardando la legalidad de los actos administrativos realizados y ser responsable del
                  patrocinio y seguimiento de todos los procesos judiciales en las diferentes materias, civil, laboral,
                  penal, administrativo, tributario, coactivo fiscal, contencioso administrativo y coactivo social,
                  acciones y recursos constitucionales y otros, debiendo otorgar seguridad jurídica a los actos en
                  defensa de los intereses del Órgano Ejecutivo del Gobierno Autónomo Municipal de Oruro y en
                  el que la institución intervenga como parte.    
                </div>
              <q-timeline-entry
                title="Objetivo:"
                subtitle="UNIDAD DE ANÁLISIS JURÍDICO"
                side="right"
              >
                <div>
                  Brindar asesoramiento legal a la entidad resguardando la legalidad así como el cumplimiento del
                  ordenamiento jurídico, nacional, departamental y municipal;, prestar asistencia jurídica en los
                  procesos de contratación en el marco de las Normas Básicas del Sistema de Administración de
                  Bienes y Servicios (NB-SABS) y emitir criterios legales respecto a la aplicación e interpretación
                  de normativa municipal vigente, así como criterios basados en análisis jurídicos a requerimientos
                  de todas las unidades organizacionales del Gobierno Autónomo Municipal de Oruro.
                </div>
              </q-timeline-entry>

              <q-timeline-entry
                title="Objetivo:"
                subtitle="UNIDAD DE DEFENSA LEGAL Y DEFENSA DEL PATRIMONIO DEL MUNICIPIO DE ORURO"
                side="left"
              >
                <div>
                  Patrocinar, supervisar, controlar y realizar seguimiento de los procesos civiles, coactivos fiscales
                  tributarios, contenciosos, contenciosos administrativos, penales, laborales, sociales y
                  constitucionales, en los que el Gobierno Autónomo Municipal de Oruro participe como parte
                  interesada o en cualquier otra condición, asumiendo la defensa técnica de los derechos,
                  intereses y patrimonio de la entidad en las instancias constitucionales, administrativas, judiciales
                  y arbitrales, enmarcados en las normativas vigentes.
                </div>
              </q-timeline-entry>

              <q-timeline-entry
                title="Objetivo:"
                subtitle="UNIDAD DE APOYO LEGAL A ÁREAS ORGANIZACIONALES"
                side="right"
              >
                <div>
                  Otorgar asesoramiento legal especializado a las Unidades Organizacionales del Órgano
                  Ejecutivo Municipal, sobre la aplicación y el cumplimento de la normativa legal en vigencia,
                  emitiendo los informes y/o criterios legales que correspondan, así como apoyar en las acciones
                  judiciales, administrativas o de otra índole legal en la que sea parte el Gobierno Autónomo
                  Municipal de Oruro.                
                </div>
              </q-timeline-entry>
              <q-timeline-entry heading>Secretaría Municipal de Gestión Territorial</q-timeline-entry>
                <div style="padding-bottom: 20px;" class="text-justify">
                  Formular políticas y estrategias de: planificación, ordenamiento territorial y gestión de territorio
                  que promuevan el desarrollo integral del municipio, para la regulación del ordenamiento y la
                  administración del territorio, en el marco del Plan Maestro, preservando el Plan Territorial del
                  Desarrollo Integral; permitiendo contribuir al mejoramiento de la calidad de vida de los habitantes
                  en función del crecimiento poblacional; así mismo, establecer políticas de gestión integral de
                  residuos, proponer y ejecutar políticas, programas y proyectos de control de la calidad que
                  protejan el medio ambiente y mitiguen sus efectos en la jurisdicción municipal de Oruro.
                </div>
              <q-timeline-entry
                title="Objetivo:"
                subtitle="DIRECCIÓN DE ORDENAMIENTO TERRITORIAL"
                side="left"
              >
                <div>
                  Supervisar y coordinar la administración de los procedimientos técnico administrativos, en
                  procesos o tramites de tierra territorio, uso de suelo y patrones de asentamiento coordinando la
                  actualización del sistema de catastro y control urbano del municipio de Oruro, proponiendo y
                  ejecutando políticas, planes, programas y proyectos de gestión territorial, ejerciendo el
                  ordenamiento territorial, a través de la implementación y generación de políticas e instrumentos
                  para la gestión territorial en aplicación a normativa vigente.
                </div>
              </q-timeline-entry>

              <q-timeline-entry
                title="Objetivo:"
                subtitle="DIRECCIÓN DE SALUD AMBIENTAL"
                side="right"
              >
                <div>
                  Formular y dirigir la implementación de las políticas, planes y programas sectoriales, proyectos
                  para la prevención, con trol y mitigación de los impactos ambientales para mejorar la resiliencia
                  al cambio climático, de la misma manera supervisar y controlar el cumplimiento de los servicios
                  de aseo, tratamiento y disposición final de residuos sólidos; Generar e implementar políticas de
                  gestión integral de residuos sólidos en el municipio de Oruro coordinando con instituciones
                  publica privadas y actores sociales en aplicación de la normativa ambiental nacional,
                  departamental y municipal. Asimismo, normar y controlar la administración de los espacios
                  recreativos; coordinando el mantenimiento.
                </div>
              </q-timeline-entry>
              <q-timeline-entry heading>Secretaría Municipal de Infraestructura Pública</q-timeline-entry>
                <div style="padding-bottom: 20px;" class="text-justify">
                  Formular y ejecutar políticas y estrategias, de planificación técnico - operativas, programas y
                  proyectos de inversión que mejoren la calidad de vida de los habitantes del municipio, a través
                  del control de la ejecución del desarrollo de la infraestructura física: urbana y vial, servicios
                  básicos, educación, salud y deportes, prevención de riesgos, tráfico y vialidad, saneamiento
                  básico (alcantarillado, drenaje urbano, alumbrado público) y posterior evaluación y monitoreo de
                  la ejecución de planes políticas y proyectos.
                </div>
              <q-timeline-entry
                title="Objetivo:"
                subtitle="DIRECCIÓN DE OBRAS Y DESARROLLO URBANO"
                side="left"
              >
                <div>
                  Realizar el seguimiento y control de los procesos de supervisión en la ejecución de obras civiles
                  por administración directa y delegada, garantizando el cumplimiento contractual y normativo para
                  asegurarla calidad de las obras y la eficiencia en su ejecución de Gestión Urbana y Territorial,
                  cumpliendo con las especificaciones y normas técnicas, cronogramas, costos, plazos y
                  disposiciones legales vigentes.
                </div>
              </q-timeline-entry>
              <q-timeline-entry
                title="Objetivo:"
                subtitle="DIRECCIÓN DE SERVICIOS ELÉCTRICOS"
                side="right"
              >
                <div>
                  Incrementar la seguridad y bienestar visual en la ciudadanía del Municipio de Oruro, con la
                  gestión del servicio de alumbrado público, semaforización, red de fibra óptica externa, planificar a
                  través de diseños técnicos la ampliación del servicio eléctrico y telecomunicación para
                  infraestructura educativa, salud, deportes, seguridad ciudadana e infraestructura urbana
                  municipal a través del monitoreo en tiempo real y brindar asistencia técnica a todas las unidades
                  organizacionales en el ámbito de sus competencias.
                </div>
              </q-timeline-entry>
                            <q-timeline-entry
                title="Objetivo:"
                subtitle="DIRECCIÓN DE INFRAESTRUCTURA EDUCACIÓN, SALUD Y DEPORTES"
                side="left"
              >
                <div>
                  Desarrollar, gestionar e implementar planes, programas y proyectos dirigidos a la construcción
                  y mantenimiento de infraestructura de educación, salud y deportes.
                </div>
              </q-timeline-entry>
              <q-timeline-entry
                title="Objetivo:"
                subtitle="DIRECCIÓN DE INFRAESTRUCTURA VIAL"
                side="right"
              >
                <div>
                  Planificar y ejecutar proyectos de pavimento (paquete estructural, carpeta de rodadura, pluvial,
                  ambiental y otros) por administración directa y delegada en infraestructura vial, mantenimiento
                  preventivo y correctivo de la infraestructura urbana municipal, garantizando la producción y
                  aplicación de carpeta de rodadura de pavimento flexible, pavimento rígido, pavimento articulado y
                  ripio. Asimismo, asignar tareas a la Sección de Maestranza y Equipo pesado para el
                  cumplimiento de los objetivos.
                </div>
              </q-timeline-entry>
              <q-timeline-entry
                title="Objetivo:"
                subtitle="DIRECCIÓN DE TRÁFICO Y VIALIDAD"
                side="left"
              >
                <div>
                  Formular políticas, planes, programas, proyectos y normativa sobre la accesibilidad de
                  transporte público, privado del tránsito urbano, apoyando a la estrategia municipal del manejo
                  del territorio e impulsando el control del sistema de movilidad eficiente y sustentable en la
                  jurisdicción Municipal de Oruro. Asimismo, supervisar las acciones operativas de Transporte en el
                  municipio para el control del tráfico vehicular, peatonal y la aplicación de sanciones, dando
                  cumplimiento a disposiciones nacionales y propias del municipio.
                </div>
              </q-timeline-entry>
              <q-timeline-entry heading>Secretaría Municipal de Economía y Hacienda</q-timeline-entry>
                <div style="padding-bottom: 20px;" class="text-justify">
                  Administrar el Sistema Tributario Municipal y la recaudación no tributaria de acuerdo a los
                  objetivos, políticas, estrategias definidos por el Gobierno Autónomo Municipal de Oruro, en base a
                  las normativas municipales y nacionales, aplicando criterios de racionalidad tributaria, elevando
                  el nivel de eficiencia de la administración de ingresos tributarios y no tributarios, estableciendo
                  planes y procedimientos de recuperación de la mora impositiva en la implementación de políticas
                  de administración tributaria y procesos de fiscalización coactiva. Cumpliendo normas y
                  reglamentos vigentes en materia tributaria, basados en principios de honestidad, transparencia,
                  licitud y veracidad, así como del control y supervisión del registro de los contribuyentes de
                  actividades económicas en general y emisión del Padrón Municipal, Licencias de Funcionamiento.
                </div>
              <q-timeline-entry
                title="Objetivo:"
                subtitle="DIRECCIÓN TRIBUTARIA Y RECAUDACIÓN"
                side="right"
              >
                <div>
                  Controlar las recaudaciones de las diferentes unidades organizacionales recaudadoras de
                  ingresos tributarios y no tributarios, como: impuestos a la propiedad de Bienes Inmuebles,
                  Vehículos Automotores, a la Transferencia; Tasas Técnicas (aprobación de planos de
                  construcción), Tasas por Servicios (Alcantarillado Sanitario), Otros Servicios Técnicos, Venta de
                  Valores Municipales, Alquileres de Nichos, Arbitrios Municipales, Centros Recreativos, Patentes,
                  Multas, Sentajes y Sitiajes y otros ingresos municipales, mediante un registro estadístico por
                  cada rubro, en base a la información obtenida de las Unidades Organizacionales recaudadoras.
                </div>
              </q-timeline-entry>
              <q-timeline-entry
                title="Objetivo:"
                subtitle="DIRECCIÓN DEL TESORO MUNICIPAL"
                side="left"
              >
                <div>
                  Supervisar, controlar y dar seguimiento a la administración financiera de los sistemas de
                  Presupuesto, Contabilidad, Tesorería y Crédito Público del Gobierno Autónomo Municipal de
                  Oruro, bajo un marco normativo común que garantice que la información contable refleje de
                  manera transparente y confiable la situación financiera y el uso de los recursos públicos con
                  criterios de eficiencia, eficacia, transparencia y legalidad. Coordinar actividades para asegurar el
                  uso eficiente, eficaz y transparente de los recursos asignados en el Plan Operativo Anual (POA).
                </div>
              </q-timeline-entry>
              <q-timeline-entry
                title="Objetivo:"
                subtitle="DIRECCIÓN DE BIENES Y SERVICIOS"
                side="right"
              >
                <div>
                  Dirigir y supervisar las actividades de las dependencias en cumplimiento estricto de la normativa
                  legal vigente y las políticas institucionales, promoviendo la transparencia en todos los procesos y
                  garantizando la correcta aplicación de las NB-SABS en los procesos de contratación, adquisición
                  de bienes y servicios y alcanzar los objetivos institucionales, optimizando el uso de los bienes
                  municipales resguardando el patrimonio del Gobierno Autónomo Municipal de Oruro.
                </div>
              </q-timeline-entry>
              <q-timeline-entry
                title="Objetivo:"
                subtitle="DIRECCIÓN DE DESARROLLO ECONÓMICO LOCAL"
                side="left"
              >
                <div>
                  Promover y apoyar el desarrollo económico local, impulsando estrategias de concertación entre el
                  sector público y productivo privado incentivando la competitividad y la innovación tecnológica,
                  mejorando el desempeño de las vocaciones económicas productivas, administrar los
                  asentamientos en mercados, centros de acopio, ferias de temporada, control al comercio en vías
                  públicas, conforme a disposiciones municipales.
                </div>
              </q-timeline-entry>
              <q-timeline-entry
                title="Objetivo:"
                subtitle="UNIDAD DE DEFENSA AL CONSUMIDOR Y CONTROL INTEGRAL"
                side="right"
              >
                <div>
                  Desarrollar tareas de prevención y protección social, comunitaria y situacional, mediante el
                  servicio a la comunidad, el apoyo operativo a otras unidades organizacionales del Gobierno
                  Autónomo Municipal de Oruro, dando cumplimiento a disposiciones y normativas vigentes.
                  Asimismo, coadyuvar en el cumplimiento, ejercicio y ejecución de las competencias establecidas
                  en las funciones de control de: Actividades Económicas, Tráfico y vialidad, Control Urbano y
                  Medio Ambiente.
                </div>
              </q-timeline-entry>
              <q-timeline-entry heading>Secretaría Municipal de Desarrollo Humano</q-timeline-entry>
                <div style="padding-bottom: 20px;" class="text-justify">
                  Desarrollar, planes, proyectos, programas y actividades que permitan mejorar la calidad de vida de
                  la población del municipio, generando mayores oportunidades de acceso a los servicios de
                  educación, de igualdad de género y de seguridad ciudadana, asimismo al desarrollo integral de
                  la primera infancia (niñas niños menores de 6 años), concertando y estableciendo mecanismos
                  de coordinación y apoyo mutuo con actores públicos y privados que dinamicen la aplicación de
                  los programas del desarrollo humano, en el marco de sus competencias.
                </div>
              <q-timeline-entry
                title="Objetivo:"
                subtitle="DIRECCIÓN DE IGUALDAD Y OPORTUNIDADES"
                side="left"
              >
                <div>
                  Formular, programas y planes locales destinados a promocionar y fortalecer la igualdad de
                  oportunidades, la equidad de género en defensa de las niñas, niños, adolescentes, jóvenes,
                  mujeres, hombres, personas adultas mayores y personas con discapacidad; priorizando la
                  atención, el seguimiento a las denuncias de toda forma de maltrato, violencia contra la mujer, la
                  familia y/o doméstica, en el marco de las disposiciones legales vigentes.
                </div>
              </q-timeline-entry>
              <q-timeline-entry
                title="Objetivo:"
                subtitle="UNIDAD DE EDUCACIÓN"
                side="right"
              >
                <div>
                  Gestionar, organizar, controlar y administrar las actividades y programas dirigidos al
                  fortalecimiento de la población escolar en sus diferentes niveles y modalidades. Generar y
                  ejecutar el programa de: Alimento Complementario Escolar; apoyo a las unidades educativas
                  fiscales y de convenio con materiales didácticos, equipamiento de laboratorios, mobiliario y pago
                  de servicios básicos; generando programas y proyectos para el fortalecimiento y expansión del
                  servicio de educación.
                </div>
              </q-timeline-entry>
              <q-timeline-entry
                title="Objetivo:"
                subtitle="UNIDAD DE SEGURIDAD CIUDADANA"
                side="left"
              >
                <div>
                  Formular proyectos, ejecutar, planes programas y actividades de seguridad ciudadana, en el
                  marco de las disposiciones y competencias municipales, coordinando acciones con la Policía
                  Boliviana en sujeción a la Política Pública Nacional de Seguridad Ciudadana y el Sistema
                  Nacional de Seguridad Ciudadana (SNSC).
                </div>
              </q-timeline-entry>
              <q-timeline-entry
                title="Objetivo:"
                subtitle="ATENCIÓN DEL NIÑ@ (PAN)"
                side="right"
              >
                <div>
                  Contribuir al desarrollo integral a la primera infancia (niñas y niños menores de 6 años) en un
                  entorno familiar saludable y protector a través de los Centros Infantiles de atención integral
                  dirigida a la población más vulnerable del Municipio de Oruro, en el marco del Programa Nacional
                  de Atención Integral al Niño, Niña. Programa de Desarrollo Inicial, regulando la organización y
                  funcionamiento de los centros infantiles, con procesos de mejoramiento continuo, para prestar un
                  servicio con calidad y calidez dirigido a la primera infancia.
                </div>
              </q-timeline-entry>
              <q-timeline-entry heading>Secretaría Municipal de Cultura</q-timeline-entry>
                <div style="padding-bottom: 20px;" class="text-justify">
                  Proteger, revalorizar, fomentar, promocionar, las expresiones artísticas, el desarrollo creativo
                  cultural, defensa del patrimonio arquitectónico cultural y el diálogo intercultural del municipio,
                  mediante la aplicación de planes y políticas de fomento, formación, salvaguarda, capacitación,
                  protección, conservación, difusión de valores culturales y el turismo, en los ámbitos: local,
                  nacional e internacional, apoyando y facilitando la provisión de infraestructura y medios que
                  permitan su esparcimiento.
                </div>
              <q-timeline-entry
                title="Objetivo:"
                subtitle="UNIDAD DE PATRIMONIO Y TURISMO"
                side="left"
              >
                <div>
                  Generar, formular y llevar a cabo planes y programas de preservación, conservación, restitución y
                  difusión del patrimonio histórico, arquitectónico, cultural, natural y turístico del municipio de
                  Oruro, con el propósito de establecer condiciones de desarrollo turístico, además de la
                  promoción del patrimonio material e inmaterial.
                </div>
              </q-timeline-entry>
              <q-timeline-entry
                title="Objetivo:"
                subtitle="UNIDAD DE GESTIÓN DEL CARNAVAL"
                side="right"
              >
                <div>
                  Proteger, planificar, organizar y promocionar el Carnaval de Oruro Obra Maestra del Patrimonio
                  Oral e Intangible de la Humanidad, en coordinación con los involucrados por la Ley N° 602 y los
                  niveles departamental y nacional mediante políticas de fomento, salvaguardia, difusión a nivel
                  local nacional e internacional, para posicionar el carnaval a nivel mundial. Consolidando y
                  diseñando estrategias de promoción y difusión del carnaval de Oruro.
                </div>
              </q-timeline-entry>
              <q-timeline-entry
                title="Objetivo:"
                subtitle="ADMINISTRACIÓN CASA MUNICIPAL DE CULTURA - TEATROS Y MUSEOS"
                side="left"
              >
                <div>
                  Administrar, controlar, preservar el mantenimiento de las instalaciones, infraestructura, mobiliario
                  y equipamiento de los ambientes de la Casa Municipal de Cultura, teatros y museos del Órgano
                  Ejecutivo, para prestar un servicio eficiente e inmediato a la ciudadanía, en cumplimiento a
                  disposiciones vigentes.
                </div>
              </q-timeline-entry>
              <q-timeline-entry
                title="Objetivo:"
                subtitle="ADMINISTRACIÓN BIBLIOTECAS, HEMEROTECAS E INTERNET"
                side="right"
              >
                <div>
                Otorgar un servicio de calidad y calidez en la difusión de material bibliográfico, hemerográfico y
                servicio de internet, a estudiantes, investigadores y ciudadanía en general a través de la provisión
                temporal. Así como mantener en buenas condiciones todo el material bibliográfico existente,
                equipamiento, mobiliario y mantenimiento de la infraestructura de la biblioteca.
                </div>
              </q-timeline-entry>
              <q-timeline-entry heading>Secretaría Municipal de Salud Integral y Deportes</q-timeline-entry>
                <div style="padding-bottom: 20px;" class="text-justify">
                  Mejorar la calidad de los servicios de Salud, a través de la gestión de políticas, planes y
                  programas municipales para la atención integral de la salud de la población del Municipio de
                  Oruro, promoviendo el Sistema Único de Salud (SUS), así la promoción al Deporte y la
                  protección, control de animales y enfermedades zoonóticas, para la prestación de servicios con
                  calidad y calidez, en el marco de una gestión participativa con actores públicos, privados y la
                  sociedad civil.
                </div>
              <q-timeline-entry
                title="Objetivo:"
                subtitle="UNIDAD DE SALUD MUNICIPAL"
                side="left"
              >
                <div>
                  Fortalecer la Red de Establecimientos Municipales de Salud, estableciendo políticas, planes,
                  programas y proyectos en salud en el marco de la gestión compartida con las entidades competentes, aplicando los procedimientos administrativos de conformidad a las normas básicas,
                  establecidas por el Órgano Rector. Administrar el Sistema Único de Salud (SUS), y realizar la supervisión de la administración del Centro Municipal de Imagenología y oxígeno.
                </div>
              </q-timeline-entry>
              <q-timeline-entry
                title="Objetivo:"
                subtitle="UNIDAD DE PROMOCIÓN DE LA ACTIVIDAD FÍSICA Y DEPORTIVA"
                side="right"
              >
                <div>
                  Proteger, planificar, organizar y promocionar el Carnaval de Oruro Obra Maestra del Patrimonio
                  Oral e Intangible de la Humanidad, en coordinación con los involucrados por la Ley N° 602 y los
                  niveles departamental y nacional mediante políticas de fomento, salvaguardia, difusión a nivel
                  local nacional e internacional, para posicionar el carnaval a nivel mundial. Consolidando y
                  diseñando estrategias de promoción y difusión del carnaval de Oruro.
                </div>
              </q-timeline-entry>
              <q-timeline-entry
                title="Objetivo:"
                subtitle="UNIDAD DE PROMOCIÓN DE LA ACTIVIDAD FÍSICA Y DEPORTIVA"
                side="left"
              >
                <div>
                  Cumplir los requerimientos para apoyar a la disciplina de natación, que permita desarrollar las
                  aptitudes competitivas y rendimientos de los deportistas; incentivando, fomentando, promoviendo
                  la práctica deportiva de la natación en especial a niñas, niños y jóvenes.
                </div>
              </q-timeline-entry>

              <q-timeline-entry heading>SUB ALCALDÍA DISTRITO -3</q-timeline-entry>
                <div style="padding-bottom: 20px;" class="text-justify">
                  Ejecutar, supervisar y operativizar las funciones delegadas por la Alcaldesa o Alcalde Municipal y
                  controlar a las Unidades desagregadas de las áreas Organizacionales en su jurisdicción territorial.
                </div>
            </q-timeline>
          </div>
      </q-card>
    </q-page-container>
  </q-layout>
</template>

<script>
import { useQuasar } from 'quasar'

export default {
  data () {
    return {
      mostrarTitulo: false,
      opciones:[
        { label: 'Secretaria General', value: 'dense' },
        { label: 'Comfortable layout', value: 'comfortable' },
        { label: 'Loose layout', value: 'loose' }
      ]
    }
  },
  computed: {
    layout () {
      const $q = useQuasar()
      return $q.screen.lt.sm ? 'dense' : ($q.screen.lt.md ? 'comfortable' : 'loose')
    }
  },
  mounted () {
    this.mostrarTitulo = true
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