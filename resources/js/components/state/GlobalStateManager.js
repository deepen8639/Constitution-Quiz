// global変数の管理

export default {
  state: {
    Provision: {
      data: false
    },
    Chapter: {
      data: false
    },
    temp_user_custom_quiz: {
      data: false
    },
    user_id: {
      data: false
    },
    user_custom_quiz: {
      data: false
    },
    user_correctness_data: {
      data: false
    },
  },
  axiosgetProvision() {
  axios.get('/api/provision')
      .then((res) => {
        this.state.Provision.data = res.data;
      });
  },
  axiosgetChapter() {
    axios.get('/api/chapter')
      .then((res) => {
        this.state.Chapter.data = res.data;
      });
  },
  axiospostLogin() {
    //login認証
  },
  axiospostRegister() {
    //ユーザー登録
  },
  axiospostLogout() {
    //ログアウト
  },
  axiospostUserCustomQuiz() {
    //新しくカスタムクイズをDBに保存する
  },
  axiosdeleteUserCustomQuiz() {
    //カスタムクイズを削除する
  },
  axiosputUserCorrectness() {
    //ユーザの正誤数DBを更新する
  },
  axiosputUserCustomQuiz() {
    //既存のカスタムクイズの変更
  },


}
