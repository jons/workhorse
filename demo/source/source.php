<?php
/** example application implementation: source viewer
 */
require_once 'source.class.php';
$app = new Source($_POST, $_SERVER);
$app->run();
?>
