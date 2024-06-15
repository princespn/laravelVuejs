import {createRouter, createWebHistory} from 'vue-router';
import home from '../components/common/HomePage.vue';
import login from '../components/common/LoginPage.vue';
import register from '../components/common/RegistrationPage.vue';
import profile from '../components/common/UserprofilePage.vue'
import notfound from '../components/common/NotFoundPage.vue';
import dashbord from '../components/common/DashboardPage.vue';
import logout from '../components/common/logoutPage.vue';

import products from '../components/common/ProductPage.vue';

import addproduct from '../components/common/AddProductPage.vue'



const routes = [
  {
    path: '/',
    component: home,
  },
  {
    path: '/login',
    component:login,
  
  },
  {
    path: '/register',
    component:register,
  
  },
  {
    path: '/profile',
    component:profile,
  
  },
  {
    path: '/dashbord',
    component:dashbord,
  
  },
  {
    path: '/products',
    component:products,
  
  },
  {
    path: '/add-products',
    component:addproduct,
  
  },
  
    {
      path: '/logout',
      component:logout,
      redirect: 'logout',
  
  },
  {
    path: '/:pathMatche(.*)*',
    component: notfound,
    
  },
];

const router = createRouter({
  history:createWebHistory(),
  //history: createWebHistory(process.env.BASE_URL),
  routes,
})

export default router;