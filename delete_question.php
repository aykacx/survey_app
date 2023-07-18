<?php
include_once 'db.php';
if (!isset($_GET['question_id'])) {
    header('location:managment_panel.php');
}

$incoming_id = filter($_GET['question_id']);

$deleteQuestion = $conn->prepare('DELETE FROM sf_questions WHERE id=?');
$deleteQuestion->execute([$incoming_id]);
if ($deleteQuestion) {
    $deleteAnswer = $conn->prepare('DELETE FROM sf_answers WHERE question_id=?');
    $deleteAnswer->execute([$incoming_id]);
    if ($deleteAnswer) {
        header('location:managment_panel.php');
    } else {
        echo "<div class='alert alert-danger mt-2'>Answer couldn't be deleted!</div>";
    }
} else {
    echo "<div class='alert alert-danger mt-2'>Question couldn't be deleted!</div>";
}
$conn = " ";
?>'