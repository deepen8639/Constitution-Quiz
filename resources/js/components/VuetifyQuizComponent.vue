<template>
<v-app>
  <v-content>
    <v-container fill-height>

      <v-row style="height:30%; width: 100%" app>
        <v-col cols="12">
          <v-alert v-if="correctness == null" border="top" outlined color="gray darken-1" style="height: 100%;">
            空欄に当てはまる選択肢を選んでください
          </v-alert>
          <v-alert v-if="correctness == 'wrong'" border="top" outlined color="blue darken-1" style="height: 100%;">
            <div class="display-4">
              不正解
            </div>
          </v-alert>
          <v-alert v-if="correctness == 'correct'" border="top" outlined color="red darken-1" style="height: 100%;">
            <div class="display-4">
              正解 <span v-bind:class="{'display-2': quiz.blank_less_than_4, 'display-1': !quiz.blank_less_than_4}">{{ quiz.blank }}
                <v-btn @click="go_next_quiz" class="h2" v-if="!final_quiz" :disabled="correctness != 'correct'">next</v-btn>
                <v-btn @click="go_next_quiz" class="h2" v-if="final_quiz" :disabled="correctness != 'correct'">result</v-btn>
              </span>
            </div>
          </v-alert>
        </v-col>
      </v-row>
      <v-row style="height:35%; width: 100%" app>
        <v-col cols="12">
          <v-card style="height: 100%;">
            <div>
              {{ quiz.title + quiz.caption }}
            </div>
            <div class="">
              {{ quiz.provision }}
            </div>
          </v-card>
        </v-col>
      </v-row>

      <v-row style="height:20%;">
        <v-col cols="12">
          <!--  -->
          <v-row>
            <v-col cols="12" style="padding-top: 0px;">
              <v-btn @click="check_quiz_correctness(quiz.choice_1)" :disabled="quiz.choice_1.is_clicked" style="width: 100%;">
                {{ quiz.choice_1.label }}
              </v-btn>
            </v-col>
            <v-col cols="12" style="padding-top: 0px;">
              <v-btn @click="check_quiz_correctness(quiz.choice_2)" :disabled="quiz.choice_2.is_clicked" style="width: 100%;">
                {{ quiz.choice_2.label }}
              </v-btn>
            </v-col>
            <v-col cols="12" style="padding-top: 0px;">
              <v-btn @click="check_quiz_correctness(quiz.choice_3)" :disabled="quiz.choice_3.is_clicked" style="width: 100%;">
                {{ quiz.choice_3.label }}
              </v-btn>
            </v-col>
          </v-row>
          <!--  -->
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
    provision_selected: Object,
  },
  data: function() {
    return {
      provision: GlobalStateManager.state.Provision,
      user_id: GlobalStateManager.state.user_id,
      user_custom_quiz: GlobalStateManager.state.user_custom_quiz,
      provision_apart: GlobalStateManager.state.Provision_apart,

      provision_selected_apart: [],
      now_quiz_index: 0,
      wrong_count: 0,
      wrong_provision: [],
      correct_provision: [],
      // quiz_total_count: 0,
      final_quiz: false,
      correctness: null,
      quiz: {
        title: "",
        caption: "",
        provision: "",
        choice_1: {
          label: "",
          is_clicked: false
        },
        choice_2: {
          label: "",
          is_clicked: false
        },
        choice_3: {
          label: "",
          is_clicked: false
        },
        blank: "",
        blank_less_than_4: true,
      },

    }
  },
  methods: {
    go_next_quiz: function() {
      //もし最後のクイズならば、リザルト画面に遷移する。
      if (this.final_quiz) {
        this.$router.push({
          name: "constitution.result",
          params: {
            wrong_count: this.wrong_count,
            wrong_provision: this.wrong_provision,
            quiz_total_count: this.provision_selected_apart.length,
            provision_selected_apart: this.provision_selected_apart,
            correct_provision: this.correct_provision,
          }
        });
        return;
      }
      this.now_quiz_index += 1;
      this.set_next_quiz();

    },
    check_quiz_correctness: function(choice) {
      if (choice.label == this.quiz.blank && this.correctness == null) {
        this.correctness = 'correct';
        this.quiz.choice_1.is_clicked = true;
        this.quiz.choice_2.is_clicked = true;
        this.quiz.choice_3.is_clicked = true;
        this.correct_provision.push(this.quiz);
      } else if (this.correctness == "wrong" && choice.label != this.quiz.blank) {
        choice.is_clicked = true;
      } else if (this.correctness == null && choice.label != this.quiz.blank) {
        this.correctness = 'wrong';
        choice.is_clicked = true;
        this.wrong_count += 1;
        this.wrong_provision.push(this.quiz);
      } else if (choice.label == this.quiz.blank && this.correctness == "wrong") {
        this.correctness = 'correct';
        this.quiz.choice_1.is_clicked = true;
        this.quiz.choice_2.is_clicked = true;
        this.quiz.choice_3.is_clicked = true;
      }
    },
    set_next_quiz: function() {
      let next_quiz_provision_id = this.provision_selected_apart[this.now_quiz_index];
      this.quiz = JSON.parse(JSON.stringify(this.provision_apart.data[next_quiz_provision_id - 1]));
      this.quiz.provision = this.quiz.provision.replace(this.quiz.blank, '（　　　）');
      //choiceをランダムに入れ替える
      let choices = [this.quiz.choice_1, this.quiz.choice_2, this.quiz.choice_3];
      for (var i = choices.length - 1; 0 < i; i--) {
        var r = Math.floor(Math.random() * (i + 1));
        var tmp = choices[i];
        choices[i] = choices[r];
        choices[r] = tmp;
      }
      this.quiz.choice_1 = {
        label: choices[0],
        is_clicked: false
      };
      this.quiz.choice_2 = {
        label: choices[1],
        is_clicked: false
      };
      this.quiz.choice_3 = {
        label: choices[2],
        is_clicked: false
      };

      if (this.provision_selected_apart.length == this.now_quiz_index + 1) {
        this.final_quiz = true;
      }
      if (this.quiz.blank.length <= 4) {
        this.quiz.blank_less_than_4 = true;
      } else {
        this.quiz.blank_less_than_4 = false;
      }
      this.correctness = null;

    },
    set_provision_selected_apart: function() {
      let self = this;
      for (let i = 1; i < 12; i++) {
        this.provision_selected[i].forEach(function(p) {
          self.provision_selected_apart.push(p);
        });
      }
    },


  },
  computed: {},

  mounted() {
    this.set_provision_selected_apart();
    this.set_next_quiz();
    console.log('ConstitutionQuizComponent mounted.');
  },
  beforeUpdate() {
  }
}
</script>
