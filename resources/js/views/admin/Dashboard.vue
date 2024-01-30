<template>
<div>
    <single-page-card
        class="d-flex flex-column justify-content-between"
        v-if="selected_item"
        :item="selected_item"
        @onView="onView"
    ></single-page-card>
    <admin-inventory-table
        v-else
        :inventory="inventory"
        @onView="onView"
        @onDelete="onDelete"
    ></admin-inventory-table>
</div>
</template>
<script>
export default {
    data(){
        return {
            selected_item:undefined,
            inventory:undefined,
        }
    },
    created(){
        this.getInventory()
    },
    methods:{
        getInventory(){
            axios.get('/api/cars')
            .then((response)=>{
                this.inventory = response.data.data
            })
        },
        onView(item){
            this.selected_item = item
        },
        onDelete(index){
            this.inventory.splice(index, 1)
        },
    },
}
</script>
