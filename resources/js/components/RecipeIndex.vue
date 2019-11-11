<template>
<div>
  
  

        
                <div v-for="(item, index) in results.data" class="list-item mb-2 pl-2 pr-2 pt-2 pb-4" style="border-bottom:1px solid #efefef;" :id="index">
                    
                    <div class="header d-flex">
                        <div class="ml-0 mr-auto">
                            <a style="text-decoration:none;color:#212529;font-size:22px" :href="'/recipes/' + item.id">{{ item.name }}</a>
                        </div>
                        <div style="float:right">
                            <span style="text-decoration:none;color:#212529;font-size:12px;font-style:italic">{{ getHumanDate(item.updated_at)}}</span>
                        </div>
                    </div>
                    <div class="mb-2">
                    <a style="text-decoration:none;color:#212529;" :href="'/recipes/' + item.id">{{ item.description }}</a>
                    </div>
                    <div>
                    <!-- @foreach($recipe->flavors as $flavor) -->
                        
                        <!-- <span class="label label-default" style="background:">{{$flavor->name}}</span> -->
                    <!-- @endforeach -->
                    </div>
                </div>

                
                        
                   <pre class="language-json"><code>{{ results.data }}</code></pre>
                

   


    </div>
</template>

<script> 

 
export default {
  components: {},
  props: [],
 
  data () {
    return {
       results: [],
    }
  },
  
  methods: {
      
      getHumanDate : function (date) {
                return moment(date).fromNow();
            },


  },
  computed: {


    
  },

  created () {
    var vm = this
    axios.get('/api/recipes')
      .then(function (response) {
        vm.results = response.data
        console.log(vm.results);
      })
  }

}
</script>
