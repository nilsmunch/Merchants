<?

function pushMessage($mes) {
curl_setopt_array($ch = curl_init(), array(
  CURLOPT_URL => "https://api.pushover.net/1/messages.json",
CURLOPT_RETURNTRANSFER => true,
  CURLOPT_POSTFIELDS => array(
    'token' => "aLNKoS9dda5DGgvYfkFuQYnTiuTydb",
    'user' => "IPtmjGNVf69H5Qyb9Vh6oK45wPy595",
    'message' => $mes,
   	'sound' => 'intermission',
  )));
curl_exec($ch);
curl_close($ch);

}



?>