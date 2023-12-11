<?php
    if(isset($_POST['enviar_form'])):
        $formatosPermitidos = array("png", "jpeg", "jpg");
        $extensao = pathinfo($_FILES['arquivo']['name'], PATHINFO_EXTENSION);

        if(in_array($extensao, $formatosPermitidos)):
            $pasta = "upload/";
            $temporario = $_FILES['arquivo']['tmp_name'];
            $novoNome = bin2hex(random_bytes(16)).".".$extensao;

            if(is_dir($pasta) && is_writable($pasta)):
                if($_FILES['arquivo']['size'] < 5000000):
                    if(move_uploaded_file($temporario, $pasta.$novoNome)):
                        $mensagem = "Upload feito com sucesso";
                    else:
                        $mensagem = "Não foi possível o upload";
                    endif;
                else:
                    $mensagem = "Arquivo muito grande";
                endif;
            else:
                $mensagem = "Pasta de upload não encontrada";
            endif;
        else:
            $mensagem = "Formato inválido";
        endif;

        echo $mensagem;
    endif;
?>
