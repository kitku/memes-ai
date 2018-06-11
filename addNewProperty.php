<?php
if (isset($_POST["newPropertyName"])) {
  $newLabel = $_POST["newPropertyName"];
  for ($i = 0; $i < strlen($newLabel); $i++) {
    if ($newLabel[$i] == '<' || $newLabel[$i] == '>') $newLabel = '';
  }
  $stmt_checkLabel = $pdo->prepare("SELECT name FROM labels WHERE name LIKE :newLabel");
  $stmt_checkLabel->execute(['newLabel'=>$newLabel]);
  $exists = $stmt_checkLabel->fetch();
  if (!$exists && $newLabel) {
    $stmt_addLabel = $pdo->prepare("INSERT INTO labels (name) VALUES (:newLabel);");
    $stmt_addLabel->execute(['newLabel'=>$newLabel]);
  } else {
    $labelFailedAdd = $_POST["newPropertyName"];
    $failCause = 'Already exists';
  }
}
?>
