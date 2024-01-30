<template>
    <div
        @click="()=>{$emit('onBack','selected_item');$emit('onBack','updateOrCreate')}"
        class="bg-secondary rounded pt-2 pb-2 text-center"
    >
        go back
    </div>
    <form class="text-white mt-3">
        <div class="form-group">
            <label for="name">Item name</label>
            <input
                type="text"
                class="form-control"
                v-model="item.name"
                id="name"
                placeholder="e.g Ferrari F40..."
            >
        </div>
        <div class="form-group mt-3">
            <label for="categories">Categories</label>
            <multiselect
                class="text-black"
                v-model="category"
                @change="onTagSaveCategory"
                :options="category_names"
                :placeholder="data?.category??''"
            ></multiselect>
        </div>
        <div class="form-group mt-3">
            <label for="description">Description</label>
            <textarea
                v-model="item.description"
                class="form-control"
                id="description"
                rows="3"
                placeholder="mid-engine, rear-wheel drive sports car engineered by Nicola Materazzi with styling by Pininfarina."
            ></textarea>
        </div>
        <div class="form-group mt-3">
            <label for="price">Price</label>
            <input
                v-model="item.price"
                type="number"
                class="form-control"
                id="price"
                placeholder="$2,467,459"
            >
        </div>
        <div class="form-group mt-3">
            <label for="image">Image</label>
            <input
                accept=".png,.jpg,.jpeg,.svg"
                @change="onFileChange"
                type="file"
                class="form-control-file"
                id="image"
            >
            <img v-if="item.image" height="150" class="rounded shadow border-white border-2" :src="previewImage(item.image)" alt="">
        </div>
    </form>
    <div>
        <div v-if="data" @click="saveItemData('update')" class="btn btn-success d-flex align-items-center mt-4 justify-content-center">
            Update
        </div>
        <div v-else @click="saveItemData('create')" class="btn btn-success d-flex align-items-center mt-4 justify-content-center">
            Create New Item
        </div>
    </div>
</template>
<script>
import Multiselect from '@vueform/multiselect'
export default {
    components: {
        Multiselect,
    },
    props:['data'],
    data(){
        return {
            item:this.data??{
                id:'',
                name:'',
                image:'',
                price:'',
                description:'',
                category:'',
                status:'',
            },
            category:'0',
            category_names:[],
            categories:[],
        }
    },
    methods:{
        onTagSaveCategory(e){
            this.item.category = this.categories?.find(category=>category.name.includes(e)).id
        },
        previewImage(file){
            if(typeof file !== 'string'){
                return URL.createObjectURL(file)
            }
            return file
        },
        getCategories(){
            axios.get('/api/categories')
                .then((response)=>{
                    this.categories = response.data.data
                    response.data.data.map((category)=>{
                        this.category_names.push(category.name)
                    })
                    this.setCategoryIfDataExists()
                })
        },
        saveItemData(url){
            console.log(this.item)
            axios.post(`/api/inventory/${url}`, this.item, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then((response)=>{
                window.location.reload()
            })
        },
        onFileChange(e){
            this.item.image = e.target.files[0]
        },
        setCategoryIfDataExists(){
            this.onTagSaveCategory(this.data?.category)
        }
    },
    created(){
        this.getCategories()
    },
}
</script>
<style src="@vueform/multiselect/themes/default.css"></style>
