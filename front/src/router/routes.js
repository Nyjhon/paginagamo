const routes = [
  {
    path: '/inicio',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      { path: 'adm', component: () => import('pages/IndexPage.vue') },
      { path: 'admin/users', component: () => import('pages/UsersPage.vue') }, 
      { path: 'admin/units', component: () => import('pages/UnitsPage.vue') },
      { path: 'admin/tipos', component: () => import('src/pages/CarruselView.vue') },
      { path: 'popup', component: () => import('pages/PopupView.vue') },
      { path: 'carrusel', component: () => import('pages/CarruselView.vue') },
      { path: 'documentos', component: () => import('pages/DocumentoView.vue') },
      { path: 'noticias', component: () => import('pages/NoticiasView.vue') },
      { path: 'aplicaciones', component: () => import('pages/AppView.vue') },
    ]
  },
    // Área Pública (nuevo layout)
  {
    path: '/',
    component: () => import('layouts/PagePublicLayout.vue'),
    children: [
      { path: '/', component: () => import('src/pages/externo/InitpaginaPage.vue') },
      { path: 'historia', component: () => import('src/pages/externo/HistoryView.vue') },
      { path: 'alcalde', component: () => import('src/pages/externo/AlcaldView.vue') },
      { path: 'formularios', component: () => import('src/pages/externo/FormulariosView.vue') },
      { path: 'documentos/:id', component: () => import('src/pages/externo/DocPaginaView.vue'), props: true },
      { path: 'organigrama', component: () => import('src/pages/externo/OrganigramaView.vue')},
      { path: 'politicas-de-privacidad-app', component: () => import('src/pages/externo/PoliticasView.vue')},
    ]
  },

  {
    path: '/login', component: () => import('pages/Login.vue'),
  },

  // Ruta para manejar cualquier URL no encontrada
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/ErrorNotFound.vue')
  }
]

export default routes;
