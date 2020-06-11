<template>
  <div>
    <h1>Edit Your Profile</h1>

    <v-snackbar v-model="snackbar" :timeout="2000" top color="info">
      <div class="title">Profile updated sucessfully</div>
    </v-snackbar>

    <v-avatar size="150" v-if="!isAvatar">
      <img src="/images/profilePicture.svg" id="picture" alt="default profile picture">
    </v-avatar>

    <v-avatar size="150" v-else>
      <img :src="avatar" id="picture" alt="default profile picture">
    </v-avatar>

    <v-tooltip top color="pink">
      <template v-slot:activator="{on}">
         <v-icon x-large class="mx-5" @click="openFile" v-on="on">mdi-camera</v-icon>
      </template>
      <span>Upload Profile Picture</span>
    </v-tooltip>

    <v-card flat class="mt-5">
      <v-form :action="formAction" method="POST" enctype="multipart/form-data">

        <slot name="csrf">  </slot>
        <slot name="patch"></slot>

        <v-text-field type="file" name="avatar" accept="image/*" onchange="loadFile(event)" id="file" style="display:none"></v-text-field>
        <!-- The code for the loadFile function is written on edit.blade.php file. Because executing the code inside the vue component throws an error. I will try to fix the bug later -->

        <v-text-field name="firstName" label="First Name" :value="firstName" outlined shaped></v-text-field>
        <v-text-field name="lastName" label="Last Name" :value="lastName" outlined shaped></v-text-field>
        <v-text-field name="username" label="username" :value="username" outlined shaped></v-text-field>
        <v-btn type="submit" :loading="loading" @click="submit" width="100%">Save</v-btn>
      </v-form>
    </v-card>
  </div>
</template>

<script>
export default {
  props: [
    'formAction',
    'username',
    'firstName',
    'lastName',
    'avatar',
    'isAvatar',
    'snackbar'
  ],
  data () {
    return {
      loading: false,
    }
  },
  methods: {
    openFile () {
      document.getElementById('file').click()
    },
    submit () {
      this.loading = true
    }
  }
}
</script>