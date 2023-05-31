
require('./adminlte');
import {createApp} from 'vue';
import Login from "./adminComponents/Login";
import Category from "./adminComponents/Category";
import Manufactures from "./adminComponents/Manufactures";
import Product from "./adminComponents/Product";
const app = createApp({
    data(){
        return {
            count: 10
        }
    },
    components:{
        Login,Category,Manufactures,Product
    }


});

app.mount("#app");
