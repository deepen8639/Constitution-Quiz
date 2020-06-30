<template>
  <v-app id="inspire">
    <v-content>
      <v-container
        class="fill-height"
        fluid
      >
        <v-row
          align="center"
          justify="center"
        >
          <v-col
            cols="12"
            sm="8"
            md="4"
          >
            <v-card class="elevation-12">
              <v-toolbar
                color="primary"
                dark
                flat
              >
                <v-toolbar-title>Register form</v-toolbar-title>
                <v-spacer></v-spacer>
                <!-- <v-tooltip bottom> -->
                  <!-- <template v-slot:activator="{ on }">
                    <v-btn
                      :href="source"
                      icon
                      large
                      target="_blank"
                      v-on="on"
                    >
                      <v-icon>mdi-code-tags</v-icon>
                    </v-btn>
                  </template> -->
                  <!-- <span>Source</span> -->
                <!-- </v-tooltip> -->
              </v-toolbar>
              <v-card-text>
                <v-form>
                  <v-text-field
                    label="UserID"
                    name="register"
                    prepend-icon="mdi-account"
                    type="text"
                    v-model="form_user_id"
                  ></v-text-field>

                  <v-text-field
                    id="password"
                    label="Password"
                    name="password"
                    prepend-icon="mdi-lock"
                    type="password"
                    v-model="password"
                  ></v-text-field>
                  <v-text-field
                    id="password"
                    label="Password"
                    name="password(confirm)"
                    prepend-icon="mdi-lock"
                    type="password"
                    v-model="password_confirmation"
                  ></v-text-field>
                </v-form>
              </v-card-text>
              <v-card-actions>
                <v-btn color="" @click="moveLoginPage">Login</v-btn>
                <v-spacer></v-spacer>
                <v-btn color="primary" @click="axiosRegister(form_user_id, password, password_confirmation)">Register</v-btn>
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
        password: "",
        password_confirmation: "",
        user_id: GlobalStateManager.state.user_id,
        chapter: GlobalStateManager.state.Chapter,
        provision: GlobalStateManager.state.Provision,
      }
    },
    props: {
      loginpass: String,
      registerpass: String,
      logoutpass: String,
    },

    methods: {
      axiosRegister(user_id, password, password_confirmation) {
        let authinfo = {
          "user_id": user_id,
          "password": password,
          "password_confirmation": password_confirmation,
          "_token": GlobalStateManager.state.csrfToken.data,
        }
        console.log(authinfo);

        axios.post("/register", authinfo)
          .then(function(res) {
            console.log(res);
            GlobalStateManager.setUserID(user_id);
            this.$router.push({
              name: "constitution.mypage"
            });
          }.bind(this))

          .catch(function(error) {
            console.log(error);
          }.bind(this));
      },
      moveLoginPage() {
        this.$router.push({name: "constitution.login"})
      },


    },
    created() {
      //もしもログインしているならばマイページに飛ぶ
      if (this.user_id.data) {
        this.$router.push({name: "constitution.mypage"});
      } else {
        return;
      }
    }
  }
</script>
