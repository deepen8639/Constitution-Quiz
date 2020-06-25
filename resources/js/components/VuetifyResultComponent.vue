<template>
<v-app>
  <v-content>
    <v-container fill-height>
      <v-row>
        <v-col cols="12">
          <div class="display-1">
            {{ quiz_total_count }}問中
          </div>
        </v-col>
      </v-row>
      <v-row>
        <v-col cols="12">
          <div class="display-1">
            {{ quiz_total_count - wrong_count}}問正解しました
          </div>
        </v-col>
      </v-row>
      <v-row>
        <v-col cols="12">
          <div class="" v-if="wrong_provision">
            間違えた条文
          </div>
        </v-col>
      </v-row>
      <v-row>
        <v-col cols="12" v-for="(provision,p_id) in wrong_provision" :key=p_id>
          <div class="">
            ・{{ provision.title + provision.caption }}
          </div>
          <div class="">
            {{ provision.provision }}
          </div>
        </v-col>
      </v-row>
    </v-container>
  </v-content>
</v-app>
</template>
<script>
import GlobalStateManager from "./state/GlobalStateManager";

export default {
  props: {
    wrong_count: Number,
    wrong_provision: Array,
    quiz_total_count: Number,
    provision_selected_apart: Array,
    correct_provision: Array,
  },
  data: function() {
    return {
      provision: GlobalStateManager.state.Provision,
      user_id: GlobalStateManager.state.user_id,
    }
  },
  methods: {
    wrong_provision_clicked: function(provision) {
      if (provision.is_clicked) {
        provision.is_clicked = false;
      } else {
        provision.is_clicked = true;
      }
    }
  },

  mounted() {
    console.log('VuetifyResultComponent mounted.');
    for (var i = 0; i < this.wrong_provision.length; i++) {
      this.wrong_provision[i]["is_clicked"] = false;
      this.wrong_provision[i].provision = this.wrong_provision[i].provision.replace('（　　　）', this.wrong_provision[i].blank);
    }
    GlobalStateManager.axiosputUserCorrectness(this.user_id.data, this.wrong_provision, this.correct_provision);
  },
}
</script>
