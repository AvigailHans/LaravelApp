<template>
    <div class="container">
         <div v-for="address in addresses" v-bind:key="address.id">
               {{address.id}} {{address.street}} {{address.city}} 
         </div>
    </div>
</template>

<script>
    export default {
         data()
        {
            return {
                addresses:[]
            }
        },
        mounted() {
            console.log('Component mounted.');
             
        },
        created()
        {
           
            this.getAdress();
        },
      methods: {
     
       getAdress(){
       console.log('AAA');
       fetch('api/address').then(res=>res.json())
      .then(res=>{this.addresses=res.data;})

       } 
    }
    }
   
</script>
