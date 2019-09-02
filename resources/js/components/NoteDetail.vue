<template>
	<div class="row height-inherit">
		<div class="col-12 height-inherit">
			<q-scroll-area class="fit">
				<div class="row q-pa-md">
					<div class="col">
						<div class="row items-center">
							<div class="col text-h3">
								Note
							</div>
							<div class="col-auto">
								<q-btn color="negative" label="delete" @click="deleteNote" tile="Delete Note" />
							</div>
						</div>
						<div class="row q-pt-md q-px-md" v-if="note!==undefined">
							<div class="col-12 text-subtitle2">
								Title <q-icon name="create" @click="editTitleStart" v-if="!editTitle" />
							</div>
							<div class="col-12" v-if="!editTitle">
								{{ note.title }}
							</div>
							<div class="col-12" v-if="editTitle">
								<q-input v-model="newTitle" @focusout="saveTitle" autofocus />
							</div>
						</div>
						<div class="row q-pt-md q-px-md" v-if="note!==undefined">
							<div class="col-12 text-subtitle2">
								Note <q-icon name="create" @click="editNoteStart" v-if="!editNote" />
							</div>
							<div class="col-12" v-if="!editNote">
								{{ note.note }}
							</div>
							<div class="col-12" v-if="editNote">
								<q-input type="textarea" v-model="newNote" autofocus @focusout="saveNote" />
							</div>
						</div>
					</div>
				</div>
			</q-scroll-area>
		</div>
	</div>
</template>

<script>
	export default {
		props: ['id'],
		data() {
			return {
				newTitle: '',
				newNote: '',
				editTitle: false,
				editNote: false,
			}
		},
		mounted() {
			this.$store.dispatch('getNotes');
		},
		computed: {
			note() {
				return this.$store.getters.getNote(this.id);
			}
		},
		methods: {
			goToNote(id) {
				this.$router.push('/note/' + id);
			},
			deleteNote() {
				this.$q.dialog({
					title: 'Delete Note',
					message: 'Are you sure you wish to delete this note?',
					cancel: true,
				})
				.onOk(() => {
					this.$store.dispatch('deleteNote', { id: this.id })
					.then((response) => {
						this.$q.notify({
							color: 'positive',
							textColor: 'white',
							icon: 'check_circle',
							position: 'top',
							message: 'Note successfully saved',
						});

						this.$router.push('/');
					})
					.catch(error => {
						this.$q.notify({
							color: 'negative',
							textColor: 'white',
							icon: 'warning',
							position: 'top',
							message: 'There was an error saving note',
						});
					})
				})
				
			},
			editTitleStart() {
				this.newTitle = this.note.title;

				this.editTitle = true;
			},
			editNoteStart() {
				this.newNote = this.note.note;

				this.editNote = true;
			},
			saveTitle() {
				this.editTitle = false;

				this.$store.dispatch('updateNoteTitle', { id: this.id, title: this.newTitle })
				.then(response => {
					this.$q.notify({
						color: 'positive',
						textColor: 'white',
						icon: 'check_circle',
						position: 'top',
						message: 'Title successfully saved',
					})
				})
				.catch(error => {
					this.$q.notify({
						color: 'negative',
						textColor: 'white',
						icon: 'warning',
						position: 'top',
						message: 'There was an error saving title',
					});
				})
			},
			saveNote() {
				this.editNote = false;

				this.$store.dispatch('updateNoteNote', { id: this.id, note: this.newNote })
				.then(response => {
					this.$q.notify({
						color: 'positive',
						textColor: 'white',
						icon: 'check_circle',
						position: 'top',
						message: 'Note successfully saved',
					})
				})
				.catch(error => {
					this.$q.notify({
						color: 'negative',
						textColor: 'white',
						icon: 'warning',
						position: 'top',
						message: 'There was an error saving note',
					});
				})
			}
		}
	}
</script>

<style scoped>
	.height-inherit {
		min-height: inherit;
	}
</style>