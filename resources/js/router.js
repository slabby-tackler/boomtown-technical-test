import Vue from 'vue';
import VueRouter from 'vue-router';

import Notes from './components/Notes.vue';
import NoteDetail from './components/NoteDetail.vue';

Vue.use(VueRouter);

const router = new VueRouter({
	mode: 'history',
	routes:[
		{path: '/', component: Notes },
		{path: '/note/:id', component: NoteDetail },
	],
});

export default router;