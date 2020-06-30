// global変数の管理

export default {
  state: {
    Provision: {
      data: false,
      required: false
    },
    Provision_apart: {
      data: [],
      required: false
    },
    Chapter: {
      data: false,
      required: false
    },
    temp_user_custom_quiz: {
      data: false,
      required: false
    },
    user_id: {
      data: false,
      required: false
    },
    user_custom_quiz: {
      data: false,
      required: false
    },
    user_correctness: {
      data: false,
      required: false
    },
    csrfToken: {
      data: false,
      required: false
    },
    returnDataAtLogin: {
      data: false,
    }
  },
  initUserState() {
    this.state.user_id.data = false;
    this.state.user_custom_quiz.data = false;
    this.state.user_correctness.data = false;
    localStorage.user_id = false;
  },
  setCSRFToken() {
    let csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    this.state.csrfToken.data = csrfToken;
  },
  setUserID(user_id) {
    this.state.user_id.data = user_id;
    localStorage.user_id = user_id;
  },
  checkLogin() {
    let self = this;
    if (localStorage.user_id === undefined || localStorage.user_id == "false") {
      return;
    } else {
      self.state.user_id.data = localStorage.user_id;
    }
  },
  axiosgetProvision() {
    let self = this;
    if (localStorage.Provision === undefined) {
      axios.get('/api/provision')
        .then(function(res) {
          let Provision = res.data;
          let Provision_apart = [];
          for (let i = 1; i < 12; i++) {
            Provision[i].forEach(function(p) {
              Provision_apart.push(p);
            });
          }
          self.state.Provision.data = Provision;
          self.state.Provision_apart.data = Provision_apart;
          localStorage.Provision = JSON.stringify(Provision);
          localStorage.Provision_apart = JSON.stringify(Provision_apart);
        })
    } else {
      self.state.Provision.data = JSON.parse(localStorage.Provision);
      self.state.Provision_apart.data = JSON.parse(localStorage.Provision_apart);
    }
  },
  axiosgetChapter() {
    let self = this;
    if (localStorage.Chapter === undefined) {
      let Chapter = [];
      axios.get('/api/chapter')
        .then(function(res) {
          Chapter = res.data;
          self.state.Chapter.data = Chapter;
          localStorage.Chapter = JSON.stringify(Chapter);
        });
    } else {
      self.state.Chapter.data = JSON.parse(localStorage.Chapter);
    }
  },
  axiospostLogin(user_id, password) {
    //login認証

  },
  axiospostRegister() {
    //ユーザー登録
  },
  axiospostLogout() {
    //ログアウト
  },
  axiosgetUserCustomQuiz(user_id) {
    if (!user_id) {
      return;
    }
    //カスタムクイズを取得する
    let self = this;
    axios.get('/api/user_custom_quiz/' + user_id)
      .then(function(res) {
        self.state.user_custom_quiz.data = res.data;
        console.log("axiosgetUserCustomQuiz success!", res);
      }).catch(function(error) {
        console.log("axiosgetUserCustomQuiz error!", error);
      });
  },
  axiospostUserCustomQuiz() {
    //新しくカスタムクイズをDBに保存する
  },
  axiosdeleteUserCustomQuiz(custom_quiz_id) {
    //カスタムクイズを削除する
  },
  axiosputUserCustomQuiz(custom_quiz_id, custom_quiz) {
    //既存のカスタムクイズの変更
  },
  axiosgetUserCorrectness(user_id) {
    let self = this;
    if (user_id) {
      axios.get('/api/user_correctness/' + user_id)
        .then(function(res) {
          self.state.user_correctness.data = res.data;
        }).catch(function(error) {
          console.log(error);
        });
    } else {
      return;
    }
  },
  axiosputUserCorrectness(user_id, wrong_provision, correct_provision) {
    //ユーザの正誤数DBを更新する
    let self = this;
    if (user_id) {
      let params = {
        user_id: user_id,
        wrong_provision: wrong_provision,
        correct_provision: correct_provision,
      }
      axios.put('/api/user_correctness', params)
        .then(function(res) {
          console.log(res);
        }).catch(function(error) {
          console.log(error);
        })
    } else {
      return;
    }
  },


}
