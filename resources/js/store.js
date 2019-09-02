import Vuex from 'vuex';
import Vue from 'vue';

Vue.use(Vuex);

const store = new Vuex.Store({
	state: {
		notes: {},
	},
	mutations: {
		NOTE_COLLECTION_ADD: (state, notes) => {
			for(note in notes) {
				state.notes[note.id] = note;
			}
		}
	},
	actions: {
		getNotes() {

		},
		createNote() {

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