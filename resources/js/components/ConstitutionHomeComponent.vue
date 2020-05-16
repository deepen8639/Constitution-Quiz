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
            <tr v-for="c in chapter">
              <td>{{c.id}}</td>
              <td>{{c.number}}</td>
              <td>{{c.name}}</td>
              <td>
                <router-link v-bind:to="{name: 'constitution.quiz', params: {chapterId: c.id}}">
                  <button type="submit" class="btn btn-primary ">練習する</button>
                </router-link>
                </td>
            </tr>

          </tbody>
      </table>
  </div>

</template>

<script>
    export default {
      data: function(){
        return{
          chapter: []
        }
      },
      methods: {
        getChapter(){
          axios.get('/api/chapter')
          .then((res) => {
            this.chapter = res.data;
          });
        }

      },

      mounted() {
            console.log('ConstitutionHomeComponent mounted.');
            this.getChapter();
        }
    }
</script>
