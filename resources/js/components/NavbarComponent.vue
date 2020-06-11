<template>

    <nav>
      <v-app-bar app color="#032E74">
        <v-app-bar-nav-icon color="#fff" @click = "drawer = !drawer" v-if="!guest" ></v-app-bar-nav-icon>
        <v-btn text color="#12FFCD" @click="dashboardRoute">
          <span class="title font-weight-bold">Myllo</span>
          <v-icon right>mdi-notebook-multiple</v-icon>
        </v-btn>

        <v-spacer></v-spacer>

        <v-menu offset-y>

          <template v-slot:activator="{on}">
            <v-btn text color="#12FFCD" v-on="on" class="hidden-sm-and-up">
              <v-icon>mdi-menu-down</v-icon>
              <span>Menu</span>
            </v-btn>
          </template>

          <v-card class="hidden-sm-and-up">

            <v-list v-if="guest">
              <v-list-item>
                <v-btn text @click="loginPage">
                  <v-icon left>mdi-login</v-icon>
                  <v-list-item-title>Login</v-list-item-title>
                </v-btn>
              </v-list-item>

              <v-list-item v-if="isRegisterRoute">
                <v-btn text @click="registerPage">
                  <v-icon left>mdi-account-plus-outline</v-icon>
                  <v-list-item-title>Register</v-list-item-title>
                </v-btn>
              </v-list-item>
            </v-list>

            <v-list v-if="!guest">
              <v-list-item>
                <v-btn text @click="signOut">
                  <v-icon left>mdi-exit-to-app</v-icon>
                  <v-list-item-title>Sign out</v-list-item-title>
                </v-btn>
              </v-list-item>
            </v-list>

          </v-card>
        </v-menu>

        <div class="routes hidden-xs-only" >
          <ul>
            <li v-if="guest">
              <v-btn text color="#12FFCD" @click="loginPage" style="cursor:pointer">Login</v-btn>
              <v-btn text color="#12FFCD" v-if="isRegisterRoute" @click="registerPage" style="cursor:pointer">Register</v-btn>
            </li>
            <li v-if="!guest">
              <v-btn text color="#12FFCD" @click="signOut">
                <span> Sign Out</span>
                <v-icon> mdi-exit-to-app</v-icon>
              </v-btn>
            </li>
          </ul>
        </div>

        <form :action="logoutRoute" method="POST" style="display:none" id="logout-form">
          <slot></slot>
        </form>

      </v-app-bar>

      <v-navigation-drawer app v-model="drawer" v-if="!guest" color="#0848B1">
        <v-layout column align-center class="mt-5">
          <v-flex>
            <v-avatar size="150" v-if="!isAvatar">
              <img src="/images/profilePicture.svg" alt="default profile picture">
            </v-avatar>
            <v-avatar size="150" v-else>
              <img :src="avatar"  alt="user's profile picture">
            </v-avatar>
          </v-flex>

          <v-flex>
            <span v-if="isUsername" class="white--text">{{username}}</span>
            <span v-else class="white--text">{{email}}</span>
            <v-icon color="white" style="cursor:pointer" @click="editProfile">mdi-pencil</v-icon>
          </v-flex>

          <v-flex class="mt-5">
            <v-dialog>
              <template v-slot:activator="{on}">
                <v-btn v-on="on">Add a project</v-btn>
              </template>
              <v-card>
                <h1 class="text-center pa-3">Add a project</h1>

                <form action="/projects" method="POST" >
                  <slot></slot>

                  <v-text-field label="Project Title" name="title" class="px-5"></v-text-field>

                  <v-text-field label="Project Description" name="description" class="px-5"></v-text-field>

                  <div class="px-5 my-5">
                    <span class="title">Break down project into tasks</span>
                    <div v-for="(task, index) in tasks" :key="index">
                      <v-chip>{{task}}</v-chip>
                      <v-icon @click="deleteTask(index)">mdi-close-circle</v-icon>
                    </div>
                    <v-text-field v-model="task" ref="tasks" placeholder="Enter a task"></v-text-field>
                    <v-btn small @click="addTask">Add task</v-btn>
                  </div>

                  <fieldset v-for="task in tasks" :key="task" class="px-5" style="display:none">
                    <v-text-field type="checkbox" name="tasks[]" :value="task" checked></v-text-field>
                  </fieldset>

                  <v-menu>
                    <template v-slot:activator="{on}">
                      <v-text-field label="Due Date" :value="due" name="due" v-on="on" class="px-5"></v-text-field>
                    </template>
                    <v-date-picker v-model="due"></v-date-picker>
                  </v-menu>

                  <v-btn type="submit" width="100%" class="pink white--text" :loading="loading">Add Project</v-btn>
                </form>
              </v-card>
            </v-dialog>
          </v-flex>

        </v-layout>

        <v-layout column align-center class="mt-5">
          <v-flex>
            <v-btn text color="white" @click="dashboardRoute"> DASHBOARD </v-btn>
          </v-flex>
        </v-layout>
      </v-navigation-drawer>
    </nav>

</template>
<script>
export default {
  props: [
    'guest',
    'isRegisterRoute',
    'logoutRoute',
    'csrfToken',
    'avatar',
    'isAvatar',
    'isUsername',
    'username',
    'email',
    'editProfileRoute'
  ],
  data(){
    return {
      drawer: false,
      due: '',
      task: '',
      tasks: [],
      loading: false
    }
  },
  methods: {
    landingPage () {
      window.location = '/'
    },
    loginPage () {
      window.location = '/login'
    },
    registerPage () {
      window.location = '/register'
    },
    editProfile () {
      window.location = this.editProfileRoute
    },
    dashboardRoute () {
      window.location = '/home'
    },
    signOut () {  
      document.getElementById('logout-form').submit()
    },
    addTask () {
      this.tasks.push(this.task)
      this.task = ''
    },
    deleteTask (index) {
      this.tasks.splice(index, 1)
    }

  }
}
</script>

<style scoped>
  #project-title {
    color: #12FFCD;
    text-decoration: none;
  }
  .routes ul {
    list-style-type: none;
    display: flex;
    margin-right: 10px;
  }
  .routes ul li {
    color: #12FFCD;
    padding-left: 20px;
    font-size: 18px;
    font-weight: bold;
  }
</style>