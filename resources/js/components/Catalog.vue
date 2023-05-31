<template>


    <div class="container">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.16.19/dist/css/uikit.min.css" />
<h1>Каталог товарів</h1>
<div class="elements" style="display: flex; align-items: center; margin-top: 20px" >
    <input type="text" class="form-control" id="name" placeholder="Ім'я товару" style="width: 300px" v-model="name" >

    <div style="display: flex; margin-left: 20px; align-items: center;">
     <h4>Категорія</h4>
    <select class="custom-select" v-model="category_id" style="font-size: 20px; margin-left: 10px;">
        <option v-for="category in catarr" :value="category.id">{{category.name}}</option>
    </select>
    </div>
    <div style="display: flex;" >
        <h4>Виробник</h4>
    <select class="custom-select" v-model="manufacture_id" style="font-size: 20px; margin-left: 10px;">
        <option v-for="manufacture in manarr" :value="manufacture.id">{{manufacture.name}}</option>

    </select>
    </div>
    <button type="button" class="btn btn-warning" style ="margin-left: 20px;" @click="filter">Фільтрувати</button>

</div>

        <div class="container py-5">

            <div class="row">
                <div class="col-lg-8 mx-auto">


                    <ul class="list-group shadow">


                        <li class="list-group-item" v-for="product in products">

                            <div class="media align-items-lg-center flex-column flex-lg-row p-3">
                                <div class="media-body order-2 order-lg-1">
                                    <h5 class="mt-0 font-weight-bold mb-2">{{product.name}}</h5>
                                    <p class="font-italic text-muted mb-0 small">{{product.description}}</p>
                                    <div class="d-flex align-items-center justify-content-between mt-1">
                                        <h6 class="font-weight-bold my-2">{{product.cost + ' грн '}}</h6>
                                    </div>

                                    <h4>В категорії: {{product.category_id}}</h4>


                                </div><img :src="product.photo" alt="Generic placeholder image" width="200" class="ml-lg-5 order-1 order-lg-2">
                            </div>

                        </li>

                    </ul>



                </div>
            </div>
        </div>


    </div>
</template>

<script>

const Swal = require('sweetalert2');
export default {
    name: "Catalog",
    data(){
        return {
            name: null,
            category_id: null,
            manufacture_id: null,
            catarr: null,
            manarr:null,
            products:null,

        }
    },
mounted() {

        this.getCategories();
        this.getManufactures();
        this.filter();
}
    ,
    methods: {

        filter(){
            axios.post("/getProduct/by/filter", {name: this.name, category_id: this.category_id, manufacture_id: this.manufacture_id}).then(

                res => {
                    this.products = res.data.products;
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: res.data.success,
                        showConfirmButton: false,
                        timer: 1500
                    })
                }

            );
        },

        getManufactures(){
            axios.get("/dashboard/getManufactures").then(
                res => {
                    if (res.data){
                        this.manarr = res.data;
                    }
                }

            );
        },
        getCategories(){
            axios.get("/dashboard/getCategories").then(
                res => {
                    if (res.data){
                        this.catarr = res.data;
                    }
                }

            );
        },



    }
}
</script>

<style scoped>
body {
    background: #00b09b;
    background: -webkit-linear-gradient(to right, #00b09b, #96c93d);
    background: linear-gradient(to right, #00b09b, #96c93d);
    min-height: 100vh;
}

.text-gray {
    color: #aaa;
}
</style>
