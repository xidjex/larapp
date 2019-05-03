<template>
    <div class='bg-light'>
        <ul class="list-group">
            <li class="list-group-item" v-for="(owner, index) in value">
                <div class="owner-item">
                    <span style="line-height: 35px;">{{ owner.name }}</span>
                    <a href="tel:+38" style="line-height: 35px;">{{ owner.number }}</a>
                    <button type="button" class="btn btn-danger bmd-btn-icon" v-if="edit">
                        <i class="material-icons" @click="remove(index)">remove</i>
                    </button>
                </div>
            </li>
        </ul>
        <div class="input-group" v-if="edit">
            <div class="input-group-prepend">
                <span class="input-group-text" id="" >Имя</span>
            </div>
            <input type="text" class="form-control" required v-model="name">
            <div class="input-group-prepend">
                <span class="input-group-text" id="" >Hомер</span>
            </div>
            <input type="number" class="form-control" maxlength="10" required v-model="number">
            <button type="button" class="btn btn-success bmd-btn-icon" @click="add">
                <i class="material-icons">add</i>
            </button>
        </div>
        <button type="button" class="btn btn-ou-primary" @click="edit = !edit">
            <span v-if="!edit">Редактировать</span>
            <span v-else>Скрыть</span>
        </button>
    </div>

</template>

<script>

    export default {
        name: 'OwnersEditableList',
        props: {
            value: {
                type: Array,
                default: () => []
            },
            showControls: {
                type: Boolean,
                default: () => true
            }
        },
        data: () => {
            return {
                name: '',
                number: '',
                edit: false
            }
        },
        methods: {
            add() {
                if(this.name !='' && this.number != '') {
                    this.value.push({name: this.name, number: this.number});

                    this.$emit('input', this.value);

                    this.$emit('add', {name: this.name, number: this.number});

                    this.name = this.number = '';
                } else {
                    alert('Заполните поля!');
                }
            },
            remove(index) {
                this.$emit('remove', index);

                this.value.splice(index, 1);
            }
        },
        mounted() {
            this.edit = this.showControls;
        }
    }

</script>
