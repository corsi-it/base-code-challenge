<template>
    <div>
        <inventory-card-list
            v-if="!single_item"
            @onView="onView"
            :inventory="inventory"
        ></inventory-card-list>
        <single-page-card
            v-else
            class="d-flex flex-column justify-content-between"
            @onView="onView"
            :item="single_item"
        ></single-page-card>
    </div>
</template>
<script>
import Multiselect from '@vueform/multiselect'
    export default {
        components: {
            Multiselect,
        },
        data(){
            return{
                filter:'',
                inventory:[],
                single_item:undefined,
            }
        },
        created(){
            this.getInventory()
        },
        methods:{
            onView(item){
                this.single_item = item
            },
            getInventory(){
                axios.get('/api/cars')
                .then((response)=>{
                        response.data.data.map((item)=>{
                            item['is_disabled'] = false
                            this.inventory.push(item)
                        })
                })
            }
        },
    }
</script>
