<template>
  <div>
    <h1 class="mb-5">My Projects</h1>
    <v-layout row class="mb-3">
      
      <v-btn text>Order by</v-btn>

        <v-tooltip top>
          <template v-slot:activator="{on}">
            <v-btn v-on="on" small text color="grey" @click="sort('title')">
              <v-icon left small>mdi-folder</v-icon>
              <span class="caption text-lowercase">By project title</span>
            </v-btn>
          </template>
          <span>Order project by project title</span>
        </v-tooltip>

        <v-tooltip top>
          <template v-slot:activator="{on}">
            <v-btn small text color="grey" @click="sort('id')" v-on="on">
              <v-icon left small>mdi-account</v-icon>
              <span class="caption text-lowercase">By Latest</span>
            </v-btn>
          </template>
          <span>Order project by recently added</span>
        </v-tooltip>
        
      </v-layout>

    <v-expansion-panels>
        <v-expansion-panel v-for="(project, index) in myProjects" :key="index">
          <v-expansion-panel-header class="title">{{project.title}}</v-expansion-panel-header>
              <v-expansion-panel-content>
                <v-card class="pa-3">
                  <input type="text" v-model="arr">
                  <input type="text" v-model="project.title">
                  <div class="subheading mb-5">{{project.description}}</div>
                  <fieldset :class="`_${project.id}`" :data-score="`_${project.id}`">
                    <div v-for="(task, index) in project.tasks" :key="index">
                      <input type="checkbox" :value="task" class="mr-3" @change="hello" > <span> {{task}} </span>
                    </div>
                  </fieldset>
                  <div class="my-3 font-weight-bold">Due by: {{project.due}}</div>
                </v-card>
              </v-expansion-panel-content>
        </v-expansion-panel>
    </v-expansion-panels>

    <button @click="hh">hdhdh</button>

<!-- 
     <v-card  flat row v-for="(project, index) in myProjects" :key="index">
        <v-layout row class="pa-3">
          <v-flex xs12 md6>
            <div class="caption grey--text">Project title</div>
            <div>{{project.title}}</div>
          </v-flex>
          <v-flex xs6 sm4 md2>
            <div class="caption grey--text">Person</div>
            <div>{{project.description}}</div>
          </v-flex>
         </v-layout>
         <v-divider></v-divider>
      </v-card> -->

    <!-- <div class="mt-5">
            <input type="text" v-model="arr">
            <v-btn @click='hi'>test</v-btn>
    </div> -->

    <div>
      <ul>
        <li v-for="(family, index) in family" :key="index">
          <div>{{family.father}}</div>
          <div>{{family.mother}}</div>
          <div>{{item}}</div>
          <v-btn @click="display(index)">shout</v-btn>
        </li>
      </ul>
    </div>

    <div class="_1">francis</div>
    <v-btn @click="hi">getData</v-btn>
      
    fffff
  </div>
</template>

<script>
export default {
  props: ['projects'],

  data() {
    return {
      arr: '',
      projectToLoop: [],
      item: '',
      family: [
        {father: 'john bosco', mother: 'marylene'},
        {father: 'price charles', mother: 'cassandra'}
      ]
    }
  },

  computed: {
    myProjects () {
      return JSON.parse(this.projects)
    }
    
  },

  methods: {
    display(index){
      this.item = this.family[index].father
    },
    // sort(prop) {
    //   this.myProjects.sort((a, b) => a[prop] > b[prop] ? -1 : 1)
    // },
    hh () {
      alert(this.arr.length)
    },
    hi(){
      console.log('axios')
      axios.get('https://api.globalgiving.org/api/public/projectservice/campaign/187/projects?api_key=000f2073-0fec-4ef0-94cf-8c4eb21be1d1', {crossdomain:true}).then((res)=>{
      console.log(res)
    })

    },
    hello() {
      
      this.arr = document.querySelectorAll('[data-score] input[type="checkbox"]:checked').length

    }
  }

}
</script>

<style>

  ._1{
    color: red
  }
   /* ._1 input[type="checkbox"]:checked {
    display: none;
  } */

  [data-score] {
    color: brown;
  }

</style>