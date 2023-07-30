<!DOCTYPE html>
<html lang="en">
<head>
  <title>Array Format</title>
</head>
<body>
    <?php
        // api access:https://rapidapi.com/Glavier/api/twitter135/

        $URL="https://twitter135.p.rapidapi.com/v1.1/SearchTweets/?q=programming&count=200";
        $curl_array = curl_init();
        curl_setopt_array($curl_array, [
            CURLOPT_URL => $URL,
            CURLOPT_RETURNTRANSFER => true,
            // CURLOPT_ENCODING => "",
            // CURLOPT_MAXREDIRS => 10,
            // CURLOPT_TIMEOUT => 30,
            // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "X-RapidAPI-Host: twitter135.p.rapidapi.com",
                "X-RapidAPI-Key: a08f68dcc5msh61d2962acced696p19bbadjsnb5e94e257a51"
            ],
        ]);
        $response = curl_exec($curl_array);
        if (curl_errno($curl_array)){
            ?>
            <h1 style="color:red">
                <?php echo 'cURL error: ' . curl_error($curl_array)?>
            </h1>
            <?php
        } 
        curl_close($curl_array); // curl close session
        // Processing the response
        $tweets_array=[];
        if ($response) {
            $data = json_decode($response, true); // decode JSON response
            if ($data) {
                foreach($data as $key=>$value){
                    if(is_array($value) AND $key=="statuses"){
                        foreach($value as $key_i=>$value_i){
                            if(is_array($value_i)){
                                foreach($value_i as $key_ii=>$value_ii){
                                    if(!is_array($value_ii)){
                                        if($key_ii=='full_text' || $key_ii=='id'){
                                            echo "<p style='font-size:20px'>[".$key_ii."]=><a href='https://twitter.com/ayoni02/status/".$value_i['id']."' target='blank'/>".$value_ii."</a></p>";
                                            $tweets_array[]=
                                            [
                                                'id'=>$value_i['id'],
                                                'tweet'=>$value_i['full_text'],
                                            ];
                                        }
                                    }
                                }
                                echo "<br/>";
                            }
                        }
                    }
                }
            } else {
                //if no data;
                echo '<h1 style="color:red">No Data!!!...</h1>'; 
            }
        } else {
            //if no response from an API;
            echo '<h1 style="color:red">No response from the API</h1>'; 
        }
        echo "<h1 style='text-align: center; color:#004078'>******PHP Pretty Array Format******</h1>";
        echo "<pre>";
        print_r($tweets_array);
    ?>
</body>
</html>