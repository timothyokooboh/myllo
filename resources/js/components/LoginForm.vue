<template>
  <v-container>
    <v-card>
      <v-card-title>
        <v-layout column class="align-center py-5">
          <v-flex>
            <v-btn text color="#032E74" >
            <span class="display-1 font-weight-bold">Myllo</span>
            <v-icon right>mdi-notebook-multiple</v-icon>
          </v-btn>
          </v-flex>

          <v-flex class="my-5">
            <div style="text-transform: uppercase; color: #032E74"> 
               Welcome back, Sign In 
            </div>
          </v-flex>
          
        </v-layout>
      </v-card-title>

      <v-form ref="form" method="POST" :action="formAction" @submit="submit" >
        <!-- The slot inputs the csrf token into the form -->

        <slot></slot>

        <v-text-field 
          name="email" 
          type = 'email'
          required 
          class="pa-3" 
          label="Email" 
          append-icon="mdi-email" 
          :rules="emailRules" outlined shaped
          ></v-text-field>

        <v-text-field 
          name="password" 
          v-model = "passwordInput" 
          :type="show1 ? 'text' : 'password'"
          required 
          class="pa-3" 
          label="Password" 
          :rules="passwordRules" 
          outlined 
          shaped 
          :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'" 
          @click:append="show1 = !show1"></v-text-field>

        <v-btn type="submit" dark color="#032E74" :loading="loadingContent" width="100%" class="title"> Sign In</v-btn>
      </v-form>

      <div class="optional-routes" >

        <div v-if="isResetPasswordRoute">
          <a :href="resetPasswordRoute">Forgot Password?</a>
        </div>

        <div>
          <a href="/register">Create Account</a>
        </div>

      </div>

    </v-card>
  </v-container>
</template>

<script>
export default {
  props: [
    'formAction',
    'isResetPasswordRoute',
    'resetPasswordRoute'
  ],
  data () {
    return {
      show1: false,
      show2: false,
      email: '',
      passwordInput: '',
      emailRules: [
        v => !!v || 'E-mail is required',
        v => /.+@.+\..+/.test(v) || 'E-mail must be valid'
      ],

      passwordRules: [
        v => !!v || 'Password is required',
        v => v.length >= 8 || 'Minimum length of eight characters',
      ],

      loadingContent: false
    }
  },

  methods: {
    submit (e) {
      if ( this.$refs.form.validate() ) {
        this.loadingContent = true;
        return true
      }
      e.preventDefault()
    }
  }
}
</script>

<style scoped>
  .optional-routes {
    display: flex;
    justify-content: space-between;
    padding: 20px 5px;
  }
</style>