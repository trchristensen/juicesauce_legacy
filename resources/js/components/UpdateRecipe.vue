<template>
<div>
        <div class="form-group">
            <label for="name">Name</label>
            <input class="form-control" type="text" name="name" id="name" v-model="recipe.name" required>
           
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Description</label>
            <textarea class="form-control" id="description" name="description" v-model="recipe.description" rows="3" required></textarea>
        </div>

        <div class="form-group">
        <label for="flavors">Flavors</label>
        <multiselect v-model="value" :options="options" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" placeholder="Select flavors" label="name" track-by="name" :preselect-first="true">
            <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length &amp;&amp; !isOpen">{{ values.length }} options selected</span></template>
      </multiselect>
      </div>

        <div class="form-group mt-4">
          <div v-for="(flavor, index) of value" v-bind:key="index" :id="flavor.id">
            <div class="form-row" style="border-bottom:1px solid #efefef">
              <div class="col-md-12 mt-2 mb-4 d-flex justify-content-between align-center">
                  <div class="ml-0 mr-auto d-flex flex-wrap">
                      <div class="d-flex">
                    <span class="label label-default mb-2" for="flavor" style="font-size: 0.9rem;">{{flavor.name}}</span> 
                    <a class="button is-medium is-primary ml-2 mr-0" style="cursor:pointer;font-size:12px;" @click="removeTag(index)">X</a>
                    </div>
                    <input name="flavor" type="number" class="form-control flavor" :id="'flavor-' + flavor.id" placeholder="Enter flavor %" v-model="flavor.pivot.flavor_perc" required>
                  </div>
                  
              </div>
            </div>
          </div>
        </div>

        <button type="submit" @click="updateRecipe" class="btn btn-primary mt-2 mb-4">Submit</button>

        <!-- <span>Macintosh HD <span class="free-space">100%</span></p> -->

        <meter value="55.93" min="0" max="120.47" title="GB">
        <div class="meter-gauge">
            <span v-bind:style="{ width: flavorTotal + '%'}" >Flavor Percentage - {{ flavorTotal }} out of 100%</span>
        </div>
        </meter>  

        <ul class="swatch" v-for="(flavor, index) of value" v-bind:key="index">
        <li class="swatch__elem">{{ flavor.name }}<span class="used-space">{{ flavor.pivot.flavor_perc }}%</span></li>
        </ul>




   
    </div>
    
</template>

<script> 

import Multiselect from 'vue-multiselect'
 
export default {
  components: {
    Multiselect
  },
  props: [

    'endpoint',
    'recipename',
    'recipedescription',
    'recipeflavors'
      
  ],
 
  data () {
    return {
        value: JSON.parse(this.recipeflavors),
        options: [],
        recipe: {
          name: this.recipename,
          description: this.recipedescription
        },

        errors: {

        },
    }
  },
  
  methods: {


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

    updateRecipe() {

      axios.post(this.endpoint, {
        _method: 'patch',
        name: this.recipe.name,
        description: this.recipe.description,
        flavors: this.resArray,
        })
      .then((response) => {
          // this.recipe.name = '';
          // this.recipe.description = '';
        console.log(response);

         window.location = response.request.responseURL;
        })
        .catch(error => {
          console.log(error)
        });

    }

  },
  computed: {

      flavorTotal: function() {

          var data = this.value;

          var sum = [];
        
        Object.keys(data).forEach(function(key) {

            var num = parseInt(data[key].pivot.flavor_perc);
            sum.push(num);
        });
        
        return sum.reduce(function (a, b) { return a + b; }, 0);
        
      },

     flavorArray: function() {

      let newArray = this.value.map(item => ({
        "id": item.id,
        "name": item.name,
        "pivot": {
            "flavor_perc": item.pivot.flavor_perc,
            "flavor_id": item.id,
        }
      }));
  
      return newArray;

    },
    resArray: function() {

      let newArray = this.value.map(item => ({
        "flavor_id": item.id,
        "flavor_perc": item.pivot.flavor_perc,
        
      }));
  
      return newArray;

    }
    
  },

  created () {


    var vm = this
    axios.get('/api/flavors')
      .then(function (response) {
        console.log(response.data);
        vm.options = response.data
      });

   
  }

}
</script>
