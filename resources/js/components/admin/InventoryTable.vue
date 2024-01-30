<template>
    <div>
        <a
            class="btn btn-success w-100"
            v-if="!selected_item && !updateOrCreate"
            @click="updateOrCreate = !updateOrCreate"
        >
            <i class="bi bi-patch-plus"></i> Add new item
        </a>
    </div>
    <table
        v-if="!selected_item && !updateOrCreate"
        class="table table-dark rounded"
    >
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Image</th>
            <th scope="col">View</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(item, index) in inventory">
            <th scope="row" v-text="index+1"></th>
            <td v-text="item.name"></td>
            <td>
                <img
                    alt="image"
                    width="150"
                    :src="item.image"
                />
            </td>
            <td>
                <a @click="$emit('onView',item)" class="btn btn-primary">
                    <i class="bi bi-eye"></i>
                </a>
            </td>
            <td>
                <a class="btn btn-warning" @click="()=>selected_item = item">
                    <i class="bi bi-pencil-square"></i>
                </a>
            </td>
            <td>
                <a class="btn btn-danger" @click="onDelete(item.id, index)">
                    <i class="bi bi-trash"></i>
                </a>
            </td>
        </tr>
        </tbody>
    </table>
    <admin-item
        v-else
        @onBack="onBack"
        :data="selected_item"
    ></admin-item>
</template>
<script>
export default {
    props:['inventory'],
    data(){
        return {
            selected_item:undefined,
            updateOrCreate:false,
        }
    },
    methods:{
        onBack(var_name){
            this[var_name] = undefined
        },
        onDelete(id, index){
            if(confirm('Are you sure')){
                axios.post('/api/inventory/delete',{
                    'id':id,
                }).then((response)=>{
                    this.$emit('onDelete',index)
                })
            }
        }
    }
}
</script>
