<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"></div>

                    <div class="card-body">
                        Avi
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.');
             this.getAdress();
        },
        created()
        {
             console.log('AAA')
            this.getAdress();
        },
      methods: {
       getAdress(){
      fetch('api/address').then(res=>res.json())
      .then(res=>{console.log(res.data);
      })
       } 
    }
    }
   
</script>
