<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">
    <title><?= $title ?></title>
</head>
<body>
<div container>
        <div class="row row-cols-3">
            <div class="col">
                    <button class="btn btn-primary" id="regBtn">
                        Add a task
                    </button>
                    <form id="formReg" class="row gx-3 gy-2 align-items-center" method="POST" action="/create">
                    <div class="col-sm-3">
                        <label class="visually-hidden" for="specificSizeInputName">Username</label>
                        <input type="text" name="username" class="form-control" id="specificSizeInputName" placeholder="Username" required>
                    </div>
                    <div class="col-sm-3">
                        <label class="visually-hidden" for="specificSizeInputEmail">Email</label>
                        <input type="email" name="email" class="form-control" id="specificSizeInputEmail" placeholder="Email" required>
                    </div>
                    <div class="col-sm-3">
                        <label class="visually-hidden" for="specificSizeInputDescriptions">Descriptions</label>
                        <textarea name="descriptions" id="specificSizeInputEmail" cols="30" rows="10" class="form-control" placeholder="Descriptions" required></textarea>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
            <div class="col">
                <?php if (!isset($_SESSION['user_id'])) { ?>
                    <button class="btn btn-primary" id="loginBtn">
                        Login
                    </button>
                <?php } ?>
                    <form id="formLogin" class="row gx-3 gy-2 align-items-center" method="POST" action="/login">
                    <div class="col-sm-3">
                        <label class="visually-hidden" for="specificSizeInputLogin">Login</label>
                        <input type="text" name="login" class="form-control" id="specificSizeInputLogin" placeholder="Login">
                    </div>
                    <div class="col-sm-3">
                        <label for="exampleInputForLogin" class="form-label">Password</label>
                        <input type="password" name="passwordForLogin" class="form-control" id="exampleInputForLogin">
                    </div>
                    <div class="col-auto">
                        <?php if (isset($error['auth'])) {echo $error['auth'];} ?>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
            </div>
            <div class="col">
                <?php if (isset($_SESSION['user_id'])) { ?>
                <a class="btn btn-primary" href="http://localhost:8000/admin/" role="button">Administrative panel</a>
                <a class="btn btn-danger" href="/logout" role="button">Logout</a>
                <?php } ?>
            </div>
        </div>
        <div class="row row-cols-1">
        <div class="col">
            <table id="tasks">
                <thead>
                    <tr id="th1"><th colspan="4"><h2><?= $title ?></h2></th></tr>
                    <th><?php print $sortLinks->creatingSortLinks('Username', 'username_asc', 'username_desc', $page); ?></th>
                    <th><?php print $sortLinks->creatingSortLinks('Email', 'email_asc', 'email_desc', $page); ?></th>
                    <th><?php print $sortLinks->creatingSortLinks('Descriptions', 'descriptions_asc', 'descriptions_desc', $page); ?></th>
                    <th><?php print $sortLinks->creatingSortLinks('Implementation', 'implementation_asc', 'implementation_desc', $page); ?></th>
                </thead>
                <tbody>
                <?php foreach($data as $value) {?>
                    <tr>
                        <td>
                            <?= $value['username'] ?>
                        </td>
                        <td>
                            <?= $value['email'] ?>
                        </td>
                        <td>
                            <?= $value['descriptions'] ?>
                        </td>
                        <td>
                            <?= $value['implementation'] ? $value['implementation'] : 'no set' ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <?php for ($i = 1; $i <= $countPages; $i++) { ?>
                        <li class="page-item"><a class="page-link" href="http://localhost:8000/<?= $i ?>/sort=<?= $sort ?>"><?= $i ?></a></li>
                    <?php } ?>
                </ul>
            </nav>
            </div>
        </div>
    </div>
<script src="/js/form.js"></script>
</body>
</html>