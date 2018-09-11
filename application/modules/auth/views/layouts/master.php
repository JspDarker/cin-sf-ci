<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <base href="<?=base_url()?>">
    <title>@Ci</title>
    <link rel="shortcut icon" href="public/images/sf.png">
    <link rel="stylesheet" href="public/css/bootstrap.css">
    <link rel="stylesheet" href="public/css/form-float-label.css">
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>
<header>

</header>
<div class="container-fluid">
    <?php $this->load->view($data['subview']); ?>
</div>
<footer class="align-center text-center bg-dark fixed-bottom text-white font-weight-bold p-2">
    Copy Right &copy; 2018 Hello World
</footer>
<script src="public/js/jquery-3.3.1.js"></script>
<script src="public/js/jq-valid-core.js"></script>

</body>
</html>