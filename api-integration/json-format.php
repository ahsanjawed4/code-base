<?php
        // api access:https://rapidapi.com/Glavier/api/twitter135/
    $URL="https://twitter135.p.rapidapi.com/v1.1/SearchTweets/?q=programming&count=200";
    $curl_json = curl_init();
    curl_setopt_array($curl_json, [
        CURLOPT_URL => $URL,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "X-RapidAPI-Host: twitter135.p.rapidapi.com",
            "X-RapidAPI-Key: a08f68dcc5msh61d2962acced696p19bbadjsnb5e94e257a51"
        ],
    ]);
    $response = curl_exec($curl_json);
    if (curl_errno($curl_json)){
        ?>
    <h1 style="color:red"><?php echo 'cURL error: ' . curl_error($curl_json)?>
    </h1>
    <?php
    } 
    curl_close($curl_json);// curl close session
    // Processing the response
    if ($response) {
        $data = json_decode($response);
        $data=json_encode($data);
        if ($data) echo $data;
        else echo $response;
    } else  
        echo '<h1 style="color:red">No response from the API</h1>'; //if no response from an API;
?>