<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="https://fonts.googleapis.com/css?family=Dosis:300,400,500" rel="stylesheet">

    <title><?= $title? $this->e($title): 'MoneyTracking!!'  ?></title>
    <style>
        body {
            font-family: 'Dosis', sans-serif;

            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }

        main {
            flex: 1 0 auto;
        }
    </style>
</head>
<body>

 <?= $this->section('content') ?>


 <script
     src="https://code.jquery.com/jquery-3.3.1.js"
     integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
     crossorigin="anonymous">

 </script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

 <script>
     $(document).ready(function () {
         $('select').formSelect();
         $('.datepicker').datepicker({
             format: "yyyy-mm-dd"
         });
         $('.fixed-action-btn').floatingActionButton();
         $('.sidenav').sidenav();
         $('.tap-target').tapTarget();

     });
 </script>


 <?php
 if(isset($action))
 {
 ?>
 <script>
     M.toast({html:'<?php echo $action ?>'})
     </script>
     <?php
 }
 ?>
</body>
</html>