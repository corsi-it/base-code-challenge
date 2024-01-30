<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 mt-4" v-for="(item, i_index) in inventory">
                <div class="card h-100" v-if="!item.is_disabled">
                    <div
                        class="card-image"
                        :style="{
                            backgroundImage:`url(${item.image})`
                        }"
                    ></div>
                    <div class="card-body d-flex flex-column justify-content-between">
                        <h5
                            class="card-title"
                            v-text="item.name"
                        ></h5>
                        <p
                            class="card-text"
                            v-text="item.description"
                        ></p>
                        <div class="row m-0 p-0 align-items-center">
                            <div class="col-md-9 m-0 p-1">
                                <button
                                    data-bs-toggle="modal"
                                    :data-bs-target="`#exampleModal${i_index}`"
                                    class="w-100 btn btn-success"
                                    v-text="'Request'"
                                ></button>
                            </div>
                            <div class="col-md-3 m-0 p-1">
                                <a @click="$emit('onView',item)" class="w-100 btn btn-primary">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <request-modal
                        class=""
                        :index="i_index"
                        :inventory_id="item.id"
                    ></request-modal>
                </div>
            </div>
        </div>
    </div>
</template>
<script >
import '../../css/InventoryCardList.css'
export default {
    props:['inventory'],
}
</script>
