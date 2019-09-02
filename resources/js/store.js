import Vuex from 'vuex';
import Vue from 'vue';

Vue.use(Vuex);

const store = new Vuex.Store({
	state: {
		notes: {},
	},
	mutations: {
		NOTE_DELETE: (state, note) => {
			Vue.delete(state.notes, note.id);
		},
		NOTE_UPDATE_NOTE: (state, note) => {
			state.notes[note.id].note = note.note;
		},
		NOTE_UPDATE_TITLE: (state, note) => {
			state.notes[note.id].title = note.title;
		},
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
		updateNoteTitle({ commit }, note) {
			return axios.put('/note/' + note.id + '/title', note)
			.then(response => {
				commit('NOTE_UPDATE_TITLE', response.data);

				return response;
			})
			.catch(error => {
				return Promise.reject(error);
			})
		},
		updateNoteNote({ commit }, note) {
			return axios.put('/note/' + note.id + '/note', note)
			.then(response => {
				commit('NOTE_UPDATE_NOTE', response.data);
				
				return response;
			})
			.catch(error => {
				return Promise.reject(error);
			})
		},
		deleteNote({ commit }, note) {
			return axios.delete('/note/' + note.id)
			.then(response => {
				commit('NOTE_DELETE', response.data);

				return response;
			})
			.catch(error => {
				return Promise.reject(error);
			})
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