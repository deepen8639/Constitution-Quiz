<template>
<v-app id="inspire">
  <v-content>
    <v-container class="fill-height" fluid>
      <v-row align="center" justify="center">
        <v-col cols="12" sm="8" md="4">
          <v-card class="elevation-12">
            <v-toolbar color="primary" dark flat>
              <v-toolbar-title>Login form</v-toolbar-title>
              <v-spacer></v-spacer>
            </v-toolbar>
            <v-card-text>
              <v-form>
                <v-text-field label="UserID" name="user_id" prepend-icon="mdi-account" type="text" v-model="form_user_id"></v-text-field>
                <!-- <div class="red" v-if="error != null">
                  {{ error.response.data.errors.user_id[0] }}
                </div> -->

                <v-text-field id="password" label="Password" name="password" prepend-icon="mdi-lock" type="password" v-model="form_password"></v-text-field>
              </v-form>
            </v-card-text>
            <v-card-actions>
              <v-btn color="" @click="moveRegisterPage">Register</v-btn>
              <v-spacer></v-spacer>
              <v-btn color="primary" @click="axiosLogin(form_user_id, form_password)">Login</v-btn>
            </v-card-actions>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </v-content>
</v-app>
</template>

<script>
import GlobalStateManager from "./state/GlobalStateManager";

export default {
  data: function() {
    return {
      form_user_id: "",
      form_password: "",
      csrfToken: "",
      user_id: GlobalStateManager.state.user_id,
      chapter: GlobalStateManager.state.Chapter,
      provision: GlobalStateManager.state.Provision,

      error: null,
      response: null,
    }
  },
  props: {
    loginpass: String,
    registerpass: String,
    logoutpass: String,
  },

  methods: {
    axiosLogin(user_id, password) {
      let authinfo = {
        "user_id": user_id,
        "password": password,
        "_token": this.csrfToken,
      }
      console.log(authinfo);

      axios.post("/login", authinfo)
        .then(function(res) {
          console.log("response is", res);
          this.response = res;
          GlobalStateManager.setUserId(user_id);
          GlobalStateManager.axiosgetUserCustomQuiz(user_id);
          // this.$router.push({
          //   name: "constitution.mypage"
          // });
        }.bind(this))

        .catch(function(error) {
          console.log("login error ", error);
          this.error = error;
        }.bind(this));
    },
    moveRegisterPage() {
      this.$router.push({name: "constitution.register"})
    },


  },
  created() {
    this.csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    //もしもログインしているならばマイページに飛ぶ
    // if (this.user_id.data) {
    //   this.$router.push({name: "constitution.mypage"});
    // } else {
    //   return;
    // }
  }
}
</script>
