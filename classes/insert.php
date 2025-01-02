<?php 
class insert {
  public function insertVAlue ($conn,$table,$values) {
    $columes = implode(',',array_keys($table));
    $placeholders = implode(",", array_fill(0, count($values), "?"));
    $sql = "INSERT INTO $table ($columes) values ($placeholders)";
    $stm = $conn->prepare($sql);
    return $stm->execute(array_values($values));
  }
}
?>