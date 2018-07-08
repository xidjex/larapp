<template>
<div>
    <button type="button" class="btn btn-primary bmd-btn-fab position-fixed" data-toggle="modal" data-target="#exampleModalCenter" style="right: 20px; bottom: 20px;">
      <i class="material-icons">add</i>
    </button>

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Добавление объекта</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <form action="/" type="POST" class="needs-validation">
                  <div class="input-group input-group-sm mb-3">
                      <div class="input-group-prepend">
                          <span class="input-group-text">Квартира</span>
                      </div>
                      <input required type="number" v-model="apartment.number" class="form-control" aria-label="# Квартиры" aria-describedby="inputGroup-sizing-sm">
                      <div class="invalid-feedback show" v-for="error in errors.number">
                          {{ error }}
                      </div>
                  </div>

                  <div class="input-group input-group-sm mb-3">
                      <div class="input-group-prepend">
                          <span class="input-group-text">Этаж</span>
                      </div>
                      <input required type="number" v-model="apartment.floor" class="form-control" aria-label="# Квартиры" aria-describedby="inputGroup-sizing-sm">
                      <div class="invalid-feedback show" v-for="error in errors.floor">
                          {{ error }}
                      </div>
                  </div>

                  <div class="input-group input-group-sm mb-3">
                      <div class="input-group-prepend">
                          <span class="input-group-text">Подъезд</span>
                      </div>
                      <input required type="number" v-model="apartment.entrance" class="form-control" aria-label="# Квартиры" aria-describedby="inputGroup-sizing-sm">
                      <div class="invalid-feedback show" v-for="error in errors.entrance">
                          {{ error }}
                      </div>
                  </div>

                  <span class="input-group-text">Владельцы</span>

                  <owners-editable-list v-model="apartment.owners"></owners-editable-list>
                  <div class="invalid-feedback show" v-for="error in errors.owners">
                      {{ error }}
                  </div>

                  <div class="input-group input-group-sm mb-3">
                      <div class="input-group-prepend">
                          <span class="input-group-text">Комплект</span>
                      </div>
                      <input type="text" v-model="apartment.kit" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" required>
                      <div class="invalid-feedback show" v-for="error in errors.kit">
                          {{ error }}
                      </div>
                  </div>
                  <div class="input-group input-group-sm mb-3">
                      <div class="input-group-prepend">
                          <span class="input-group-text">Заметка</span>
                      </div>
                      <input type="text" v-model="apartment.note" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                  </div>
              </form>
              <progress-bar :state="progress"></progress-bar>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
            <button type="button" class="btn btn-primary" @click="save()">Сохранить</button>
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
            save() {
                this.progress = true;
                this.errors = {};

                axios.post('/apartment', this.apartment)
                    .then((response) => {
                        this.$emit('store');

                        this._cleanData();
                        this.errors = {};

                        this.progress = false;

                        $('#exampleModalCenter').modal('hide');
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
                $('#exampleModalCenter').on('hidden.bs.modal', () => {
                    this._cleanData();
                    this.errors = {};
                });
            }
    }

</script>

<style>

</style>
