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
						<div class="row q-pt-md q-px-md">
							<div class="col-12 text-subtitle2">
								Title <!-- TODO: icon for editing title -->
							</div>
							<div class="col-12" v-show="!editNote">
								{{ note.title }}
							</div>
							<div class="col-12" v-show="editNote">
								<!-- TODO: input box for title edit -->
							</div>
						</div>
						<div class="row q-pt-md q-px-md">
							<div class="col-12 text-subtitle2">
								Note <!-- TODO: icon for editing title -->
							</div>
							<div class="col-12" v-show="!editNote">
								{{ note.note }}
							</div>
							<div class="col-12" v-show="editNote">
								<!-- TODO: input box for title edit -->
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
				newTitle: this.note.title,
				newNote: this.note.note,
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
				// this.$store.dispatch('createNote', {title: this.newNoteTitle, note: this.newNoteNote})
				// .then((response) => {
				// 	this.$q.notify({
				// 		color: 'positive',
				// 		textColor: 'white',
				// 		icon: 'check_circle',
				// 		position: 'top',
				// 		message: 'Note successfully saved',
				// 	});

				// 	this.newNoteDialog = false;
				// })
				// .catch(error => {
				// 	this.$q.notify({
				// 		color: 'negative',
				// 		textColor: 'white',
				// 		icon: 'warning',
				// 		position: 'top',
				// 		message: 'There was an error saving note',
				// 	});
				// })
			},
		}
	}
</script>

<style scoped>
	.height-inherit {
		min-height: inherit;
	}
</style>