<?php
if (isset($_POST["newPropertyName"])) {
  $newLabel = '';
  for ($i = 0; $i < strlen($_POST["newPropertyName"]); $i++) {
    $c = ord($_POST["newPropertyName"][$i]);
    if ($c >= ord('A') && $c <= ord('Z')) {
      $newLabel = $newLabel . chr($c - ord('A') + ord('a'));
    } elseif ($c >= ord('a') && $c <= ord('z')) {
      $newLabel = $newLabel . chr($c);
    }
  }
  $stmt_checkLabel = $pdo->prepare("SELECT * FROM listoflsbales " .
                                   "WHERE labelname LIKE " . $newLabel);
  $stmt_checkLabel->execute();
  $exists = $stmt_checkLabel->fetch();
  if (!$exists) {
    $stmt_addLabel = $pdo->prepare("ALTER TABLE memes ADD COLUMN " . $newLabel . " " .
                                   "BIT(1) DEFAULT b'0';");
    $stmt_addLabel->execute();
    $stmt_expandLabelTable = $pdo->prepare("INSERT INTO listoflabels (labelname) " .
                                           "VALUES (\"" . $newLabel . "\");");
    $stmt_expandLabelTable->execute();
  } else {
    $labelFailedAdd = $_POST["newPropertyName"];
  }
}
?>
