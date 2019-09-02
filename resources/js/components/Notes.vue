<template>
	<div class="row height-inherit">
		<div class="col-12 height-inherit">
			<q-scroll-area class="fit">
				<div class="row q-pa-md">
					<div class="col">
						<div class="row">
							<div class="col-12 text-h3">
								Notes
							</div>
						</div>
						<div class="row q-pt-md q-px-md">
							<div v-for="note in notes" class="col-12 note-column" @click="goToNote(note.id)">
								<div class="row">
									<div class="col-12 text-subtitle1">
										{{ note.title }}
									</div>
									<div class="col-12 text-body2">
										{{ note.note }}
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</q-scroll-area>
			<q-dialog v-model="newNoteDialog">
				<q-card class="dialog-card bg-white">
					<q-card-section class="q-pa-none">
						<div class="row items-center text-h6 bg-grey-4 text-grey-9 q-pa-sm">
							<div class="col">
								Create Note
							</div>
							<div class="col-auto text-right">
								<q-btn round v-close-popup icon="clear" title="close" flat />
							</div>
						</div>
					</q-card-section>
					<q-card-section>
						<div class="row">
							<div class="col-12">
								<q-input stack-label label="title" v-model="newNoteTitle" />
							</div>
						</div>
						<div class="row">
							<div class="col-12">
								<q-input type="textarea" stack-label label="note" v-model="newNoteNote" />
							</div>
						</div>
						<div class="row q-pa-sm">
							<div class="col-12 text-right">
								<q-btn flat color="primary" label="cancel" title="cancel" @click="cancelNote" />
								<q-btn color="primary" label="save" title="save" @click="saveNote" />
							</div>
						</div>
					</q-card-section>
				</q-card>
			</q-dialog>
		</div>
		<q-page-sticky position="top-right" :offset="[18, 18]">
			<q-btn title="Add Note" icon="add" @click="newNoteDialog=true" round />
		</q-page-sticky>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				newNoteDialog: false,
				newNoteTitle: '',
				newNoteNote: '',
			}
		},
		mounted() {
			this.$store.dispatch('getNotes');
		},
		computed: {
			notes() {
				return Object.values(this.$store.getters.getNotes);
			}
		},
		methods: {
			goToNote(id) {
				this.$router.push('/note/' + id);
			},
			saveNote() {
				this.$store.dispatch('createNote', {title: this.newNoteTitle, note: this.newNoteNote})
				.then((response) => {
					this.$q.notify({
						color: 'positive',
						textColor: 'white',
						icon: 'check_circle',
						position: 'top',
						message: 'Note successfully saved',
					});

					this.newNoteDialog = false;
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
			},
			cancelNote() {
				this.newNoteTitle = '';
				this.newNoteNote = '';

				this.newNoteDialog = false;
			}
		}
	}
</script>

<style scoped>
	.height-inherit {
		min-height: inherit;
	}

	.note-column {
		border-bottom: 1px solid #000;
	}

	.note-column:hover {
		background-color: #CCC;
	}

	.dialog-card {
		min-width: 50%;
	}
</style>