<?php
include_once 'db.php';
$getQuestions = $conn->prepare('SELECT * FROM sf_questions');
$getQuestions->execute();
$questionCount = $getQuestions->rowCount();
$questions = $getQuestions->fetchAll(PDO::FETCH_ASSOC);
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Bootstrap CSS -->

    <style type="text/css">
        accordion-item:first-of-type .accordion-button {
            color: black;
        }
    </style>

    <title>Managment Panel</title>
</head>

<body>
    <?php include_once 'header.php'; ?>
    <center>
        <h3>Managment Panel</h3>
    </center>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4 mt-4">
            <?php if ($questionCount > 0) { ?>
                <table class="table table-success table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Queue</th>
                            <th scope="col">Question</th>
                            <th scope="col">Transactions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $q_alignment = 0;
                        foreach ($questions as $question) {
                            $q_alignment++;
                            ?>
                            <tr>
                                <th scope="row">
                                    <?php echo $q_alignment; ?>
                                </th>
                                <td>
                                    <?php echo $question['question']; ?>
                                </td>
                                <td>
                                    <a href="edit_question.php?question_id=<?php echo $question['id']; ?>" alt="Edit"
                                        title="Edit question"><i class="fa-solid fa-square-pen"
                                            style="color:blue; font-size:17px;"></i></a>
                                    <a href="delete_question.php?question_id=<?php echo $question['id']; ?>" alt="Delete"
                                        title="Delete question"><i class="fa-solid fa-trash" style="color: red;"></i></a>
                                </td>
                            </tr>
                        <?php } //end of the foreach
                        ?>
                    </tbody>
                </table>
            <?php } else {
                echo "<div class='alert alert-danger'>There is no question to show.</div>";
            } ?>
            <div class="d-grid gap-2 mt-2">
                <a href="add_question.php" class="btn btn-outline-success btn-block">Add question</a>
            </div>
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"
        integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS"
        crossorigin="anonymous"></script>
</body>
<?php $conn = " "; ?>

</html>