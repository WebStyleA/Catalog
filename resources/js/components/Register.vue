<template>
<div style="display: flex; justify-content: center; align-items: center;">
<div class="register" style="margin-top: 30px">
    <h1>Реєстрація</h1>
    <div>
        <label for="login" class="form-label">Придумайте логін, до 255 символів</label>
        <input type="text" class="form-control" id="login" placeholder="Ваш логін" required v-model="name">
        <label for="pass" class="form-label">Ваш пароль</label>
        <input type="password" class="form-control" id="pass" placeholder="Ваш Пароль" required v-model="password">
        <label for="email" class="form-label">Ваш email</label>
        <input type="email" class="form-control" id="email"  placeholder="Ваш email" required v-model="email">
        <button type="button" class="btn btn-warning" style = "margin-top: 20px" @click.prevent = "register"> Реєстрація </button>

    </div>
</div>

</div>
</template>

<script>
const Swal = require('sweetalert2');
export default {
    name: "Register",
    data(){
        return {
            name:null,
            password: null,
            email:null,
        }
    },
    methods: {
        register(){
            axios.post("/register/api", {login: this.name, password: this.password, email: this.email}).then(

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
