<template>
<div>

    <!-- <div class="form-group">
        <label for="userId">Enter a flavorID</label>
        <input class="form-control mb-2" type="number" v-model="flavorID">
    </div>  -->

      <pre class="language-json"><code>{{ results  }}</code></pre>

    <div class="form-group d-flex justify-content-between">
        <multiselect v-model="value" :options="options" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" placeholder="Select flavors" label="name" track-by="name" :preselect-first="true">
            <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length &amp;&amp; !isOpen">{{ values.length }} options selected</span></template>
        </multiselect>
        <button class="btn btn-primary" @click="sendTweet">Filter</button>
        
    </div>
                <div v-for="(item, index) in results.data" v-bind:key="index" class="list-item mb-2 pl-2 pr-2 pt-2 pb-4" style="border-bottom:1px solid #efefef;" :id="index">
                    
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

                    </div>
                </div>


    </div>
</template>

<script> 
import Multiselect from 'vue-multiselect'
 
export default {
  components: {
    Multiselect 
  },
  props: [],
 
  data () {
    return {
        results: [],
        flavorID: '',
        value: [],
        options: [],
    }
  },
  
  methods: {
      
      getHumanDate : function (date) {
                return moment(date).fromNow();
            },


      sendTweet : function() {

        // grab array of flavors (value)
          var flavorIDArr = this.flavorID;
          var vm = this;

        // loop through flavors
        var text = ""
        var flavors = this.value;
        for(let flavor of flavors){
          
          text+= 'flavor[]=' + flavor.id + '\&';
        }

        //send ajax request with query string

        axios.get('/filter/?' + text)
        .then(function (response) {
            vm.results = response.data
            vm.flavorID = '';
        });
      },

      addTag (newTag) {

        const tag = {
            name: newTag,
            code: newTag.substring(0, 2) + Math.floor((Math.random() * 10000000))
        }      
        this.options.push(tag)
        this.value.push(tag)
        },

        removeTag(tag) {
            this.options.pop(tag)
            this.value.pop(tag)
      },


  },
  computed: {


    
  },

  created () {
    var vm = this
    axios.get('/api/recipes')
      .then(function (response) {
        vm.results = response.data
        
      });

    axios.get('/api/flavors')
      .then(function (response) {
        console.log(response.data);
        vm.options = response.data
      });
   

  }

}
</script>
