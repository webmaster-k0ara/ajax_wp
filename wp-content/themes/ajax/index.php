<?php
//クリックジャッキング対策
// header('X-FRAME-OPTIONS: SAMEORIGIN');
get_header();
 ?>



<div class="container">



  <!-- モーダルを開くボタン・リンク -->
  <div class="row mb-5">
    <div class="col-2">
      <button type="button" class="btn btn-primary mb-12" data-toggle="modal" data-target="#testModal">ボタンで開く</button>
    </div>
  </div>


  <!-- ボタン・リンククリック後に表示される画面の内容 -->
  <div class="modal fade" id="testModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">お問合せ</h4>
        </div>
        <div class="modal-body">
          <form id="form" action="" method="post">
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Email address</label>
              <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
              <div id="emailHelp" class="form-text">再入荷お知らせメールの受信先メールアドレスを入力してください。</div>
              <div id="error" class="form-text text-danger"></div>
            </div>
            <button id="submit" type="submit" class="btn btn-primary">Submit</button>
            <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
            <p class="fs-6 mt-3 text-secondary">
              This site is protected by reCAPTCHA and the Google
              <a href="https://policies.google.com/privacy">Privacy Policy</a> and
              <a href="https://policies.google.com/terms">Terms of Service</a> apply.
            </p>
          </form>
          <div id="msg"></div>
          <p id="send"></p>

        </div>
        <div class="modal-footer">
          <button id="close" type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
        </div>
      </div>
    </div>
  </div>





</div>




<script>
  jQuery(function($) {
    // グローバル変数
    let tokenData;

    function sendData() {
      const email = $('#exampleInputEmail1').val();
      const name = $('#name').val();
      $.ajax({
          type: "POST",
          // url: "./register_submit.php",
          url: ajaxUrl,
          data: {
            action: 'my_ajax',
            mail: email,
            recaptchaResponse: tokenData
          },
          dataType: 'json'
        })
        .done(function(data) {
          if (data.error_flag) {
            $('#emailHelp').hide();
            $('#error').show();
            $('#error').text(data.error);
          } else {
            $('#form').hide();
            $('#msg').show();
            $('#emailHelp').show();
            $('#msg').text(data.email);
            $('#send').text(data.send_mail);
            $('#close').click(() => {
              $('#form').fadeIn();
              $('#error').hide();
              $('#msg').hide();
              $('#send').hide();
              $('#emailHelp').show();
            });
          }
          console.log(data);
        })
        .fail(function(error) {
          alert("サーバー内でエラーがあったか、サーバーから応答がありませんでした。");
          console.log(error);
        });
    }

    $('#submit').click(function(e) {
      e.preventDefault();
      // Google reCAPTCHA v3 のトークンを生成
      grecaptcha.ready(function() {
        grecaptcha.execute('6LezUp8iAAAAAAiE7rUmsSHU_Ni7mqA6eDAS3VbZ', {
          action: 'submit'
        }).then(function(token) {
          tokenData = token;
          console.log(tokenData);
          sendData();
        });
      });
    });

  });
</script>


<script src="https://www.google.com/recaptcha/api.js?render=6LezUp8iAAAAAAiE7rUmsSHU_Ni7mqA6eDAS3VbZ"></script>



<?php get_footer(); ?>
