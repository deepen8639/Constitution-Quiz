<template>
  <div class="container">
    <h1>Result</h1>
    <h1>あなたは{{ totalCount }}問中<strong>{{ totalCount - wrongCount }}問</strong>正解しました。</h1>
  </div>

</template>

<script>
    export default {
      props: {
        wrongCount: Number,
        totalCount: Number
      },
      methods: {
        isSetAttribute(w,t){
          if(typeof w === 'undefined' & typeof t === 'undefined'){
            this.$router.push({name: 'constitution.home' });
            return;
          }
        }
      },
      mounted() {
            console.log('ConstitutionResultComponent mounted.');
            this.isSetAttribute(this.wrongCount, this.totalCount);
        }
    }
</script>
