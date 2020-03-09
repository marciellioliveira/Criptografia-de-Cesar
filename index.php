<!DOCTYPE html>
<html>
<head>
  <title></title>

</head>


 <body>

  <?php

     //Pegar o conteúdo do Json 
      $strJsonFileContents = file_get_contents("https://api.codenation.dev/v1/challenge/dev-ps/generate-data?token=ecf47bf31e28fdca8402fc73d50046cd87e9ab5d");
      
      //Converter em um array
      $conteudo = json_decode($strJsonFileContents, true);
      //$conteudoJson = implode(' ', $conteudo);

      //Criar um arquivo Json com answer.json como nome
      $nomeDoArquivo = 'answer.json';

      if (!file_exists($nomeDoArquivo)) {

        $handle = fopen($nomeDoArquivo, 'w');
        fwrite($handle, json_encode($conteudo));
        echo "Sucesso!";

      } 

        //Ler o conteúdo do arquivo Json
        $getDados = file_get_contents("./answer.json");

        //Transformei string em Array 
        $conteudoNovo = json_decode($getDados, true);
       
        
        echo "<pre>";
        print_r($conteudoNovo);
        echo "</pre><br><br>";
       
        $cifrado = $conteudoNovo['cifrado'];
        $resumo = $conteudoNovo['resumo_criptografico'];
        $chave = $conteudoNovo['numero_casas'];
     
        $alfabeto = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z");

        $resumoNovo = array();

        $def = $cifrado;

         for ($i=0; $i < strlen($cifrado); $i++) {
            
            for ($j=0; $j < count($alfabeto) ; $j++) { 
                if ($cifrado[$i] == $alfabeto[$j]) {
                   
                    $valorX = $j;
                    $posChave = $valorX - $chave;
                   

                    if($posChave < 0){
                        $posChave += 26;
                    }           

                    $def[$i] =  $alfabeto[$posChave]; 
                    
                }
            }
         }

          $pegarArquivo = file_get_contents("./answer.json");
          $arquivo_array = json_decode($pegarArquivo, true);      
          
          echo "<pre>";
          print_r($arquivo_array);
          echo "</pre><br><br>";

         // $dec = $arquivo_array['decifrado'];

          $novoArquivo = array();
          $nome = "answer.json";

         // var_dump($def);
          $novoDecifrado;

         for ($k=0; $k < count($arquivo_array) ; $k++) { 
           $textoDecifrado = ($arquivo_array['decifrado']  = $def);
           
           $res = sha1($textoDecifrado);

           $resumoCrip = ($arquivo_array['resumo_criptografico'] = $res);

           if (file_exists($nome)) {

            $handle = fopen($nome, 'w');
            fwrite($handle, json_encode($arquivo_array));
            //echo "Sucesso!";

          } 

          //echo $enviarArray = implode(" ", $arquivo_array);

          echo $nome;

          $curl_file = curl_file_create($nome, 'application/json', 'answer');
          $curl_data = array('answer' => $curl_file);

          $url = 'https://api.codenation.dev/v1/challenge/dev-ps/submit-solution?token=ecf47bf31e28fdca8402fc73d50046cd87e9ab5d';
          
          $curl = curl_init();
          curl_setopt($curl, CURLOPT_URL, $url);
          curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: multipart/form-data'));
          curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
          curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($curl, CURLOPT_POST, true);
          curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_data);

          $m = curl_exec($curl);
          curl_close($curl);

         

         /* echo '      
  

          <form method="POST" id="form_id" action="https://api.codenation.dev/v1/challenge/dev-ps/submit-solution?token=ecf47bf31e28fdca8402fc73d50046cd87e9ab5d"  enctype="multipart/form-data">
              <input type="file" value="'.$testenovo.'" name="answer"/>
              <input type="button" onload="submittheform()" value="submit the form"/>
          </form>

         ';*/
        // var_dump($pegarArquivo);
       
          //var_dump($arquivo_array);
           exit;
         }


         
         

          /*

           if (!file_exists($nome)) {

            $handle = fopen($nome, 'w');
            fwrite($handle, json_encode($arquivo_array));
            echo "Sucesso!";

          } */

          /*echo "<pre>";
          print_r($def);
          echo "<pre>";*/

          //var_dump($dec);
          //echo "<pre>";
          //var_dump($arquivo_array);



          

         
          

          









        /* echo "<pre>";
         print_r($cifrado);
         echo "</pre>";
         
         echo "<pre>";
         print_r($def);
         echo "</pre>";
         exit;*/

?>

</body>
</html>