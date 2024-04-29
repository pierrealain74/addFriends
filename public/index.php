<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/style.css">

    <title>Welcom my friends</title>
</head>

<body>
    <?php

    require_once '_connec.php';
    $pdo = new \PDO(DSN, USER, PASS);

    $query = "
SELECT user.firstname, user.lastname, user.email, user.age, user.description, user.photo FROM user";
    $statement = $pdo->query($query);
    $friends = $statement->fetchAll();

    ?>
    <header>
        <h1>La liste de mes Friends !</h1>
    </header>
    <main>

        <?php
        foreach ($friends as $friend)
        {
            echo '
                <div class="card">
                <img src="./assets/images/' . $friend["photo"] . '" class="card-img-top" alt="' . $friend["firstname"] . '">
                <div class="card-body">
                    <h5 class="card-title">' . $friend["firstname"] . '&nbsp;' . $friend["lastname"] . '</h5>
                    <h6 class="card-text">' . $friend["age"] . '&nbsp;|&nbsp;' . $friend["email"] . '</h6>
                    <p class="card-text">' . $friend["description"] . '</p>
                    <a href="#" class="btn btn-primary">OK</a>
                </div>
                </div>
                ';
        }
        ?>

    </main>

    <!--Form to add an new friend-->
    <section id="formulaire_user">
        <a class="btn btn-primary disabled placeholder col-4" aria-disabled="true">Ajouter un friend</a>
        <div class="container mt-5">
            <form action="addfriend.php" method="post" onsubmit="return validateForm()" enctype="multipart/form-data">
                <div class="row">
                    <div class="input-group mb-3">
                        <span class="input-group-text">First and last name</span>
                        <input name="firstname" type="text" aria-label="First name" class="form-control">
                        <input name="lastname" type="text" aria-label="Last name" class="form-control">
                    </div>
                    <div class="col mb-3">
                        <label class="visually-hidden" for="autoSizingInputGroup">Username</label>
                        <div class="input-group">
                            <div class="input-group-text">@</div>
                            <input type="text" class="form-control" id="autoSizingInputGroup" placeholder="Email" name="email">
                        </div>
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Description" name="description"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="datepicker" class="form-label">Birthdate</label>
                        <input type="text" class="form-control" id="datepicker" placeholder="Select date" name="age">
                    </div>
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="inputGroupFile01">Photo</label>
                        <input type="file" class="form-control" id="inputGroupFile01" name="photo">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </form>
        </div>
    </section>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Datepicker JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="assets/js/date_picker.js"></script>

    <!-- VerifyForm JavaScript -->
    <script src="assets/js/verify_form.js"></script>

</body>

</html>