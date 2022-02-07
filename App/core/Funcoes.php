<?php

namespace App\core;

class Funcoes
{

    public static function gerarCaptcha()
    {
      // gerar a sequencia aleatória
      $random_num = rtrim(strtr(base64_encode(random_bytes(32)), '+/', '-_'), '=');
      $captcha_code  = substr($random_num, 0, 5); // usa apenas os 5 primeiros caracteres
      return $captcha_code;
    }


    public static function gerarImgCaptcha($captcha_code)
    {
        $nome_imagem  = random_int(10000, 9999999); // usa apenas os 5 primeiros caracteres

        // cria uma imagem a partir de template_cap.jpg
        $imagem = imagecreatefromjpeg('C:/wamp64/www/review/App/writable/template_cap.jpg');
        $cor_texto = imagecolorallocate($imagem, 0, 0, 0); // cria cor do captcha_code

        // inserir o captcha_code na imagem usando cor do texto e fontes TrueType
        $font = 'C:/wamp64/www/review/App/writable/arial.ttf';
        imagettftext($imagem, 20, 0, 10, 25, $cor_texto, $font, $captcha_code);

        // salva a imagem na view
        $imagem_captcha = "C:/wamp64/www/review/App/writable/captcha_" . $nome_imagem . ".jpg";
        imageJpeg($imagem, $imagem_captcha, 100);

        // le a imagem coo uma string e converte o encoding para base64
        $imageData = base64_encode(file_get_contents($imagem_captcha));

        // Formata  a imagem em base64 SRC:  data:{mime};base64,{data};
        $src = 'data:jpeg;base64,' . $imageData;

        // apaga a imagem da pasta
        unlink($imagem_captcha);

        // retorna a tag img com a string base64 (imagem codificada)
        return '<img src="' . $src . '">';
    }

    public static function gerarTokenCSRF()
    {
        $string_aleatoria = bin2hex(openssl_random_pseudo_bytes(16));
        return hash_hmac('sha256', $string_aleatoria, 'iyHS4##SiPcV9tIZ');
    }
    
    public static function validarTokenCSRF($token_crsf, $token_session)
    {
        $token_crsf_original = $token_session;
        if (hash_equals($token_crsf_original, $token_crsf)) {
            return true;
        }
        return false;
    }

    public static function redirect($rota = "")
    {
       header("Location:http://review.com/". $rota);
    }

    public static function usuarioLogado()
    {
        return isset($_SESSION['id']) && isset($_SESSION['nomeUsuario']);
    }

    public static function debug_to_console($data) {
        $output = $data;
        if (is_array($output))
            $output = implode(',', $output);
    
        echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
    }
}
