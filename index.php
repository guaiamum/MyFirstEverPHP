<?php
function Connect(){
    define('DB_HOSTNAME','localhost');
    define('DB_USERNAME','root');
    define('DB_PASSWORD','root');
    define('DB_DATABASE','lista');
    define('DB_CHARSET','utf8');

    $link = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD,DB_DATABASE) or die(mysqli_connect_error());

    mysqli_set_charset($link,DB_CHARSET) or die(mysqli_error($link));

    //echo "<span id='warn'>linked successfully</span><br/>";

    return $link;
}

function Insert($nome,$num){

    if($nome != null && $num != null) {
        $link = Connect();

        $query = "INSERT INTO contatos VALUES (DEFAULT, '$nome', '$num')";

        mysqli_query($link, $query) or die(msqli_error($link));

        mysqli_close($link) or die(mysqli_error($link));

        //echo "<span id='warn'>inserted successfully</span><br/>";
    }
}

function Remove($id){
    $link = Connect();

    $query = "DELETE FROM contatos WHERE id = '$id' ";

    mysqli_query($link,$query) or die(msqli_error($link));

    mysqli_close($link) or die(mysqli_error($link));

    //echo "<span id='warn'>REMOVED successfully</span><br/>";
}

function ShowAll(){
    $link = Connect();

    // Executa uma consulta
    $sql = "SELECT `id`, `nome`, `telefone` FROM contatos";

    $query = $link->query($sql);


    while ($dados = $query->fetch_array()) {
        echo 'ID: ' . $dados['id'] . ' &nbsp ';
        echo 'Nome: ' . $dados['nome'] . ' &nbsp ';
        echo 'Telefone: ' . $dados['telefone'] . ' &nbsp <br/>';
    }

    echo 'Registros encontrados: ' . $query->num_rows;

    //Thanks to Thiago Belem at http://blog.thiagobelem.net/guia-pratico-de-mysqli-no-php
}

$nome = $_GET['nome'];
$num = $_GET['num'];
$id = $_GET['id_del'];

if(isset($_GET['nsubmit']))
    Insert($nome,$num);
else if(isset($_GET['ndelete']))
    Remove($id);

?>

<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8"/>
    <title>Lista Telefonica</title>
    <link rel="stylesheet" href="style.css"/>
</head>

<body>
<div id="interface">

    <header id="cabecalho">
        <hgroup>
            <h1>Lista Telefonica</h1>
            <h2>First web-development product of CBR</h2>
        </hgroup>

        <nav id="menu">
            <ul>
                <li><a href="index.php">Lista</a></li> <br/>
                <li><a href="about.php">About</a></li>
            </ul>
        </nav>
    </header>

    <hgroup>
        <form method="get" id="info" action="index.php">
            <table>
                <h2>Cadastro</h2>
                <tr>
                    <td>Nome:</td>
                    <td><input type="text" name="nome" size="30" placeholder="Digite seu nome aqui"/>
                    </td>
                </tr>

                <tr>
                    <td>Telefone:</td>
                    <td> <input type="text" name="num" size="15" placeholder="9924..."/>
                    </td>
                </tr>
                <tr>
                    <td><input type="submit" value="Cadastrar" id="submit" name="nsubmit" class="botao"/>
                        <br/> </td>
                </tr>

                <tr><td><h2>Remoção</h2></td>
                </tr>

                <tr>
                    <td>Id do contato:</td>
                    <td><input type="number" name="id_del" width="3" placeholder="id">
                    </td>
                    <td><input type="submit" value="Deletar" id="delete" name="ndelete" class="botao"/>
                    </td>
                <tr>
                </table>
        </form>

        <section id="console">
            <?php
                ShowAll(); ?>
        </section>
    </hgroup>

    <footer id="rodape">
        <p>Cainã Brazil - Universidade Federal da Bahia <br/>
            cainabrazil@gmail.com | (71) 99247-3370 | (71) 993732844
        </p>
    </footer>
</div>
</body>

</html>
