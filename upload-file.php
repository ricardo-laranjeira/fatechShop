<?php
if (isset($_POST['enviar'])){
    $extension_permission = array("png", "jpg", "jpeg");
    $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
    if(in_array($extension, $extension_permission)){
        $pasta = "uploads/";
        $temp = $_FILES['file']['tmp_name'];
        $new_name = uniqid().".$extension";
        if (move_uploaded_file($temp, $pasta.$new_name)){
            $mensagem = "Arquivo enviado com sucesso";
        } else {
            $mensagem = "Erro ao enviar o arquivo.";
        }
    } else {
        $mensagem = "Formato inválido";
    }
}
/*
header('Content-Type: aplication/json; charset=utf-8');
$api = file_get_contents("https://brasilapi.com.br/api/cep/v1/17520130");
$json_data = json_decode($api);
$json_data->cep;
$json_data->state;
$json_data->city;
$json_data->neighborhood;
$json_data->street;
*/
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Files</title>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
        <input type="file" name="file">
        <input type="submit" name="enviar" value="Enviar">
    </form>
</body>
</html>