<?php
if (isset($this->data['form'])) {
    $valorForm = $this->data['form'];
}

?>
<h1>Área restrita</h1>

<?php 
if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
?>

<form action="" method="post">
    <?php
    /**
     * $user é vazio.
     * SE existir valor em $valorForm['user'].
     * $user recebe o valor de $valorForm['user'].
     */
    $user = "";
    if (isset($valorForm['user'])) {
        $user =  $valorForm['user'];
    }
    /**
     * $senha é vazio.
     * SE existir valor em $valorForm['senha'].
     * $senha recebe o valor de $valorForm['senha'].
     */
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

<p>login: cleiton</p>
<p>senha: 123456a</p>