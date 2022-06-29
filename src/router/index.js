import Vue from "vue";
import VueRouter from "vue-router";
import HomeView from "../views/HomeView.vue";

Vue.use(VueRouter);

const routes = [
  {
    path: "/",
    name: "home",
    component: HomeView,
    meta: { title: "Trang chủ" },
  },
  {
    path: "/manage",
    name: "manage",
    meta: { title: "Quản lý chi tiêu" },
    component: () => import("../views/Manage/IndexView.vue"),
  },
  {
    path: "/months",
    name: "months",
    meta: { title: "Chi tiêu các tháng" },
    component: () => import("../views/Manage/MonthView.vue"),
  },
  {
    path: "/weeks",
    name: "weeks",
    meta: { title: "Chi tiêu trong tuần" },
    component: () => import("../views/Manage/WeekView.vue"),
  },
  {
    path: "/others",
    name: "others",
    meta: { title: "Khác" },
    component: () => import("../views/Manage/OthersView.vue"),
  },
];

const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes,
});

router.beforeEach((to, from, next) => {
  document.title = to.meta.title;
  next();
});

export default router;
