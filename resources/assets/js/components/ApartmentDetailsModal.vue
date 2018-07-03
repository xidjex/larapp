<template>

    <div id="detailsModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Квартира #{{ apartment.number }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <dl class="row">

                        <dt class="col-sm-3">Этаж</dt>
                        <dd class="col-sm-9">{{ apartment.floor }}</dd>

                        <dt class="col-sm-3">Подьезд</dt>
                        <dd class="col-sm-9">{{ apartment.entrance }}</dd>


                        <dt class="col-sm-3">Набор</dt>
                        <dd class="col-sm-9"> {{ apartment.kit }}</dd>

                        <dt class="col-sm-3">Cтатус</dt>
                        <dd class="col-sm-9">{{ apartment.status }}
                            <button type="button" class="btn btn-danger bmd-btn-icon">
                                <i class="material-icons">edit</i>
                            </button>
                        </dd>

                        <dt class="col-sm-3">Добавил</dt>
                        <dd class="col-sm-9">{{ apartment.user.name }}</dd>
                    </dl>

                    <h5 class="card-header">Владельцы</h5>
                    <owners-editable-list v-if='apartment' v-model="apartment.owners" @add_owner="addOwner"></owners-editable-list>

                    <h5 class="card-header">Заметки</h5>
                    <div class="bg-light">
                        <div class="notes-set" v-if="apartment.notes.length > 0">
                            <div class="alert alert-success" role="alert" v-for="note in apartment.notes">
                                {{ note.note }}
                                <strong style="float: right;">{{ note.user.name }}</strong>
                            </div>
                        </div>
                        <div v-else class="alert alert-danger" role="alert">
                            Пусто
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Добавить заметку</span>
                            </div>
                            <input type="text" class="form-control" v-model="note.note" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                            <button type="button" class="btn btn-success bmd-btn-icon" @click="addNote()">
                                <i class="material-icons">add</i>
                            </button>
                        </div>
                        <progress-bar :state="progress"></progress-bar>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" @click="remove">Удалить</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

</template>

<script>

    import OwnersEditableList from './OwnersEditableList.vue';
    import ProgressBar from './ProgressBar.vue';

    export default {
        name: 'ApartmentDetailsModal',
        props: ['index'],
        data: () => {
            return {
                progress: false,
                note: {
                    note: "",
                    user_id: null,
                    apartment_id: null,
                }
            }
        },
        components: {
            'owners-editable-list': OwnersEditableList,
            'progress-bar': ProgressBar
        },
        computed: {
            apartment() {
                return this.$root.$data.list[this.index];
            }
        },
        methods: {
            addNote() {
                this.note.user_id = this.$root.$data.user.id;
                this.note.apartment_id = this.apartment.id;

                this.progress = true;

                axios.post('/apartment/note', this.note)
                    .then((response) => {
                        this.progress = false;

                        this.note.note = '';

                        this.$emit('update');
                    })
                    .catch((error) => {
                        this.progress = false;

                        console.error(error.response);
                    })
            },
            addOwner(owner) {
                owner.apartment_id = this.apartment.id;

                this.progress = true;

                axios.post('/apartment/owner', owner)
                    .then((response) => {
                        this.progress = false;

                        this.$emit('update');
                    })
                    .catch((error) => {
                        this.progress = false;

                        console.error(error.response);
                    })
            },
            remove() {
                this.progress = true;

                axios.delete('/apartment/' + this.apartment.id)
                .then((response) => {
                    this.progress = false;

                    this.$emit('update');

                    $('#detailsModal').modal('hide');

                    console.log(response);
                })
                .catch((error) => {
                    this.progress = false;

                    console.error(error);
                });
            }
        },
        mounted() {
            $('#detailsModal').modal('show');
            $('#detailsModal').on('hidden.bs.modal', () => {
                this.$emit('close');
            });
        }
    }

</script>
