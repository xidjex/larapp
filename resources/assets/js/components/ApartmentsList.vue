<template>

    <table class="table table-bordered table-hover" v-if="apartments">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Этаж</th>
          <th scope="col">Подъезд</th>
          <th scope="col">Владельцы</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(apartment, index) in apartments" :class="{'table-success': apartment.status==3, 'table-primary': apartment.status==2, 'table-warning': apartment.status==1}">
          <th scope="row" @click="details(apartment)">{{ apartment.number }}</th>
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
    props: {
        list: Array,
        filters: {
            type: Object,
            default: null
        }
    },
    methods: {
        details(apartment) {
            this.$emit('details', this.list.indexOf(apartment));
        },
        filter() {
            if (this.filters == null || this.filters.target == null || this.filters.text == null) return null;
            
            const target = this.filters.target.toLowerCase(_.trim(this.filters.target));
            const text = _.trim(this.filters.text).toLowerCase();

            const command = (target.indexOf('>') != -1 ) ? target.split('>') : target;

            var result = null;
            
            if(_.isArray(command)) {
                    result = _.filter(this.list, (item) => {
                       return _.filter(item[command[0]], (sub_item) => {
                           return sub_item[command[1]].toLowerCase().indexOf(text) < 0 ? false : true;
                       }).length > 0;
                    });
                } else {                    
                    result = _.filter(this.list, (item) => {
                        if (typeof item[command] === 'string') {
                            return (item[command].toLowerCase().indexOf(text) != -1);
                        } else if (typeof item[command] === 'number') {
                            return item[command] == _.toInteger(text);
                        } else return false;  
                    });
                }
            
            if (result.length > 0) {
                return result;
            } else {
                this.$emit('not_found');
                return null;
            }
            //return (result.length > 0) ? result : null;
        }
    },
    computed: {
        apartments() {
            const filtered_list = this.filter();
            
            return filtered_list ? filtered_list : this.list; 
        }
    }
}

</script>
