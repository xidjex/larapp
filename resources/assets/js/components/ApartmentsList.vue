<template>

    <table class="table table-bordered table-hover" v-if="list">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Этаж</th>
          <th scope="col">Подъезд</th>
          <th scope="col">Владельцы</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(apartment, index) in list" :class="{'table-success': apartment.status==3, 'table-primary': apartment.status==2, 'table-warning': apartment.status==1}">
          <th scope="row" @click="details(index)">{{ apartment.number }}</th>
          <td>{{ apartment.floor }}</td>
          <td>{{ apartment.entrance }}</td>
          <td>
                <div v-if="apartment.owners.length == 0">
                  Нет данных
                </div>
              <div v-else-if="apartment.owners.length == 1">
                  <span>{{ apartment.owners[0].name }}</span>
                  <a href="tel:apartment.owners[0].number ">{{ apartment.owners[0].number }}</a>
              </div>
              <div class="dropdown" v-else>
                  <a class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Показать</a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <div class="dropdown-item" v-for="owner in apartment.owners">
                          <div class="owner-item">
                              <span>{{ owner.name }}</span>
                              <a href="tel:owner.number">{{ owner.number }}</a>
                          </div>
                      </div>
                  </div>
              </div>
          </td>
        </tr>
      </tbody>
    </table>
    <h3 v-else>Список пуст!</h3>

</template>

<script>

export default {
    name: 'ApartmentsList',
    props: ['list'],
    data: () => {
        return {

        }
    },
    methods: {
        details(apartment) {
            this.$emit('details', apartment);
        }
    }
}

</script>
