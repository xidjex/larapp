<template>
    <div class="search">
        <div class="input-group">
            <input type="text" class="form-control" aria-label="Поиск" placeholder="Введите запрос" v-model="input">
            <div class="input-group-append">
                <button class="btn btn-outline-success dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Поиск</button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#" @click="search('owners>name')">Имя</a>
                    <a class="dropdown-item" href="#" @click="search('owners>number')">Телефон</a>
                    <a class="dropdown-item" href="#" @click="search('number')">Квартиру</a>
                    <a class="dropdown-item" href="#" @click="search('entrance')">Подьезд</a>
                    <a class="dropdown-item" href="#" @click="search('floor')" >Этаж</a>
                    <a class="dropdown-item" href="#" @click="search('notes>note')">Заметку</a>
                    <a class="dropdown-item" href="#" @click="search('kit')">Набор</a>
                    <div class="dropdown-item"> 
                        <label for="date">Дата монтажа</label>
                        <input id="date" type="date" v-model="input" @input="search('mount_at')" title="Дата монтажа"/>
                    </div>
                    <div role="separator" class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" @click="search(null)">Сбросить</a>            
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        name: 'Search',
        props: {
            value: Object
        },
        data: () => {
            return {
                date: '',
                input: null
            }
        },
        methods: {
            search(target ) {
                if (target == null) this.input = null;
                
                this.$emit('input', {target: target, query: this.input});
            }
        },
    }

</script>
