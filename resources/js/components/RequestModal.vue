<template>
    <!-- Modal -->
    <div class="modal fade" :id="`exampleModal${index}`" tabindex="-1" :aria-labelledby="`exampleModalLabel${index}`" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Request Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="startDate" class="form-label">Start date</label>
                        <input
                            v-model="data.start_date"
                            type="date"
                            class="form-control"
                            id="startDate"
                            aria-describedby="startDateHelp"
                        >
                    </div>
                    <div class="mb-3">
                        <label for="endDate" class="form-label">End date</label>
                        <input
                            v-model="data.end_date"
                            type="date"
                            class="form-control"
                            id="endDate"
                            aria-describedby="endDateHelp"
                        >
                    </div>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                    >
                        Close
                    </button>
                    <button
                        type="button"
                        data-bs-dismiss="modal"
                        @click="sendRequestForItem"
                        class="btn btn-primary"
                    >
                        Send Request
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
export default {
    props:['index','inventory_id'],
    data(){
        return {
            data:{
                start_date:'',
                end_date:'',
                inventory_id:this.inventory_id,
            }
        }
    },
    methods:{
        sendRequestForItem(){
            axios.post('/api/request/item',this.data)
            .then((response)=>{
                // window.location.reload()
                this.notify('Request Sent Successfully!');
            }).catch((error)=>{
                this.notify(JSON.parse(error.response.request.responseText).message);
            })
        }
    },
    setup() {
        const notify = (content) => {
            toast(content, {
                autoClose: 3000,
            }); // ToastOptions
        }
        return { notify };
    }
}
</script>
