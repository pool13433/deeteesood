<?php $baseUrl = Yii::app()->baseUrl;?>
<header>
    <div class="wrap-header zerogrid">
        <div class="row">
            <div id="cssmenu">
                <ul>
                    <li><a href="<?=  Yii::app()->createUrl('site/index')?>"><h3>หน้าหลัก</h3></a></li>
                    <li class='active'><a href="<?=Yii::app()->createUrl('site/product')?>"><h3>สินค้าและบริการ</h3></a></li>
<!--                    <li><a href="<?=Yii::app()->createUrl('site/about')?>"><h3>เกี่ยวกับเรา</h3></a></li>-->
                    <li><a href="<?=Yii::app()->createUrl('site/social')?>"><h3>กิจกรรม</h3></a></li>
                    <li><a href="<?=Yii::app()->createUrl('site/contact')?>"><h3>ติดต่อเรา</h3></a></li>
                    <?php if(!empty(Yii::app()->session['member'])){?>
                    <li><a href="<?=Yii::app()->createUrl('admin/dashboard')?>"><h3>จัดการระบบ</h3></a></li>
                    <?php }?>
                </ul>
<!--                <p style="text-align:right;padding-right:15px;">
                    <a href="https://www.facebook.com/deeteesoodcarandservice/" target="_blank"><i class="facebook icon large blue"></i></a>
                    <i class="twitter square icon large blue"></i>
                </p>-->
            </div>
            <a href='<?=  Yii::app()->createUrl('site/index')?>' class="logo">
                <img src="<?= $baseUrl ?>/images/app/logo_deeteesood_head.png" style="max-height:150px;"/>
            </a>
        </div>
    </div>
</header>