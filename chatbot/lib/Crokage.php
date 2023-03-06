<?php

class CROKAGE
{
    private $content_type = ['Content-Type:application/json'];
    private $body = ['Content-Type:application/json',
        'numberOfComposedAnswers:5', 
                        'reduceSentences:false', 
                        'queryText', 
                        'ipAddress:191.55.97.161',
                        ];
    private $url = 'http://isel.ufu.br:8080/crokage/query/getsolutions';

    public function __construct($query)
    {
        //echo '<script>console.log("Passei por aqui")</script>';
        $this->body[3] = 'queryText:' . $query;
    }

    public static function teste()
    {
        echo ('teste');
    }
    public function getResponses()
    {
        try
        {
            $curl = curl_init();

            curl_setopt_array($curl, [
            CURLOPT_PORT => "8080",
            CURLOPT_URL => "http://isel.ufu.br:8080/crokage/query/getsolutions",
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\n  \"numberOfComposedAnswers\":5,\n\"reduceSentences\":false,\n\"queryText\":\"" . $this->body[3] ."\",\n\"ipAddress\":\"191.55.97.161\"\n}",
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json"
            ],
            ]);

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
            echo "cURL Error #:" . $err;
            throw new Exception($err);
            } else {
            //echo $response;
            }
            return json_decode($response, true);
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }
}