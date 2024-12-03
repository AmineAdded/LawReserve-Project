import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";
const routes = [
  {
    path: "/",
    name: "home",
    component: HomeView,
  },
  {
    path: "/AppointmentView",
    name: "AppointmentView",
    component: () => import("../views/AppointmentView.vue"),
    props: true,
  },
  {
    path: "/LawView",
    name: "LawView",
    component: () => import("../views/LawView.vue"),
  },
  {
    path: "/viewAppointment/:serviceId",
    name: "ViewAppointment",
    component: () => import("../views/ViewAppointment.vue"),
  },
  {
    path: "/PaymentForm",
    name: "PaymentForm",
    component: () => import("../components/PaymentForm.vue"),
  },

  {
    path: "/ContactForm",
    name: "ContactForm",
    props: true,
    component: () => import("../components/ContactForm.vue"),
  },
   {
     path: "/login-signup",
     name: "login-signup",
     component: () => import("../views/LoginSignUp.vue"),
   },
   {
    path: "/componentCategory",
    name: "componentCategory",
    component: () => import("../components/componentCategory.vue"),
  },
  {
    path: "/CategoryList",
    name: "CategoryList",
    component: () => import("../views/CategoryList.vue"),
  },
  {
    path: "/AddService",
    name: "AddService",
    component: () => import("../views/AddService.vue"),
  },
  {
    path: "/DisplayService",
    name: "DisplayService",
    component: () => import("../views/DisplayService.vue"),
  },

];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
  scrollBehavior(to, from, savedPosition) {
    if (to.hash && from.name) {
      const element = document.querySelector(to.hash);
      if (element) {
        return {
          el: to.hash,
          behavior: "smooth",
        };
      }
    }
    return savedPosition || { top: 0 };
  }
  ,
});


export default router;
