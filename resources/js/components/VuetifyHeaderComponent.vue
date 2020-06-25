<template>
<v-card color="grey lighten-4" flat tile>
  <v-toolbar>
    <v-toolbar-title>Constitution Quiz
      <span v-if="user_id.data" class="ml-2">Login as: {{ user_id.data }}</span></v-toolbar-title>
    <v-spacer></v-spacer>
    <v-btn @click="axiosLogout" text small v-if="user_id.data">
      logout
    </v-btn>
    <!-- <router-link v-bind:to="{ name: 'constitution.login'}">
      <v-btn text small v-if="!user_id.data">
        <v-icon>mdi-login</v-icon>
        login
      </v-btn>
    </router-link> -->
    <v-btn @click="moveMyPage" text small v-if="user_id.data">
      <v-icon>mdi-account</v-icon>
      mypage
    </v-btn>
    <router-link v-bind:to="{ name: 'constitution.home'}">
      <v-btn icon>
        <v-icon>mdi-home</v-icon>
      </v-btn>
    </router-link>
  </v-toolbar>
</v-card>
</template>

</template>
<script>
import GlobalStateManager from "./state/GlobalStateManager";

export default {
  data: function() {
    return {
      user_id: GlobalStateManager.state.user_id,
    }
  },
  methods: {
    axiosLogout() {
      if (this.user_id.data) {
        axios.post("/logout")
          .then(function(response) {
            console.log(response)
            GlobalStateManager.initUserState();
            alert("ログアウトしました");
            this.$router.push({
              name: "constitution.home"
            });
          }.bind(this))

          .catch(function(error) {
            console.log(error)
          }.bind(this))

      } else {
        this.$router.push({
          name: "constitution.login"
        });
      }
    },

    moveMyPage() {
      this.$router.push({
        name: "constitution.mypage"
      });
    },
  },
  mounted() {
    console.log('VuetifyHeaderComponent mounted.')
  }
}
</script>
