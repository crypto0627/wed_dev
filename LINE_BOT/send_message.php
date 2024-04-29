<meta http-equiv="refresh" content="2;url=index.php">
<?php
date_default_timezone_set('Asia/Taipei');

// 填入 LINE Notify 存取權杖
$access_token = 'YOUR_ACCESS_TOKEN';

// 從表單中取得訊息內容
$message =  "\r\n" . '目前時間：' . date('Y-m-d H:i') . "\r\n" . $_POST['message'] ;

// 設定 API 網址
$url = 'https://notify-api.line.me/api/notify';

// 設定 API 參數
$data = array(
    'message' => $message,
    'notificationDisabled' => true,
);

// 設定 HTTP Header
$header = array(
    'Content-Type: application/x-www-form-urlencoded',
    'Authorization: Bearer ' . $access_token,
);

// 設置貼圖參數  //https://developers.line.biz/en/docs/messaging-api/sticker-list/#sticker-definitions
$stickerPackageId = 789;
$stickerId = 10856;

// 建立 cURL 連線
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, "message=$message&stickerPackageId=$stickerPackageId&stickerId=$stickerId");

// 執行 cURL 連線並取得回應資料
$result = curl_exec($ch);
curl_close($ch);

// 輸出回應資料
echo $result;
echo "訊息已發送：" . $message;

?>



