<?php
include_once 'db.php';
$sql = $conn->prepare('SELECT * FROM sf_questions');
$sql->execute();
$questionCount = $sql->rowCount();
$quesitons = $sql->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Survey Form</title>
</head>

<body>
    <?php include_once 'header.php'; ?>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4 mt-4">
            <center><h3>Questions</h3></center>
            <?php if ($questionCount > 0) {
                $q_alignment = 0;
                foreach($quesitons as $question){
                    $q_alignment++;
             ?>
            <div class="card mt-2">
                <div class="card-header">
                    <?php echo  $q_alignment."-".$question['question']; ?>
                </div>
                <div class="card-body">
                    <blockquote class="blockquote mb-0">
                        Answer
                    </blockquote>
                </div>
            </div>
            <?php
            }}else {
                echo "<div class='alert alert_danger'>There is no question</div>";
            }
            ?>
        </div>
        <div class="col-md-4"></div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>

</html>