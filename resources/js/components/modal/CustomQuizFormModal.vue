<template>
<!-- <v-row justify="center"> -->
<v-dialog v-model="dialog" max-width="600px">
  <template v-slot:activator="{ on, attrs }">
    <v-btn small v-bind="attrs" v-on="on">
      <v-icon>mdi-folder-plus-outline</v-icon>
      create
    </v-btn>
  </template>
  <v-card>
    <v-card-title>
      <span class="headline">条文を選択</span>
    </v-card-title>
    <v-card-text>
      <v-list>
        <v-list-group v-for="(chapter_obj, chapter_id) in chapter.data" :key="chapter_id">
          <template v-slot:activator>
            <v-list-item-action>
              <v-checkbox v-model="chapter_selected[chapter_id]" @click.stop="changeChapterCheckbox(chapter_id)">
              </v-checkbox>
            </v-list-item-action>
            <v-list-item-title v-text="chapter_obj.number + ' ' + chapter_obj.name"></v-list-item-title>
          </template>
          <v-list-item class="ml-5" v-for="(p, j) in provision.data[chapter_id]" :key="j">
            <v-list-item-action>
              <v-checkbox :value="p.id" v-model="provision_selected[chapter_id]" @change="refreshChaptercheckbox(chapter_id)">
              </v-checkbox>
            </v-list-item-action>
            <v-list-item-title v-text='p.title + p.caption'>
            </v-list-item-title>
          </v-list-item>
        </v-list-group>
      </v-list>
    </v-card-text>
    <v-card-actions>
      <v-spacer></v-spacer>
      <v-btn color="green darken-1" text @click="dialog = false">cancel</v-btn>
      <v-btn color="green darken-1" text v-if="selected" @click="createCustomQuiz">create</v-btn>
    </v-card-actions>
  </v-card>
</v-dialog>
<!-- </v-row> -->
</template>
<script>
import GlobalStateManager from "../state/GlobalStateManager";

export default {
  data: function() {
    return {
      chapter: GlobalStateManager.state.Chapter,
      provision: GlobalStateManager.state.Provision,
      user_id: GlobalStateManager.state.user_id,
      // user_custom_quiz: GlobalStateManager.state.user_custom_quiz,
      provision_apart: GlobalStateManager.state.Provision_apart,
      // user_correctness: GlobalStateManager.state.user_correctness,
      dialog: false,
      selected: false,
      chapter_selected: {
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
      },
      //provision_selectedのセット
      provision_selected: {
        "1": [],
        "2": [],
        "3": [],
        "4": [],
        "5": [],
        "6": [],
        "7": [],
        "8": [],
        "9": [],
        "10": [],
        "11": [],
      },

    }
  },

  methods: {
    createCustomQuiz: function() {
      let self = this;
      let confirm_text = this.returnConfirmText(this.provision_selected);
      let result = confirm(confirm_text);
      if (result) {
        let params = {
          user_id: this.user_id.data,
          provision_selected: this.provision_selected,
        }
        axios.post('/api/user_custom_quiz', params)
          .then(function(res){
            console.log('axios post user_custom_quiz success!', res);
            GlobalStateManager.setUserCustomQuiz(res.data);
            self.dialog = false;
          }).catch(function(error){
            console.log('axios post user_custom_quiz failed...', error);
          });
      } else {
        return;
      }

    },

    changeChapterCheckbox: function(id) {
      let self = this;
      this.chapter_selected[id] = !this.chapter_selected[id];
      this.provision_selected[id] = [];
      if (this.chapter_selected[id]) {
        this.provision.data[id].forEach(function(p) {
          self.provision_selected[id].push(p.id);
        });
      }
      // let self = this;
      this.selected = false;
      for (var i = 1; i < 12; i++) {
        if (0 < self.provision_selected[i].length) {
          self.selected = true;
        }
      }
    },

    refreshChaptercheckbox: function(id) {
      if (this.provision_selected[id].length == this.provision.data[id].length) {
        this.chapter_selected[id] = true;
        // alert("provision full");
      } else {
        this.chapter_selected[id] = false;
        // alert("provision not full");
      }
      let self = this;
      this.selected = false;
      for (var i = 1; i < 12; i++) {
        if (0 < self.provision_selected[i].length) {
          self.selected = true;
        }
      }
    },
    returnConfirmText: function(provision_selected) {
      let self = this;
      let return_text = "";
      for (var chapter_id = 1; chapter_id < 12; chapter_id++) {
        provision_selected[chapter_id].forEach((provision_id, i) => {
          return_text += self.provision_apart.data[provision_id - 1].title + self.provision_apart.data[provision_id - 1].caption + "\n";
        });
      }
      return return_text + "上記の条文をカスタムクイズとして登録します。";
    }

  }

}
</script>
