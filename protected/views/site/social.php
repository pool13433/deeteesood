<?php $baseUrl = Yii::app()->baseUrl; ?>
<section class="ui container">
    <h2 class="ui header top attached left aligned" style="font-size: medium;background-color: #F3542D;">
        กิจกรรมเพื่อสังคม
    </h2>
    <div class="ui link cards three special stackable">
        <?php foreach ($socials as $index => $social) { ?>
            <div class="card">
                <div class="blurring dimmable image">
                    <div class="ui dimmer">
                        <div class="content">
                            <div class="center">
                                <a class="ui inverted button red"
                                   href="<?= Yii::app()->createUrl('/site/social', array('id' => $social['soc_id'])) ?>/{{prod.prod_id}}">ดูรูปทั้งหมดของกิจกรรมนี้</a>
                            </div>
                        </div>
                    </div>
                    <img src="<?= $baseUrl . '/uploads/socials/' . $social['first_image'] ?>">
                </div>
                <div class="content">
                    <h2><?=$social['soc_title']?></h2>
                    <div class="meta date">
                        <a>เมื่อ: <?=$social['soc_eventdate']?></a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</section>