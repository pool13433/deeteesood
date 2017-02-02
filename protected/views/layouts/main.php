<?php $baseUrl = Yii::app()->baseUrl; ?>
<!DOCTYPE html>
<html>
    <head>
        <!-- Basic Page Needs
   ================================================== -->
        <meta charset="utf-8">
        <title>Deeteesood</title>
        <meta name="description" content="Free Responsive Html5 Css3 Templates | zerotheme.com">
        <meta name="author" content="www.zerotheme.com">

        <!-- Mobile Specific Metas
      ================================================== -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> <!--  font-family: 'Taviraj', serif;-->
<!--        <link href="https://fonts.googleapis.com/css?family=Taviraj:300,400,600,700" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css?family=Maitree:400,600&amp;subset=thai" rel="stylesheet">   font-family: 'Maitree', serif;
        <link href="https://fonts.googleapis.com/css?family=Athiti:400,600&amp;subset=thai" rel="stylesheet"> font-family: 'Athiti', sans-serif; -->
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <script type="text/javascript"> var YII_URL_SERVICE = '<?= $baseUrl ?>';</script>
        <style>
            @font-face {
                font-family: BoonJot;
                src: url(<?= $baseUrl ?>/font-awesome/BoonJot-v1/woff/BoonJot-400.woff);
            }
            body{
                font-family: 'Athiti', sans-serif;
                font-family: BoonJot;
            }
        </style>
    </head>

    <body ng-app="deeTeeSoodApp">

        <div class="wrap-body">
            <?php $this->renderPartial('/layouts/app-header') ?>
            <?php echo $content; ?>
            <?php $this->renderPartial('/layouts/app-footer') ?>
        </div>

    </body>
</html>
