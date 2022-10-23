<?php

// HTML特殊文字をエスケープする関数
function escape($str)
{
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

//前後にある半角全角スペースを削除する関数
function spaceTrim($str)
{
  // 行頭
  $str = preg_replace('/^[ 　]+/u', '', $str);
  // 末尾
  $str = preg_replace('/[ 　]+$/u', '', $str);
  return $str;
}

// create
function create_table($table_name)
{
  global $wpdb;
  //テーブル名がなかったら
  if ($wpdb->get_var("show tables like '" . $wpdb->prefix . $table_name . "'") != $wpdb->prefix . $table_name) {

    //dbDelta 関数の読み込み
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    //テーブル生成
    $sql = "CREATE TABLE " . $wpdb->prefix . $table_name . "(
        id int not null auto_increment,
        email text not null,
        prod text not null,
        primary key(id)
        );";
    add_option($table_name . "_version", '1.0');
    dbDelta($sql);
  }
}

// insert
function insert_table($email, $prod)
{
  global $wpdb;
  $tablename = "restock";
  $sql = $wpdb->prepare("INSERT INTO " . $wpdb->prefix . $tablename . " (email, prod) VALUES (%s , %s)", $email, $prod);
  $wpdb->query($sql);
}

function send_mail($email)
{

  mb_language('japanese');
  mb_internal_encoding('UTF-8');

  $from = $email;
  $mail = $email;
  $comment = <<< EOT
  <p>お問い合わせありがとうぞざいます。</p>
  EOT;

  $subject = 'お問い合わせがあったよ！';
  $body = $comment  . "\n" . $mail;
  mb_send_mail($email, $subject, $body, 'From: ' . $from);
}



function ajax_sample()
{

  if (isset($_POST['recaptchaResponse']) && !empty($_POST['recaptchaResponse'])) {
    $secret = '6LezUp8iAAAAACzDN5JVe4EPCW4hsSIGAki3v7lc';
    //get verify response data
    $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['recaptchaResponse']);
    $responseData = json_decode($verifyResponse);

    if ($responseData->success) {
      if ($responseData->score < 0.8) {
        $message["recaptcha_msg"] = "認証スコアが低い";
        // exit();
      }
    } else {
      $message["recaptcha_msg"] = "認証失敗";
      // exit();
    }
  } else {
    $message["recaptcha_msg"] = "POST値が正常に投げられてこなかった";
    // exit();
  }

  $message["recaptcha_data"] = $responseData;


  /** チェックしたいメールアドレス */
  $check_email = $_POST['mail'];

  //名前入力判定
  if ($check_email == '') {
    $message["error"] = "入力がありません";
    $message["error_flag"] = true;
  } else {

    //前後にある半角全角スペースを削除
    $check_email = spaceTrim($check_email);
    // HTML特殊文字をエスケープ
    $check_email = escape($check_email);

    if (filter_var($check_email,  FILTER_VALIDATE_EMAIL)) {
      $message["email"] = $check_email;
      $prod = "test";
      $message["error_flag"] = false;
      // TODO：ここでDB登録処理
      insert_table($message["email"], $prod);

      // TODO：ここで自動メール送信処理

      $to = $message["email"];
      $subject = "TEST MAIL";
      $body = "Hello!\r\nThis is TEST MAIL.";
      $headers = "From: from@samurai.jp";

      mail($to, $subject, $body, $headers);
    } else {
      $message["error"] = "'$check_email'は不正な形式のメールアドレス";
      $message["error_flag"] = true;
    }
  }

  header("Content-type: application/json; charset=UTF8");
  echo json_encode($message);

  // ここまで抜けてきたとき、正常処理を行う

  wp_die();
}

add_action('wp_ajax_my_ajax', 'ajax_sample');
add_action('wp_ajax_nopriv_my_ajax', 'ajax_sample');



function generate_js_params()
{
?>
  <script>
    let ajaxUrl = '<?php echo esc_html(admin_url('admin-ajax.php')); ?>';
  </script>
<?php
}
add_action('wp_head', 'generate_js_params');
