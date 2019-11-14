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

        <multiselect v-model="value" :options="options" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" placeholder="Select flavors" label="name" track-by="name" :preselect-first="true">
            <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length &amp;&amp; !isOpen">{{ values.length }} options selected</span></template>
      </multiselect>

        <div class="form-group mt-4">
          <div v-for="(flavor, index) of value" v-bind:key="index" :id="flavor.id">
            <div class="form-row" style="border-bottom:1px solid #efefef">
              <div class="col-md-12 mt-2 mb-4 d-flex justify-content-between align-center">
                  <div class="ml-0 mr-auto">
                    <label for="flavor">{{flavor.name}}</label>
                    <input name="flavor" type="number" class="form-control flavor" :id="'flavor-' + flavor.id" placeholder="Enter flavor %" v-model="flavor.flavor_perc" required>
                  </div>
                  <a class="button is-medium is-primary ml-auto mr-0" style="cursor:pointer;" @click="removeTag(index)">X</a>
              </div>
            </div>
          </div>
        </div>
        

        <button type="submit" @click="createRecipe" class="btn btn-primary mt-2">Submit</button>



  <!-- <pre class="language-json"><code>{{ value  }}</code></pre> -->


    


  <!-- <pre class="language-json">Flavor Array: <code>{{ flavorArray }}</code></pre> -->

  


    </div>
  
</template>

<script> 

import Multiselect from 'vue-multiselect'
 
export default {
  components: {
    Multiselect
  },
  props: [

    'endpoint'
      
  ],
 
  data () {
    return {
        value: [],
        options: [],
        recipe: {
          name: '',
          description: ''
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

    createRecipe() {

      axios.post(this.endpoint, {
        name: this.recipe.name,
        description: this.recipe.description,
        flavors: this.flavorArray,
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

    },

  

  },
  computed: {

     flavorArray: function() {

      let newArray = this.value.map(item => ({
        "flavor_id": item.id,
        "flavor_perc": item.flavor_perc
      }));
  
      return newArray;

    }
    
  },

  created () {
    var vm = this
    axios.get('/api/flavors')
      .then(function (response) {
        vm.options = response.data
      })
  }

}
</script>
