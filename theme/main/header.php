<html>
  <head>

    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

      <?php if(isset($data['style']))
          foreach($data['style'] as $k => $style){ ?>
          <link rel="stylesheet" href="<?php echo BASE_URL.$style['url']; ?>">
      <?php }?>

  </head>
<body>
