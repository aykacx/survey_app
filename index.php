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

    <!-- CDNJS Fontawesome -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- CDNJS Fontawesome -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Bootstrap CSS -->

    <title>Survey Form</title>
</head>

<body>
    <?php include_once 'header.php'; ?>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4 mt-4">
            <center>
                <h3>Questions</h3>
            </center>
            <form method="POST">
                <!--start of php used for quesitons -->
                <?php if ($questionCount > 0) {
                    $q_alignment = 0;
                    foreach ($quesitons as $question) {
                        $q_alignment++;
                        ?>
                        <div class="card mt-2">
                            <div class="card-header">
                                <?php echo $q_alignment . "-" . $question['question']; ?>
                            </div>
                            <div class="card-body">
                                <blockquote class="blockquote mb-0">
                                    <!-- Hidden input gets question id value -->
                                    <input type="hidden" value="<?php echo $question['id'] ?>" name="questionId[]">

                                    <!-- Perfect button -->
                                    <input type="radio" value="perfect" name="<?php echo 'question[]' . $q_alignment ?>">
                                    <i class="fa-solid fa-face-grin-wide" style="color: green;"></i>

                                    <!-- Not bad button -->
                                    <input type="radio" value="not_bad" name="<?php echo 'question[]' . $q_alignment ?>">
                                    <i class="fa-solid fa-face-meh" style="color: yellow;"></i>

                                    <!-- Bad button -->
                                    <input type="radio" value="bad" name="<?php echo 'question[]' . $q_alignment ?>">
                                    <i class="fa-solid fa-face-frown" style="color: red;"></i>
                                </blockquote>
                            </div>
                        </div>
                        <?php
                    } ?>

                    <!-- Submit button for send the answers -->
                    <div class="d-grid gap-2 mt-2">
                        <input class="btn btn-success btn-block" value="Send" name="send" type="submit">
                    </div>
                <?php
                } else {
                    echo "<div class='alert alert-danger'>There is no question to show.</div>";
                }
                ?><!--end of php used for quesitons -->
            </form>
            <?php
            if (isset($_POST['send'])) {
                if (isset($_POST['question'])) {
                    $answers = $_POST['question'];
                    $q_id = $_POST['questionId'];
                    $answersCombine = array_combine($q_id, $answers);
                    $voterIp = $_SERVER['REMOTE_ADDR'];
                    $time = time();

                    $wait_time = 2;
                    $time_diff = $time - $wait_time;

                    $getVoters = $conn->prepare('SELECT * FROM sf_voters WHERE ip_address = ? AND vote_date >= ?');
                    $getVoters->execute([$voterIp, $time_diff]);

                    $voterCount = $getVoters->rowCount();

                    if ($voterCount > 0) {
                        echo "<div class='alert alert-danger mt-2'>You are not currently eligible to vote. Please try again after 24 hours of your last vote.</div>";
                    } else {
                        foreach ($answersCombine as $qId => $ans) {
                            $insertAnswers = $conn->prepare('INSERT INTO sf_answers (question_id, answer) VALUES (?,?)');
                            $insertAnswers->execute([
                                $qId,
                                $ans
                            ]);
                            if ($insertAnswers) {
                                $insertVoter = $conn->prepare('INSERT INTO sf_voters (ip_address,vote_date) VALUES (?,?)');
                                $insertVoter->execute([
                                    $voterIp,
                                    $time
                                ]);
                            }
                        } //end of foreach
                        echo "<div class='alert alert-success mt-2'>Your vote has been succesfully submitted!</div>";
                    }

                } else {
                    echo "<div class='alert alert-danger mt-2'>Please answer all of the questions!</div>";

                }
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