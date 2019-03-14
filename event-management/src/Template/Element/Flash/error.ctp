<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="message alert alert-danger" onclick="this.classList.add('hidden');"><?= $message ?></div>
