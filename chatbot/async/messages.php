<?php


require_once '..' . DIRECTORY_SEPARATOR .'init.php';

session_start();
$prompt = $_GET['prompt'];
if($prompt == '/config')
{
    echo '<div class="card" style="width: 18rem;">
    <div class="card-body">
      <h5 class="card-title">Configurações:</h5>
      <h6 class="card-subtitle mb-2 text-muted">GPT-3</h6>
      <p class="card-text">[Configs virão aqui]</p>
    </div>
  </div>';
    die();
}

$open_ai = new OpenAi('sua-apikey-aqui');

$complete = $open_ai->completion([
    'prompt' => $prompt,
    'model' => 'text-davinci-003',
    'temperature' => 0,
    'max_tokens' => 512,
    'frequency_penalty' => 0,
    'presence_penalty' => 0.2,
    ]);


$complete_json_decoded = json_decode($complete);
//var_dump($complete_json_decoded->choices[0]->text);
$resposta = $complete_json_decoded->choices[0]->text;
$numero_aleatorio = rand('1000000', '9999999');
if($resposta)
{
    try
    {
        $config = parse_ini_file(PATH_CONFIG . 'config.ini');

        $conn = new PDO("mysql:host=" . $config['host_db'] . ":" . $config['port_db'] . ";dbname=" . $config['name_db'] . "", $config['username_db'], $config['password_db']);

        $stmt = $conn->prepare('insert into prompts(id_prompt, question, response, reaction, dt_hr_prompt, dt_hr_atualizacao, usr_id) values (?, ?, ?, ?, ?, ?, ?)');
        if($stmt->execute(array($numero_aleatorio, $prompt, $resposta, null, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), $_SESSION['user_id'])))
        {
            //file_put_contents(strval($numero_aleatorio) . '.txt', $complete);
            echo '<pre><code style="white-space: pre-line" contentEditable="false">' . $resposta . '</code></pre>';
            echo '<hr>';
            if(str_contains($prompt, 'java') or str_contains($prompt, 'Java') or str_contains($prompt, 'JAVA'))
            {
                echo '<div style="border-radius:10px; background-color:#dddddd; padding:10px;">';
                echo "<p style=\"color:black;\">Não foi o suficiente? Confira o que encontramos no CROKAGE</p><br>";
                //echo "<form action=\"/crokage.php\" target=\"crokage-frame".$numero_aleatorio."\"><input type=\"text\" name=\"query\" id=\"query\" value=\"" . $prompt ."\"/><input type=\"submit\" id=\"pesquisar".$numero_aleatorio."\" value=\"Pesquisar\"></form>";
                echo "<iframe name=\"crokage-frame".$numero_aleatorio."\" src=\"crokage.php?query=" . urlencode($prompt) . "\" width=\"100%\" height=\"480px\"></iframe>";
                //echo '<a class="btn btn-primary"  target="_crokage">Ver no CROKAGE</a> ';
                echo "<script>let botao = document.getElementById('pesquisar".$numero_aleatorio."')</script>";
                echo "<script>botao.click();</script>";
                echo '</div>';
                echo '<hr>';
            }
            echo '
            
            <div id="' . $numero_aleatorio . '" style="border-radius:10px; background-color:grey; padding:10px;">
                <center>
                    <img class="reaction" src="/images/1F44D.svg" width="64" onclick="avaliar(' . $numero_aleatorio . ',\'thumbs_up\')">
                    <img class="reaction" src="/images/1F44E.svg" width="64" onclick="avaliar(' . $numero_aleatorio . ',\'thumbs_down\')">
                    <img class="reaction" src="/images/1F604.svg" width="64" onclick="avaliar(' . $numero_aleatorio . ',\'laugh\')">
                    <img class="reaction" src="/images/1F386.svg" width="64" onclick="avaliar(' . $numero_aleatorio . ',\'hooray\')">
                    <img class="reaction" src="/images/1F612.svg" width="64" onclick="avaliar(' . $numero_aleatorio . ',\'confused\')">
                    <img class="reaction" src="/images/2764.svg" width="64" onclick="avaliar(' . $numero_aleatorio . ',\'heart\')">
                    <img class="reaction" src="/images/1F680.svg" width="64" onclick="avaliar(' . $numero_aleatorio . ',\'rocket\')">
                    <img class="reaction" src="/images/1F440.svg" width="64" onclick="avaliar(' . $numero_aleatorio . ',\'eyes\')">
                </center>
            </div>';
            
        }
        
    }
    catch(Exception $e)
    {
        echo "<h1>Algo não deu certo, contate os administradores do sistema.</h1>";
    }
    
}
