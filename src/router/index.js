import { createRouter, createWebHistory } from "vue-router";
import HomeView from '@/pages/HomeView.vue';
import CreateView from '@/pages/CreateView.vue';
import UpdateView from '@/pages/UpdateView.vue';
import DetailView from '@/pages/DetailView.vue';
import ListView from '@/pages/ListView.vue';
import AboutView from '@/pages/AboutView.vue';

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            name: 'Home',
            component: HomeView
        },
        {
            path: '/create',
            name: 'Create',
            component: CreateView
        },
        {
            path: '/update/:id',
            name: 'Update',
            component: UpdateView
        },
        {
            path: '/detail/:id',
            name: 'Detail',
            component: DetailView
        },
        {
            path: '/list',
            name: 'List',
            component: ListView
        },
        {
            path: '/about',
            name: 'About',
            component: AboutView
        }
    ],
});
export default router;
