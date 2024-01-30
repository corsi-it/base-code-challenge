<template>
    <div class="position-relative">
        <div
            id="singleCardBack"
            class="rounded top-0 start-0 z-1 position-absolute d-flex align-items-center justify-content-center"
            @click="$emit('onView',undefined)"
        >
            <i class="bi bi-skip-backward"></i>
        </div>
        <div class="card mb-3">
            <img :src="item.image" class="card-img-top" :alt="item.image">
            <div class="card-body">
                <h4
                    v-text="'Category: '+item.category"
                    class="card-text"
                ></h4>
                <h6
                    v-text="item.name"
                    class="card-title text-decoration-underline"
                ></h6>
                <p
                    v-text="item.description"
                    class="card-text"
                ></p>
                <p
                    class="card-text"
                >
                    ${{setForPriceComs(item.price)}}
                </p>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props:['item'],
    methods:{
        setForPriceComs(price){
            let string = price.toString()
            if(string.length%2 === 0){
                return string.match(/.{1,3}/g).join(',')
            }else if(string.length%5 === 0){
                let first = string[0]+string[1]
                return first+','+string.slice(2, string.length).match(/.{1,3}/g).join(',')
            }else if(string.length%2 === 1){
                let first = string[0]
                return first+','+string.slice(1, string.length).match(/.{1,3}/g).join(',')
            }
        }
    },
}
</script>
<style>
#singleCardBack{
    background: #8a0000;
    color: white;
    width: 50px;
    height: 50px;
    cursor: pointer;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
}
#singleCardBack:hover{
    opacity: 0.6;
}
</style>
