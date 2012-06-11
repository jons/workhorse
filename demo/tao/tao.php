<?php
/** example application implementation: tao
 */
require_once 'tao.class.php';
$app = new Tao($_POST, $_SERVER);
$app->run();
?>
