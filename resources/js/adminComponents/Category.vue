<template>

    <div style="display: flex; width: 100%">

        <div class="card" style = "width: 70%; margin-top: 20px;" >
            <div class="card-header" style="display: flex; justify-content: space-between;">
                <div>  <h3 class="card-title">Категорії</h3></div>
                  <div class="buttons" style="display: flex; align-items: center ">
                      <button type="button" :class= "add ? 'btn btn-block btn-success btn-flat' : 'd-none'"   @click = "save()" >Зберегти</button>
                      <button type="button" :class= "add ?  'd-none' : 'btn btn-block btn-info btn-flat'" style="margin-left: 40px" @click = "addM()">Додати</button>
                  </div>
            </div>

            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                    <tr >
                        <th style="width: 10px">#</th>
                        <th>Ім'я</th>
                        <th>Опис</th>
                        <th style ="width:100px">Видалення</th>

                    </tr>
                    </thead>
                    <tbody>
                    <tr :class="add?'' : 'd-none' ">
                        <td> ** </td>
                        <td><input type="text" v-model="cname"> </td>
                        <td> <input type="text" v-model="cdesc"></td>
                    </tr>
                    <tr v-for="category in catarr">
                        <td> {{category.id}} </td>
                        <td> {{category.name}}</td>
                        <td> {{category.description}} </td>
                        <td> <button type="button" class="btn btn-block btn-danger btn-flat" @click = "deleteCategory(category.id)" >Видалити</button></td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>




    </div>




</template>

<script>


const Swal = require('sweetalert2');
export default {
    name: "Category",
    data(){
        return {
            add: false,
            cname: null,
            cdesc: null,
            catarr: null
        }
    },
    mounted() {

        this.getCategories();
    }
    ,
    methods: {
        addM(){
            this.add = !this.add;
        },
        save(){

            axios.post("/dashboard/saveCategory", {name: this.cname, description: this.cdesc}).then(
                res => {
                    if (res.data.success){
                        Swal.fire({
                            position: 'top-center',
                            icon: 'success',
                            title: res.data.success,
                            showConfirmButton: false,
                            timer: 1500
                        })

                        this.getCategories();
                    }
                }

            );


            this.addM();

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
        deleteCategory(id){

            axios.get(`/dashboard/deleteCategory/${id}`).then(res => {
                Swal.fire({
                    position: 'top-center',
                    icon: 'success',
                    title: res.data.success,
                    showConfirmButton: false,
                    timer: 1500
                })
                this.getCategories();
            })



        }
    }
}
</script>

<style scoped>

</style>
