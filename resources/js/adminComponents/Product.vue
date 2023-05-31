<template>

    <div>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" style = "margin-top: 20px; margin-bottom: 20px">
           Додати товар
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen-sm-down">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Додати товар</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputFile">Виберіть файл товару</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" @change = "getImage" class="custom-file-input"  id="exampleInputFile" >
                                    <label class="custom-file-label" for="exampleInputFile">Обрати</label>
                                </div>


                                <div class="input-group-append">
                                    <span class="input-group-text">Завантажити</span>
                                </div>
                            </div>

                            <div class="form-group" data-select2-id="29">
                                <label>Оберіть категорію</label>
                                <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" v-model="current_category_id">
                                    <option v-for="category in catarr" :value="category.id">{{category.name}}</option>
                                </select>
                            </div>

                            <div class="form-group" data-select2-id="29">
                                <label>Оберіть виробника</label>
                                <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" v-model="current_manufactorys_id">
                                    <option v-for="manufactory in manarr" :value="manufactory.id">{{manufactory.name}}</option>

                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Вкажіть ціну</label>
                                <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Ціна" v-model="cost">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Назва товару</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Назва" v-model="name">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Надайте опис</label>
                                <textarea class="form-control" rows="3" placeholder="Опис" v-model="desc"></textarea>
                            </div>



                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-block btn-success btn-flat" @click ="saveProduct">Зберегти</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрити</button>

                    </div>
                </div>
            </div>
        </div>


        <div class="card" style = "max-width: 1200px">
            <div class="card-header">
                <h3 class="card-title">Товари</h3>
            </div>

            <div class="card-body p-0" >
                <table class="table">
                    <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Назва</th>
                        <th>Опис</th>
                        <th>Вартість, грн</th>
                        <th style = " width: 100px">Видалити</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="product in products">
                        <td>{{product.id}}</td>
                        <td>{{product.name}}</td>
                        <td>
                            {{product.description}}
                        </td>
                        <td>
                            {{product.cost}}
                        </td>
                        <td><button type="button" class="btn btn-warning" @click ="deleteProduct(product.id)">Видалити</button></td>
                    </tr>

                    </tbody>
                </table>
            </div>

        </div>
    </div>

</template>

<script>

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap/dist/js/bootstrap.js'
const Swal = require('sweetalert2')
export default {
    name: "Product",
    data(){
        return {
            name: null,
            cost: null,
            desc: null,
            image: null,
            manarr:null,
            catarr:null,
            current_category_id: null,
            current_manufactorys_id: null,
            products: null
        }
    },

    mounted() {

        this.getCategories();
        this.getManufactures();
        this.getProducts();
    },
    methods: {

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

        getImage(event){

            this.image = event.target.files[0];

        },
        saveProduct(){
            let formData = new FormData();


            formData.append("name" , this.name);
            formData.append("cost" , this.cost);
            formData.append("description" , this.desc);
            formData.append("photo" , this.image);
            formData.append("category_id" , this.current_category_id);
            formData.append("manufactures_id" , this.current_manufactorys_id);


            axios.post('/dashboard/saveProduct', formData).then(res => {

                if(res.data.success){
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: res.data.success,
                        showConfirmButton: false,
                        timer: 1500
                    });
                    this.getProducts();

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: res.data.error,

                    })
                }

            });


        },
        getProducts(){

            axios.get("/dashboard/getProducts").then( res => {

                this.products = res.data;

            });

        },
        deleteProduct(id){
            axios.get("/dashboard/deleteProduct/"+ id).then( res => {

                if(res.data.success){
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: res.data.success,
                        showConfirmButton: false,
                        timer: 1500
                    });
                    this.getProducts();
                }

            });
        }



    }
}
</script>

<style scoped>

</style>
