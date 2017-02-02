<?php $baseUrl = Yii::app()->baseUrl; ?>
<section class="ui container">
    <h2 class="ui header top attached left aligned" style="font-size: medium;background-color: #F3542D;">
       <?= $social['soc_title'] ?>
    </h2>
    <p><?= $social['soc_desc'] ?></p>
    <div class="gamma-container gamma-loading" id="gamma-container">

        <ul class="gamma-gallery">
            <?php foreach ($pictures as $index => $pic) { ?>            
                <li>
                    <div data-alt="<?=$pic['alb_picture']?>" 
                         data-description="<h3>รูปที่ <?=$index+1?></h3>" data-max-width="1800" 
                         data-max-height="1350">
<!--                        <div data-src="images/xxxlarge/3.jpg" data-min-width="1300"></div>
                        <div data-src="images/xxlarge/3.jpg" data-min-width="1000"></div>
                        <div data-src="images/xlarge/3.jpg" data-min-width="700"></div>
                        <div data-src="images/large/3.jpg" data-min-width="300"></div>
                        <div data-src="images/medium/3.jpg" data-min-width="200"></div>
                        <div data-src="images/small/3.jpg" data-min-width="140"></div>-->
                        <div data-src="<?= $baseUrl ?>/uploads/socials/<?= $pic['alb_picture'] ?>"></div>
                        <noscript>
<!--                            <img src="images/xsmall/3.jpg" alt="img03"/>-->
                            <img src="<?= $baseUrl ?>/uploads/socials/<?= $pic['alb_picture'] ?>">              
                        </noscript>
                    </div>
                </li>
            <?php } ?>                
        </ul>
    </div>

</section>