<html>
    <head>
        <title>Mais do CROKAGE</title>
        <meta charset="utf-8"/>
        <style>
            body
            {
                background-color: #dddddd;
            }
            section{
                width: 60vw;
                border-radius: 10px;
                padding: 10px;
                word-wrap: break-word!important;
                margin: 10px auto 0px auto;
            }
            .code
            {
                border-radius: 10px;
                overflow-x: scroll;
                width: 100%;
                background-color: white;
                padding: 10px;
                margin-bottom: 20px;
            }
            header
            {
                margin: 10px auto 0px auto;
                width: 60vw;
            }
            footer
            {
                margin: 10px auto 0px auto;
                width: 60vw;
                font-position: center;
            }
        </style>
    </head>
    <body>
        <header>
            <h1>Outras possíveis soluções:</h1>
        </header>
        <section>
        <?php
        //require_once 'init.php';
        require_once('lib/Crokage.php');
        //var_dump(PATH_ASYNC);
        try
        {
            $id = $_GET["query"];
            /*var_dump($_REQUEST);
            var_dump($id);*/
            if(isset($_GET["query"]))
            {
                $crokage = new CROKAGE($_GET["query"]);
                
                $respostas = $crokage->getResponses();
            
                foreach($respostas['posts'] as $resposta)
                {
                    echo '<div class="code">' .  $resposta['body'] . '</div>';
                    //echo '<hr>';
                }
                //var_dump('parte 3');
                
            }
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
        ?>
        </section>
        <footer>
            <p><i>Gentilmente fornecido por:</i> <a href="http://isel.ufu.br:9000/">CROKAGE</a></p>
        </footer>
    </body>
</html>