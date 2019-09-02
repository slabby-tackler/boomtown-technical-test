import Vuex from 'vuex';
import Vue from 'vue';

Vue.use(Vuex);

const store = new Vuex.Store({
	state: {
		notes: {},
	},
	mutations: {
		NOTE_ADD: (state, note) => {
			Vue.set(state.notes, note.id, note);
		},
		NOTE_COLLECTION_ADD: (state, notes) => {
			for(let index in notes) {
				let note = notes[index];
				Vue.set(state.notes, note.id, note);
			}
		}
	},
	actions: {
		getNotes({ commit }) {
			return axios.get('/note')
			.then(response => {
				commit('NOTE_COLLECTION_ADD', response.data);
			});
		},
		createNote({ commit }, noteData) {
			return axios.post('/note', noteData)
			.then(response => {
				commit('NOTE_ADD', response.data);

				return response;
			})
			.catch(error => {
				return Promise.reject(error);
			});
		},
		updateNoteTitle() {

		},
		updateNoteNote() {

		},
		deleteNote() {

		}
	},
	getters: {
		getNotes: (state) => {
			return state.notes;
		},
		getNote: (state) => (id) => {
			return state.notes[id];
		}
	}
});

export default store;