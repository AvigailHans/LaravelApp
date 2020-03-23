   <template>
<div >
     <GmapMap  style="width: 100%; height: 450px"
  :center="this.center"
  :zoom="15"
  map-type-id="terrain"
  id="map"
>
  <GmapMarker
    :key="index"
    v-for="(m, index) in markers "
    :position="m.position"
    :clickable="true"
    :draggable="false"
    :label="m.label"
    :title="m.title"
  />
</GmapMap>
<div   class="as"> 
           לחץ על כתובת והיא תופיע במפה...
         </div>
  <div class="scroll">
         
           <h3  v-for="address in addresses" v-bind:key="address.id"  @click="showMarker(address)" >
          {{address.street}} {{address.city}} {{address.lat}}  {{address.lng}} 
          </h3>
        
        </div>
        
         </div>
        
</template>

<script>
    export default {
         data()
        {
            return {
                addresses:[],
            center: {lat: 32.0852999, lng: 34.7817675999},
        markers: [{
          position: {lat: 31.771959, lng:35.217018},
           label:"lat: 31.771959, lng:35.217018",
           title:"ירושלים"
   
        }]
            }
        },
        created()
        {
            
            this.getAdress();
        },
      methods: {
      
       getAdress(){
       fetch('api/addresses').then(res=>res.json())
      .then(res=>{this.addresses=res.data;})
       } ,
       
      showMarker(address) {
          let a=address.street+" "+address.city;
          let doupdate=address.lat==null;
          if(doupdate){
          fetch("https://maps.googleapis.com/maps/api/geocode/json?address="+a+"&key=AIzaSyC4kmA5R3jgClPFDY-C092RE2RZ0uSRwY4")
          .then(res=>res.json())
          .then(res=>{this.center=res.results[0].geometry.location; this.markers[0].position=res.results[0].geometry.location})
          }
          else
          {
            this.center= { lat:parseFloat(address.lat), lng:parseFloat(address.lng)};
            this.markers[0].position={ lat:parseFloat(address.lat), lng:parseFloat(address.lng)};
            console.log(this.center ,this.markers[0].position)
          }
         this.markers[0].label=" lat: "+this.markers[0].position.lat+" lng: "+this.markers[0].position.lng;
         this.markers[0].title=a+"\n lat: "+this.markers[0].position.lat+" lng: "+this.markers[0].position.lng;
         address.lat=this.markers[0].position.lat;
         address.lng=this.markers[0].position.lng;
         if(doupdate)
         {
           this.updateAddress(address);
         }
       
         },
           updateAddress(address){ 
            console.log("blabla");
             fetch('api/address',
             {method:'put',body:JSON.stringify(address),headers:{'content-type':'application/json'}})
             .catch(err=>console.log(err))
         
    }
    }
  
    }
   
</script>
<style scoped>
h3, .as{     cursor: pointer;
             font-family: sans-serif;
              color: darkcyan;
              border-bottom: 1px solid rgb(200, 200, 200);
}

    .scroll {
 height:600px;width: 100%;
  
   overflow: scroll;
}
.scroll::-webkit-scrollbar {
    width: 12px;
    
}

.scroll::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3); 
    border-radius: 10px;
    
}

.scroll::-webkit-scrollbar-thumb {
    border-radius: 10px;
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5); 
    background-color: rgba(16, 10, 78, 0.555);
    
}
</style>