<?php 

echo "VIEW pagina Dashboard <br>";
echo  $_SESSION['user_nome'];
echo '<br>';
echo "<a href='" . URLADM . "/logout/index'>sair</a>";