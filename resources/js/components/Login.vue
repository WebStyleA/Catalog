<template>
<div style="display: flex; justify-content: center; align-items: center;margin-top: 30px;">
    <form style="width: 300px; text-align: center" >
        <img class="mb-4" src="https://s1.iconbird.com/ico/2014/1/606/w512h5121390848250shop512.png" alt="" width="72" height="57">
        <h1 class="h3 mb-3 fw-normal">Будь ласка, авторизуйтесь</h1>

        <div class="form-floating" style="margin-bottom: 20px">
            <input type="text" class="form-control" id="floatingInput" placeholder="aboba123" v-model="login">
            <label for="floatingInput">Ваш логін</label>
        </div>
        <div class="form-floating" style="margin-bottom: 20px">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Password" v-model="password">
            <label for="floatingPassword">Ваш Пароль</label>
        </div>

        <button class="w-100 btn btn-lg btn-primary" type="submit" @click.prevent = "loginMethod">Увійти</button>

    </form>

</div>
</template>

<script>
const Swal = require('sweetalert2');
export default {
    name: "Login",
    data(){
        return {
            login: null,
            password:null
        }

    },methods:{
        loginMethod(){
            axios.post("/login/api", {login: this.login, password: this.password}).then(

              res => {
                  if(res.data.success)
                      window.location.href = "/";
                  else {
                      Swal.fire({
                          icon: 'error',
                          title: res.data.error,
                      })
                  }
              }

            );
        }
    }
}
</script>

<style scoped>

</style>
