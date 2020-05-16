<template>
  <div class="container">
    <div class="row">

      <table class="table table-hover">
          <thead class="thead-light">
             <tr>
               <th class="text-center">空欄に当てはまる言葉を選びなさい</th>
             </tr>
          </thead>

      </table>
    </div>


      <div class="row">
        <div class="" v-if='correctness == "null"'>
          <p style="white-space:pre-wrap;"　class="display-2">&nbsp;</p>
        </div>

        <div class="row" v-if='correctness == "correct"'>
          <span style="white-space:pre-wrap;" class="display-1 text-primary text-center"><strong>◎</strong>正解</span>
        </div>
        <div class="row" v-else-if='correctness == "wrong"'>
          <span style="white-space:pre-wrap;" class="display-1 text-danger"><strong>✖</strong>不正解</span>
          <!-- <span class="h1">正しい答えは<strong>{{ blank }}</strong>です。</span> -->
        </div>


      </div>
      <div>

        <div class="row">
        <h4 class="">
          {{ title }}
        </h4>
      </div>
      <div class="row">

        <h4>
          {{ provision }}
        </h4>
      </div>
                <div class="row">
                  <button type="button" v-on:click="check(choices[0], 1)" v-bind:disabled='isclicked1' v-bind:class="classObject">{{ choices[0] }}</button>
                </div>
                <div class="row">
                  <button type="button" v-on:click="check(choices[1], 2)" v-bind:disabled='isclicked2' v-bind:class="classObject">{{ choices[1] }}</button>
                </div>
                <div class="row">
                  <button type="button" v-on:click="check(choices[2], 3)" v-bind:disabled='isclicked3' v-bind:class="classObject">{{ choices[2] }}</button>
                </div>
  </div>

</div>
</template>

<script>
    export default {
      props: {
        chapterId: Number
      },
      data: function(){
        return{
          quizes: [],
          index: 0,
          wrongCount: 0,
          totalCount: Number,
          choices: [],
          title: String,
          provision: String,
          caption: String,
          blank: String,
          correctness: 'null',
          classObject: {
            'btn-block': true,
            'btn-lg': true,
            'btn-success': false,
            'btn-secondary': false,
            'btn-lg': true
          },
          isclicked1: false,
          isclicked2: false,
          isclicked3: false
        }
      },
      methods: {
          getQuiz(){
            console.log('getQuiz start');
              axios.get('/api/quiz/' + String(this.chapterId))
              .then((res) => {
                this.quizes = res.data;
                // console.log(res.data);
                this.setQuiz(this.quizes[this.index]);
              });
            console.log('getQuiz done');
          },
          setQuiz(quiz){
            console.log('setQuiz start');
            this._setTitle(quiz);
            this._setCaption(quiz);
            this._setProvision(quiz);
            this._setBlank(quiz);
            this._setChoices(quiz);
            this.totalCount = this.quizes.length;
            console.log('setQuiz done');
          },
          check(choice, id){
            //正誤判定
            if (choice == this.blank & this.correctness != 'correct') {
              this.correctness = "correct";
              //clickされたボタンをdisabled
              this._isClicked(id);
              setTimeout(this._nextQuiz, 2000);
            }else if (choice != this.blank & this.correctness == 'null'){
              this.correctness = "wrong";
              this.wrongCount += 1;
              //clickされたボタンをdisabled
              this._isClicked(id);
              // setTimeout(this._nextQuiz, 2000);
            }else if (choice != this.blank & this.correctness == 'wrong') {
              //二回目の間違いの時
              //clickされたボタンをdisabled
              this._isClicked(id);
            }
            return;
          },
          //直接呼ぶことはないメソッド
          _isClicked(id){
            if (id==1){
              this.isclicked1 = true;
              // this.isclicked2 = true;
              // this.isclicked3 = true;
            }else if (id==2) {
              this.isclicked2 = true;
              // this.isclicked1 = true;
              // this.isclicked3 = true;
            }else if (id==3) {
              this.isclicked3 = true;
              // this.isclicked1 = true;
              // this.isclicked2 = true;
            }
          },
          _nextQuiz(){
            if (this.index+1 == this.totalCount){
              // setTimeout("this.$router.push({name: 'constitution.result', params: { wrongCount: this.wrongCount, totalCount: this.totalCount} })",2000);
              this.$router.push({name: 'constitution.result', params: { wrongCount: this.wrongCount, totalCount: this.totalCount} });
              return;
            }
            this.index += 1;
            this.correctness = 'null';
            this.isclicked1 = false;
            this.isclicked2 = false;
            this.isclicked3 = false;
            // setTimeout('this.setQuiz(this.quizes[this.index])', 2000);
            this.setQuiz(this.quizes[this.index]);
          },
          _setTitle(quiz){
            this.title = quiz.title;
          },
          _setChoices(quiz){
            var choicestmp = [quiz.choice_1, quiz.choice_2, quiz.choice_3];
            for(var i = choicestmp.length - 1; i > 0; i--){
              var r = Math.floor(Math.random() * (i + 1));
              var tmp = choicestmp[i];
              choicestmp[i] = choicestmp[r];
              choicestmp[r] = tmp;
            }
            this.choices = choicestmp;
          },
          _setCaption(quiz){
            this.caption = quiz.caption;
          },
          _setProvision(quiz){
            this.provision = quiz.provision.replace(quiz.blank, '(　　　)');
          },
          _setBlank(quiz){
            this.blank = quiz.blank;
          }
      },
      created(){
            console.log('created');
      },
      mounted() {
            console.log('ConstitutionQuizComponent mounted.');
            this.getQuiz();
            console.log('mounted done');
        }
    }
</script>
