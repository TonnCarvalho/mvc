<?php 

echo "VIEW pagina Dashboard <br>";
echo $this->data . " " . $_SESSION['user_nome'];
echo '<br>';
echo "<a href='" . URLADM . "/login'>sair</a>";