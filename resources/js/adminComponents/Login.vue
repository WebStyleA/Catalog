<template>
    <div class="" style="display: flex; justify-content: center; align-items: center; padding-top: 200px" >

        <div class="card card-info" style="width: 500px">
            <div class="card-header">
                <h3 class="card-title">Вхід в адміністративну панель</h3>
            </div>


            <form class="form-horizontal">
                <div class="card-body">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Логін</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputEmail3" placeholder="Логін" v-model="login">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Пароль</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="inputPassword3" placeholder="Пароль" v-model="password">
                        </div>
                    </div>

                </div>


                <div class="form-group" style ="margin-left: 20px">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" v-model="newadmin" id="customSwitch1" >
                        <label class="custom-control-label" for="customSwitch1">Реєстрація нового адміна</label>
                    </div>
                </div>


                <div :class="newadmin ? 'form-group' : 'd-none' " style = "width: 300px; margin-left: 20px" >
                    <label class="col-form-label" for="inputWarning"><i class="far fa-bell"></i> Адмін - ключ</label>
                    <input type="text" class="form-control is-warning" id="inputWarning" placeholder="Адмін - ключ" v-model="secretKey">
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-info" @click.prevent = "auth">Увійти</button>
                    <button type="submit" class="btn btn-default float-right">Відміна</button>
                </div>


            </form>
        </div>


    </div>
</template>

<script>

const Swal = require('sweetalert2');
export default {
    name: "Login",
    data(){
        return {
            newadmin : false,
            secretKey:null,
            login:null,
            password:null
        }






    },
    methods:{
        auth(){
            if(this.newadmin) {
                axios.post("/dashboard/attempt/reg", {login: this.login, password: this.password, secretKey: this.secretKey}).then(res => {
                    if(res.data.success){
                        window.location.href = '/dashboard'
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: res.data.error,
                        })
                    }
                })
            } else {
                axios.post("/dashboard/attempt/log", {login: this.login,password: this.password }).then(
                    res => {
                        if(res.data.success)
                            window.location.href = '/dashboard';
                        else {
                            Swal.fire({
                                icon: 'error',
                                title: res.data.error,
                            })
                        }
                    }

                )
            }
        }
    }
}
</script>

<style scoped>

</style>
