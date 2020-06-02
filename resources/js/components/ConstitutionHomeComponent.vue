<template>
<div class="container">
  <table class="table table-hover">
    <thead class="thead-light">
      <tr>
        <th scope="col">id</th>
        <th scope="col">章</th>
        <th scope="col">条文</th>
        <th scope="col"></th>

      </tr>
    </thead>
    <tbody>
      <tr v-for="c in chapter.data">
        <td>{{c.id}}</td>
        <td>{{c.number}}</td>
        <td>{{c.name}}</td>
        <td>
          <router-link v-bind:to="{name: 'constitution.quiz', params: {chapterId: c.id}}">
            <button type="submit" class="btn btn-primary ">Start</button>
          </router-link>
        </td>
      </tr>

    </tbody>
  </table>
</div>
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
    }
  },
  methods: {
  },

  mounted() {
    console.log('ConstitutionHomeComponent mounted.');
    GlobalStateManager.axiosgetChapter();
    GlobalStateManager.axiosgetProvision();
  }
}
</script>
