<template>
    <div>
        <table
            v-if="!selected_item && !updateOrCreate"
            class="table table-dark rounded"
        >
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Status</th>
                <th scope="col">User</th>
                <th scope="col">Investor</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(request, index) in requests">
                <th scope="row" v-text="index+1"></th>
                <td v-text="request.status"></td>
                <td v-text="request.user.email"></td>
                <td v-text="request.inventory.name"></td>
                <td>
                    <a class="btn btn-danger" @click="setStatus(request.id, 'rejected', index)">
                        Decline
                    </a>
                    <a class="ms-3 btn btn-success" @click="setStatus(request.id, 'accepted', index)">
                        Approve
                    </a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
export default {
    data(){
      return {
          requests:[],
      }
    },
    methods:{
        getAllRequest(){
            axios.post('/api/request/all')
                .then((response)=>{
                    this.requests = response.data.data
                })
        },
        setStatus(id ,status, index){
            axios.post('/api/set-status',{
                id,
                status,
            })
            .then((response)=>{
                this.requests[index].status = status
            })
        }
    },
    created(){
        this.getAllRequest()
    }
}
</script>
