
require('./bootstrap');
require('./adminlte')
import {createApp} from 'vue';
import ExampleComponent from "./components/ExampleComponent";
import Login from "./components/Login";
import Register from "./components/Register";
import Catalog from "./components/Catalog";

const app = createApp({
  data(){
      return {
          count: 10
      }
  },
    components:{
      ExampleComponent,Login,Register,Catalog
    }

});

app.mount("#app");




