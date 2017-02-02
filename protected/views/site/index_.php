<?php $baseUrl = Yii::app()->baseUrl; ?>
<div ng-controller="HomeController as vm">
    <div class="slider">
        <!-- Slideshow -->
        <div class="callbacks_container">
            <ul class="rslides" id="slider">
                <?php foreach ($slides as $index => $slide) { ?>
                    <li>
                        <img src="<?= $baseUrl ?>/uploads/slides/<?= $slide['sli_picture'] ?>" alt="">
                        <div class="caption">
                            <h1><?= $slide['sli_title'] ?></h1>
                        </div>
                    </li>
                <?php } ?>                
            </ul>
        </div>
        <div class="clear"></div>
    </div>


    <!--////////////////////////////////////Container-->
    <section id="container">
        <div class="wrap-container">
            <section class="content-box box-1">
                <div class="zerogrid">
                    <div class="header">
                        <h2 class="heading">
                            <span>สินค้ายอดนิยม</span>
                        </h2>
                        <p>สินค้าที่มียอดผู้เข้าชม และการกดให้คะแนนมากที่สุด 6 อันดับ</p>
                    </div>
                    <div class="row">
                        <!--Start Box-->
                        <?php foreach ($products as $index => $prod) { ?>
                            <?php if ($index < 6) { ?>
                                <div class="col-1-3">
                                    <div class="wrap-col item"  style="min-height: 430px;">
                                        <div class="zoom-container">
                                            <img src="<?= $baseUrl ?>/uploads/<?= $prod['prod_picture'] ?>" />
                                        </div>
                                        <div class="item-content">
                                            <span><?= $prod['prod_name'] ?></span>
                                            <p><?= $prod['prod_desc'] ?></p>
                                            <p>ยอดเข้าดู <?= $prod['sum_view'] ?> ครั้ง, ยอดการให้คะแนน <?= $prod['sum_star'] ?> คะแนน</p>
                                            <a class="btn" href="<?= Yii::app()->createUrl('/site/detail', array('id' => $prod['prod_id'])) ?>">ดูรายละเอียด</a>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </section>
            <section class="content-box box-2">
                <!--Start Box-->
                <div class="zerogrid">
                    <div class="row">
                        <div class="header">
                            <h2 class="heading">
                                <span>กิจกรรม</span>
                            </h2>
                        </div>
                        <h3>
                            รถยนต์มือสอง รถกะบะมือสอง รถกระบะมือสอง รถมือสอง ขายรถมือสอง <br/>
                            ขายรถยนต์มือสอง ซื้อรถมือสอง ศูนย์รวมรถมือสอง สระแก้ว รถยนต์ รถกะบะทุกรุ่น <br/>
                            สภาพนางฟ้า ราคาดี รับประกันคุณภาพ ฟรีของแถม
                        </h3>
                    </div>
                </div>
                <div class="zerogrid">
                    <div class="row">
                        <?php foreach ($socials as $index => $social) { ?>
                            <div class="col-1-3">
                                <div class="wrap-col item">
                                    <div class="zoom-container">
                                        <img src="<?= $baseUrl ?>/uploads/socials/<?= $social['alb_picture'] ?>" />
                                    </div>
                                    <div class="item-content">
                                        <span><?= $social['soc_title'] ?></span>
                                        <p><?= $social['soc_desc'] ?></p>
                                        <a class="btn" href="<?= Yii::app()->createUrl('/site/social/', array('id' => $social['soc_id'])) ?>">
                                            ดูรายละเอียด
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </section>
            <section class="content-box box-3">
                <!--Start Box-->
                <div class="zerogrid">
                    <div class="row">
                        <div class="header">
                            <h2 class="heading">
                                <span>วิดีโอ กิจกรรม</span>
                            </h2>
                        </div>
                        <?php foreach ($videos as $index => $video) { ?>
                            <?php
                            $youtubes = explode('v=', $video['vid_url']);
                            if (count($youtubes) > 1) {
                                ?>
                                <div class="post">
                                    <div class="col-1-2 <?= ($index % 2 == 1) ? 'f-right' : '' ?>">
                                        <div class="ui embed" data-source="youtube" data-id="<?= $youtubes[1] ?>"></div>
                                    </div>
                                    <div class="col-1-2">
                                        <div class="wrapper">
                                            <h3><?= $video['vid_title'] ?></h3>
                                            <p><?= $video['vid_desc'] ?></p>
                                            <a class="btn" href="<?= Yii::app()->createUrl('site/video', array('id' => $video['vid_id'])) ?>">Read More</a>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </section>
            <section class="content-box box-4">
                <!--Start Box-->
                <div class="zerogrid">
                    <div class="row">
                        <div class="header">
                            <h2 class="heading">
                                <span>ดีที่สุดยินดีให้บริการ</span>
                            </h2>
                        </div>
                        <?php foreach ($categorys as $index => $cat) { ?>
                            <div class="col-1-4">
                                <div class="wrap-col item">
                                    <i class="<?=$cat['cat_icon']?> icon huge"></i>
                                    <h3><?=$cat['cat_name']?></h3>
                                    <p><?=$cat['cat_desc']?></p>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </section>
            <section class="content-box box-5">
                <!--Start Box-->
                <div class="zerogrid">
                    <div class="row">
                        <div class="col-1-3">
                            <div class="wrap-col item">
                                <h3 class="item-header">ยินดีต้อนรับสู่เว็บไซต์ของเรา</h3>
                                <span>รถยนต์มือสอง รถกะบะมือสอง รถกระบะมือสอง รถมือสอง ขายรถมือสอง ขายรถยนต์มือสอง ซื้อรถมือสอง ศูนย์รวมรถมือสอง สระแก้ว รถยนต์ รถกะบะทุกรุ่น สภาพนางฟ้า ราคาดี รับประกันคุณภาพ ฟรีของแถม</span>
                                <img src="<?= $baseUrl ?>/images/home/deeteesood-logo.jpg" />
                            </div>
                        </div>
                        <div class="col-1-3">
                            <div class="wrap-col item">
                                <h3 class="item-header">บริษัทรถชั้นนำของเมืองไทย</h3>                                
                                <div class="four column doubling ui grid">
                                    <?php foreach ($logos as $image) { ?>
                                        <div class="column">
                                            <img  src="<?= $baseUrl ?>/uploads/car_logos/<?= $image ?>">
                                        </div>
                                    <?php } ?>     
                                </div>
                            </div>
                        </div>
                        <div class="col-1-3">
                            <div class="wrap-col item" style="border-right: none;">
                                <h3 class="item-header">บริษัทพันธมิตร</h3>
                                <span>คาร์แอนด์เซอร์วิส สระแก้ว สาขา 1</span>
                                <p>คาร์แอนด์เซอร์วิส สระแก้ว สาขา 1</p>
                                <hr style="border: 1px dashed #ccc;margin: 17px 0;">
                                <span>คาร์แอนด์เซอร์วิส สระแก้ว สาขา 2</span>
                                <p>คาร์แอนด์เซอร์วิส สระแก้ว สาขา 2</p>
                                <hr style="border: 1px dashed #ccc;margin: 17px 0;">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>


</div>