<template>

    <div>  
        <!-- Floating button add new apartment -->
        <button type="button" class="btn btn-primary bmd-btn-fab position-fixed" data-toggle="modal" data-target="#addApartmentModal" style="right: 20px; bottom: 20px;">
          <i class="material-icons">add</i>
        </button>
        <!-- Floating button add new apartment -->

        <!-- Modal form adding new apartment -->
        <div class="modal fade" id="addApartmentModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Добавление объекта</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="/" type="POST" class="needs-validation">
                            <div class="input-group input-group-sm mb-3 row">
                                <div class="col-sm-3 col-4">
                                    <span class="input-group-text">Квартира</span>
                                </div>
                                <input required type="number" v-model="apartment.number" class="form-control col-sm-9 col-8" aria-label="# Квартиры">
                                <div class="invalid-feedback col-sm-12 show" v-for="error in errors.number">
                                    {{ error }}
                                </div>
                            </div>

                            <div class="input-group input-group-sm mb-3 row">
                                <div class="col-sm-3 col-4">
                                    <span class="input-group-text">Этаж</span>
                                </div>
                                <input required type="number" v-model="apartment.floor" class="form-control col-sm-9 col-8" aria-label="Этаж">
                                <div class="invalid-feedback col-sm-12 show" v-for="error in errors.floor">
                                    {{ error }}
                                </div>
                            </div>

                            <div class="input-group input-group-sm mb-3 row">
                                <div class="col-sm-3 col-4">
                                    <span class="input-group-text">Подъезд</span>
                                </div>
                                <input required type="number" v-model="apartment.entrance" class="form-control col-sm-9 col-8" aria-label="Подъезд">
                                <div class="invalid-feedback col-sm-12 show" v-for="error in errors.entrance">
                                    {{ error }}
                                </div>
                            </div>

                            <span class="input-group-text" aria-label="Владельцы">Владельцы</span>

                            <owners-editable-list v-model="apartment.owners"></owners-editable-list>
                            <div class="invalid-feedback show" v-for="error in errors.owners">
                                {{ error }}
                            </div>

                            <div class="input-group input-group-sm mb-3 row">
                                <div class="col-sm-3 col-4">
                                    <span class="input-group-text" aria-label="Комплект">Комплект</span>
                                </div>
                                <input type="text" v-model="apartment.kit" class="form-control col-sm-9 col-8" required>
                                <div class="invalid-feedback col-sm-12 show" v-for="error in errors.kit">
                                    {{ error }}
                                </div>
                            </div>
                            <div class="input-group input-group-sm mb-3 row">
                                <div class="col-sm-3 col-4">
                                    <span class="input-group-text" aria-label="Заметка">Заметка</span>
                                </div>
                                <input type="text" v-model="apartment.note" class="form-control col-sm-9 col-8">
                            </div>
                        </form>
                        
                        <progress-bar :state="progress"></progress-bar> <!--Индикатор загрузки ./ProgressBar.vue-->
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                        <button type="button" class="btn btn-primary" @click="save()">Сохранить</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal form adding new apartment -->
    </div>

</template>

<script>

    import ProgressBar from './ProgressBar.vue';
    import OwnersEditableList from './OwnersEditableList.vue';

    export default {
        name: 'AddApartmentModal',
        data: () => ({
                apartment: {
                    number: null,
                    floor: null,
                    entrance: null,
                    note: '',
                    kit: '',
                    owners: []
                },
                errors: {},
                progress: false
            }),
        components: {
            'owners-editable-list': OwnersEditableList,
            'progress-bar': ProgressBar
        },
        methods: {
            save() { //Save request
                this.progress = true;
                this.errors = {};

                axios.post('/apartment', this.apartment)
                    .then((response) => {
                        this.$emit('store');

                        this._cleanData();
                        this.errors = {};

                        this.progress = false;

                        $('#addApartmentModal').modal('hide');
                    })
                    .catch((error) => {
                        this.progress = false;

                        if (error.response && error.response.status == 422) {
                            this.errors = error.response.data;
                        } else {
                            console.error(error);
                        }
                    });
            },
            _cleanData() {
                this.apartment = {
                    number: null,
                    floor: null,
                    entrance: null,
                    note: '',
                    kit: '',
                    owners: []
                };
            }
        },
        mounted() {
                $('#addApartmentModal').on('hidden.bs.modal', () => { // Clean data when modal closing
                    this._cleanData();
                    this.errors = {};
                });
            }
    }

</script>
