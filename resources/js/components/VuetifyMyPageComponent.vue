<template>
<v-app>
  <v-content>
    <v-container>
      <v-row>
        <v-col cols="12">
          <!-- <v-sheet color="grey lighten-3" style="width: 100%;"> -->
            <v-row>
              <v-col cols="12" md="4" v-for="(custom_quiz, custom_quiz_index) in user_custom_quiz.data" :key="custom_quiz_index">
                <v-card max-height="400" class="overflow-y-auto">
                  <v-card-title>
                    <!-- {{ custom_quiz_index }} -->
                    <v-spacer></v-spacer>
                    <v-btn class="primary" @click="startCustomQuiz(custom_quiz)" small>start</v-btn>
                  </v-card-title>
                  <v-card-text v-for="(provision_id, p_id) in custom_quiz" :key="p_id">
                    {{ provision_apart.data[provision_id.provision_id - 1].title + provision_apart.data[provision_id.provision_id - 1].caption}}
                  </v-card-text>
                  <v-card-actions>
                    <v-btn text small @click="editCustomQuiz(custom_quiz_index)">
                      <v-icon>mdi-pencil</v-icon>edit
                    </v-btn>
                    <v-btn text small @click="deleteCustomQuiz(custom_quiz_index)">
                      <v-icon>mdi-trash-can-outline</v-icon><span class="">delete</span>
                    </v-btn>
                  </v-card-actions>
                </v-card>
              </v-col>
              <v-col cols="2">
                <v-btn small @click="clickedCreateButton">
                  <v-icon>mdi-folder-plus-outline</v-icon>
                  <span class="">create</span>
                </v-btn>
              </v-col>
            </v-row>
            <!-- <v-row>
              <v-col>
                <span class="h5">Correctness Data</span>

                <v-list>
                  <v-list-group v-for="(chapter_obj, chapter_id) in chapter.data" :key="chapter_id">
                    <template v-slot:activator>
                      <v-list-item-title v-text="chapter_obj.number + ' ' + chapter_obj.name">
                        <v-spacer></v-spacer>
                      </v-list-item-title>
                    </template>
                    <v-list-item class="ml-5" v-for="(p, j) in provision.data[chapter_id]" :key="j">
                      <v-list-item-title v-text='p.title + p.caption'>
                      </v-list-item-title>
                    </v-list-item>
                  </v-list-group>
                </v-list>
              </v-col>
            </v-row> -->
          <!-- </v-sheet> -->
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
      chapter: GlobalStateManager.state.Chapter,
      provision: GlobalStateManager.state.Provision,
      user_id: GlobalStateManager.state.user_id,
      user_custom_quiz: GlobalStateManager.state.user_custom_quiz,
      provision_apart: GlobalStateManager.state.Provision_apart,
      user_correctness: GlobalStateManager.state.user_correctness,

    }
  },
  methods: {
    clickedCreateButton: function() {
      //カスタムクイズの作成フォームを開く
    },
    createCustomQuiz: function(custom_quiz) {

    },
    editCustomQuiz: function(custom_quiz_index) {

    },
    deleteCustomQuiz: function(custom_quiz_index) {

    },
    startCustomQuiz: function(custom_quiz) {
      let self = this;
      let provision_selected = {};
      for (var i = 0; i < 12; i++) {
        provision_selected[i] = Array();
      }
      custom_quiz.forEach(function(c_q) {
        provision_selected[self.provision_apart.data[c_q.provision_id - 1].chapter_id].push(c_q.provision_id);
      });
      let params = {
        provision_selected: provision_selected
      };
      self.$router.push({
        name: "constitution.quiz",
        params: params
      });
    },
    checkLogin: function() {
      let self = this;
      if (this.user_id.data) {
        return;
      } else {
        self.$router.push({
          name: "constitution.login"
        });
      }
    }
  },

  mounted() {
    console.log('VuetifyMyPageComponent mounted.');
    this.checkLogin();
    GlobalStateManager.axiosgetUserCorrectness(this.user_id.data);
  },
}
</script>
