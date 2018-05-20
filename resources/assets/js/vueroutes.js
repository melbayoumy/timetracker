import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

export const routes = new VueRouter({
    linkExactActiveClass: 'active',
    routes: [
        {
            name: 'tracker', 
            path: '/', 
            component: require('./components/pages/tracker/TrackerComponent.vue')
        },
        {
            name: 'tasks', 
            path: '/tasks/:page?', 
            component: require('./components/pages/tasks/TasksComponent.vue'),
        }
    ]
});
