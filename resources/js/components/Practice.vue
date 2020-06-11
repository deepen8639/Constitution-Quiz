<template>
<!-- 行をクリックした時にその行のクイズを始める。
  カスタマイズをクリックすると個別の条文が表示される。 -->
<v-app>
  <v-content>
    <v-container fluid fill-height>
      <v-layout wrap>
        <v-list>
          <v-list-group v-for="(chapter_obj, chapter_id) in chapter.data" :key="chapter_id">
            <template
              v-slot:activator>
              <v-list-item-action>
                <v-checkbox
                v-model="chapter_selected[chapter_id]"
                @click.stop="changeChapterCheckbox(chapter_id)">
                </v-checkbox>
              </v-list-item-action>
              <v-list-item-title v-text="chapter_obj.number + ' ' + chapter_obj.name"></v-list-item-title>
            </template>
            <v-list-item v-for="(p, j) in provision.data[chapter_id]" :key="j">
              <v-list-item-action>
                <v-checkbox
                  :value="p.id"
                  v-model="provision_selected[chapter_id]"
                  @change="refreshChaptercheckbox(chapter_id)">
                </v-checkbox>
              </v-list-item-action>
              <v-list-item-title v-text='p.title + p.caption'>
              </v-list-item-title>
            </v-list-item>
          </v-list-group>
        </v-list>

      </v-layout>
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
      temp_user_custom_quiz: GlobalStateManager.state.temp_user_custom_quiz,

      chapter_selected: [],
      provision_selected: [],

    }
  },
  methods: {
    changeChapterCheckbox: function(id) {
      let self = this;
      this.chapter_selected[id] = !this.chapter_selected[id];
      this.provision_selected[id] = [];
      if(this.chapter_selected[id]){
        this.provision.data[id].forEach(function(p){
          self.provision_selected[id].push(p.id);
        });
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
    },

    mountedMethod: function() {
      this.chapter_selected = {
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
      //provision_selectedのセット
        this.provision_selected = {
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
        };
    }

  },

  mounted() {
    console.log('ConstitutionHomeComponent mounted.');
    //条文データと章データをajaxで取得
    GlobalStateManager.axiosgetChapter();
    GlobalStateManager.axiosgetProvision();
    this.mountedMethod();
  },
}
</script>
