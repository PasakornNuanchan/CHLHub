<?php

$old_pass_word = $_POST['old_pass_word'] ? $_POST['old_pass_word'] : '';

$key = "LHC2zMKN1!?a83b7@a3Hl9#SnaKA0923";
$iterations = 9137;
$pwHash = hash_pbkdf2('sha256', $old_pass_word, $key,$iterations,32);

echo json_encode($pwHash);
?>