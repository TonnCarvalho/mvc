<?php
if (isset($this->data['form'])) {
    $valorForm = $this->data['form'];
}

?>
<h1>Área restrita</h1>

<form action="" method="post">
    <?php
    $user = "";
    if (isset($valorForm['user'])) {
        $user =  $valorForm['user'];
    }

    $senha = "";
    if (isset($valorForm['user'])) {
        $senha =  $valorForm['senha'];
    }
    ?>
    <label for="usuario">Usuario</label>
    <input type="text" name="user" id="user" placeholder="Digite o usuario" value="<?= $user ?>">
    <br> <br>
    <label for="senha">Senha</label>
    <input type="text" name="senha" id="senha" placeholder="Digite a senha" value="<?= $senha ?>">
    <br> <br>
    <input type="submit" value="Acessar" name="SendLogin">

</form>