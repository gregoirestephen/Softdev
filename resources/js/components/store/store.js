import Vue from "vue";
import VueX from 'vuex'

Vue.use(VueX)

 export const store= new VueX.Store({
     strict:true,
     state:{
        products:'Hello'
     },
     getters:{
         reducePrice:state=>{
            return state.products
         }
     },
     mutations:{

     },
     actions:{

     }

})
