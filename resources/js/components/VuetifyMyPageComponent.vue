<template>
<v-app>
  <v-content>
    <v-container>
      <v-row>
        <v-col cols="12">
          <v-row>
            <v-col cols="12" md="4" v-for="(custom_quiz, custom_quiz_index) in user_custom_quiz.data" :key="custom_quiz_index">
              <v-card max-height="300" class="overflow-y-auto">
                <v-card-title>
                  <v-spacer></v-spacer>
                  <v-btn class="primary" @click="startCustomQuiz(custom_quiz)" small>start</v-btn>
                </v-card-title>
                <v-card-text v-for="(provision_id, p_id) in custom_quiz" :key="p_id">
                  {{ provision_apart.data[provision_id.provision_id - 1].title + provision_apart.data[provision_id.provision_id - 1].caption}}
                </v-card-text>
                <v-card-actions>
                  <!-- <v-btn text small @click="editCustomQuiz(custom_quiz_index)">
                    <v-icon>mdi-pencil</v-icon>edit
                  </v-btn> -->
                  <v-btn text small @click="deleteCustomQuiz(custom_quiz_index)">
                    <v-icon>mdi-trash-can-outline</v-icon><span class="">delete</span>
                  </v-btn>
                </v-card-actions>
              </v-card>
            </v-col>
            <v-col cols="2">
              <CustomQuizFormModal></CustomQuizFormModal>
            </v-col>
          </v-row>
          <v-row>
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
                    <v-list-item-title>
                      {{ p.title + p.caption }}
                      <v-spacer></v-spacer>
                      {{ shapingCorrectnessData(p.id) }}
                    </v-list-item-title>
                  </v-list-item>
                </v-list-group>
              </v-list>
            </v-col>
          </v-row>
        </v-col>
      </v-row>
    </v-container>
  </v-content>
</v-app>
</template>
<script>
import GlobalStateManager from "./state/GlobalStateManager";
import CustomQuizFormModal from "./modal/CustomQuizFormModal";

export default {
  components: {
    CustomQuizFormModal,
  },
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

    deleteCustomQuiz: function(custom_quiz_index) {
      let result = confirm("このカスタムクイズを削除してもよろしいですか");
      if (result) {
        let params = {
          custom_quiz_id: custom_quiz_index,
          user_id: this.user_id.data,
        };
        console.log(params);
        axios.delete('/api/user_custom_quiz', {data: params})
          .then(function(res) {
            console.log('axios delete user_custom_quiz success!', res);
            GlobalStateManager.setUserCustomQuiz(res.data);
            alert("削除しました");
          }).catch(function(error) {
            console.log("axios delete user_custom_quiz failed...", error);
          });

      } else {
        return;
      }
    },
    shapingCorrectnessData: function(p_id) {
      let return_text = "";
      if ((this.user_correctness.data["wrong_" + p_id] + this.user_correctness.data["correct_" + p_id]) === 0) {
        return_text = "正答回数：" + this.user_correctness.data["correct_" + p_id] + "　" + "総回答回数：" + (this.user_correctness.data["wrong_" + p_id] + this.user_correctness.data["correct_" + p_id]) + "　" + "正答率：" + "---" + "％";
      } else {
        return_text = "正答回数：" + this.user_correctness.data["correct_" + p_id] + "　" + "総回答回数：" + (this.user_correctness.data["wrong_" + p_id] + this.user_correctness.data["correct_" + p_id]) + "　" + "正答率：" + Math.floor((this.user_correctness
          .data["correct_" + p_id] / (this.user_correctness.data["wrong_" + p_id] + this.user_correctness.data["correct_" + p_id])) * 100) + "％";

      }
      return return_text;
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
    GlobalStateManager.axiosgetUserCustomQuiz(this.user_id.data);
    this.chapter_clicked_flags = {
      "1": false,
      "2": false,
      "3": false,
      "4": false,
      "5": false,
      "6": false,
      "7": false,
      "8": false,
      "9": false,
      "10": false,
      "11": false,
    };
  },
}
</script>
