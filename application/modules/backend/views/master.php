<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <base href="<?=base_url()?>">
    <title><?=isset($data['title']) ? 'Sd@__' . $data['title'] : 'Sd@__'?></title>
    <!--main bootstrap-->
    <link rel="stylesheet" href="public/css/bootstrap.css">
</head>
<body>
    <div class="container">
        <?php $this->load->view($data['subview'])?>
    </div>
</body>
</html>