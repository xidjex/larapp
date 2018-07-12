<template>

    <div id="detailsModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Квартира #{{ apartment.number }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <dl class="row">
                        
                        <dt class="col-sm-3 col-3">Этаж</dt>
                        <dd class="col-sm-9 col-9">{{ apartment.floor }}</dd>

                        <dt class="col-sm-3 col-3">Подьезд</dt>
                        <dd class="col-sm-9 col-9">{{ apartment.entrance }}</dd>

                        <dt class="col-sm-3 col-3">Набор</dt>
                        <dd class="col-sm-9 col-9"> {{ apartment.kit }}</dd>

                        <dt class="col-sm-3 col-3">Cтатус</dt>
                        <dd class="col-sm-9 col-9">
                            <span v-if="!status.edit">{{ status.names[apartment.status] }}</span>
                            <button type="button" class="btn btn-success bmd-btn-icon" @click="status.edit = !status.edit">
                                <i class="material-icons">edit</i>
                            </button>
                            <div v-if="status.edit">
                                <label class="radio-inline">
                                    <input type="radio" value="0" v-model="status.value">
                                    <span class="bmd-radio"></span>
                                    {{ status.names[0] }}
                                  </label>
                                <label class="radio-inline">
                                    <input type="radio" value="1"  v-model="status.value">
                                    <span class="bmd-radio"></span>
                                    {{ status.names[1] }}
                                  </label>
                                <label class="radio-inline">
                                    <input type="radio" value="2"  v-model="status.value">
                                    <span class="bmd-radio"></span>
                                    {{ status.names[2] }}
                                  </label>
                                <label class="radio-inline">
                                    <input type="radio" value="3"  v-model="status.value">
                                    <span class="bmd-radio"></span>
                                    {{ status.names[3] }}
                                </label>
                                <button type="button" class="btn btn-success bmd-btn-icon" @click="updateStatus(status.value)">
                                <i class="material-icons">save</i>
                            </button>
                            </div>
                        </dd>
                        
                        <dt class="col-sm-3 col-3">Создан</dt>
                        <dd class="col-sm-9 col-9">{{ apartment.created_at }}</dd>
                        
                        <dt class="col-sm-3 col-3" v-if="apartment.mount_at">Смонтирован</dt>
                        <dd class="col-sm-9 col-9" v-if="apartment.mount_at">{{ apartment.mount_at }}</dd>

                        <dt class="col-sm-3 col-3">Добавил</dt>
                        <dd class="col-sm-9 col-9">{{ apartment.user.name }}</dd>
                    </dl>

                    <h5 class="card-header">Владельцы</h5>
                    <owners-editable-list v-if='apartment' :value="apartment.owners" :show-controls="false" @add="addOwner" @remove="removeOwner"></owners-editable-list> <!--./OvnersEditableList.vue-->

                    <h5 class="card-header">Заметки</h5>
                    <div class="notes-set" v-if="apartment.notes.length > 0">
                        <div class="alert alert-success row" style="margin-left: 0; margin-right: 0;" role="alert" v-for="note in apartment.notes">
                            <span class="col-sm-10">
                                {{ note.note }}
                                <button type="button" class="btn btn-danger bmd-btn-icon" v-if="note.user_id == $root.$data.user.id" @click="removeNote(note.id)">
                                    <i class="material-icons">remove</i>
                                </button>
                            </span>
                            <strong class="float-right col-sm-2">{{ note.user.name }}</strong>
                        </div>
                    </div>
                    <div v-else class="alert alert-danger" role="alert">
                        Заметок нет
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
                    
                    <progress-bar :state="progress"></progress-bar> <!--./ProgressBar.vue-->
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger float-left" @click="remove">Удалить</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>

    import ProgressBar from './ProgressBar.vue';
    import OwnersEditableList from './OwnersEditableList.vue';

    export default {
        name: 'ApartmentDetailsModal',
        props: ['index'],  //get the index of main list in ./app.js of the displayed apartment 
        data: () => {
            return {
                note: { //data for adding note
                    note: "",
                    user_id: null,
                    apartment_id: null,
                },
                status: { //data for changing status of apartment
                    value: null,
                    edit: false,
                    names: ['Не смонт.', 'Не заверш.', 'Смонт.', 'Сдан']
                },
                progress: false
            }
        },
        components: {
            'progress-bar': ProgressBar,
            'owners-editable-list': OwnersEditableList
        },
        computed: {
            apartment() { //getting apartment data from main list in ./app.js
                return this.$root.list[this.index];
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
            removeNote(id) {
                this.progress = true;

                axios.delete('/apartment/note/' + id)
                .then((response) => {
                    this.progress = false;

                    this.$emit('update');
                })
                .catch((error) => {
                    this.progress = false;
                });
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
            removeOwner(index) {
                const owner_id = this.apartment.owners[index].id;

                this.progress = true;

                axios.delete('/apartment/owner/' + owner_id)
                .then((response) => {
                    this.progress = false;

                    this.$emit('update');
                })
                .catch((error) => {
                    this.progress = false;

                    console.error(error.request);
                });
            },
            remove() { // remove apartment
                this.progress = true;

                axios.delete('/apartment/' + this.apartment.id)
                .then((response) => {
                    this.progress = false;

                    this.$emit('update');

                    $('#detailsModal').modal('hide');
                })
                .catch((error) => {
                    this.progress = false;

                    console.error(error);
                });
            },
            updateStatus(status) {
                this.progress = true;
                
                axios.patch('/apartment/status', {apartment_id: this.apartment.id, status: status})
                .then((response) => {
                    this.progress = false;
                    
                    $('#detailsModal').modal('hide');
                    this.$emit('update');
                })
                .catch((error) => {
                    this.progress = false;

                    console.error(error);
                });
            }
        },
        mounted() {
            $('#detailsModal').modal('show');
            $('#detailsModal').on('hidden.bs.modal', () => { //emit event when dialog was close
                this.$emit('close');
            });
        }
    }

</script>
