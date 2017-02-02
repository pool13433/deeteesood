<?php $baseUrl = Yii::app()->baseUrl; ?>
<div class="ui container fluid context"  ng-controller="HomeController as vm">

    <!-- sidebar -->
    <?php $this->renderPartial('/site/sidebar_cars') ?>

    <div class="pusher">
        <div class="slider">
            <!-- Slideshow -->
            <div class="callbacks_container">
                <ul class="rslides" id="slider">
                    <?php foreach ($slides as $index => $slide) { ?>
                        <li>
                            <img src="<?= $baseUrl ?>/uploads/slides/<?= $slide['sli_picture'] ?>" alt="">
                            <!--                        <div class="caption">
                                                        <h1><?= $slide['sli_title'] ?></h1>
                                                    </div>-->
                        </li>
                    <?php } ?>                
                </ul>
            </div>
            <div class="clear"></div>
        </div>

        <!--////////////////////////////////////Container-->
        <section class="ui row">
            <div class="ui container fluid">
                <section class="content-box">
                    <!--Start Box-->
                    <div class="zerogrid">
                        <div class="row">
                            <div class="header ui" style=margin-top:10px;>
                                <h2 class="heading">
                                    <span>คุณกำลังมองหารถยี่ห้อไหน (คลิก)</span>
                                </h2>
                            </div>
                            <div class="ten column doubling ui grid  centered">
                                <?php foreach ($brands as $brand) { ?>
                                    <div class="column" ng-click="vm.findCarsByBrand(<?= $brand['bra_id'] ?>)">
                                            <!-- href="<?= Yii::app()->createUrl('/site/product', array('brand' => $brand['bra_id'])) ?>" -->
                                        <a href="javascript:void(0)">
                                            <img  src="<?= $baseUrl ?>/uploads/brands/<?= $brand['bra_picture'] ?>">
                                        </a>
                                    </div>
                                <?php } ?>     
                                <div class="column middle aligned">
                                    <a href="<?= Yii::app()->createUrl('/site/product') ?>">
                                        <h2>ดูทั้งหมด</h2>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </section>
        <section class="content-box box-4">
            <div class="zerogrid">
                <div class="header ui">
                    <h2 class="heading">
                        <span>สินค้ายอดนิยม</span>
                    </h2>
                    <h3>ศูนย์รวมรถมือสอง สระแก้ว รถยนต์ รถกะบะทุกรุ่น สภาพนางฟ้า ราคาดี รับประกันคุณภาพ ฟรีของแถม <br>
                        สินค้าที่มียอดผู้เข้าชม และการกดให้คะแนนมากที่สุด เชิญรวมโหวตสินค้าที่คุณถูกใจได้เลยค่ะ</h3>
                </div>
                <div class="ui cards three special stackable">
                    <!--Start Box-->
                    <?php foreach ($products as $index => $prod) { ?>
                        <div class="ui card">
                            <div class="blurring dimmable image">
                                <div class="ui dimmer">
                                    <div class="content">
                                        <div class="center">
                                            <a class="ui inverted button"
                                               href="<?= Yii::app()->createUrl('/site/detail', array('id' => $prod['prod_id'])) ?>">ดูรายละเอียด</a>
                                        </div>
                                    </div>
                                </div>
                                <img src="<?= $baseUrl ?>/uploads/<?= $prod['prod_picture'] ?>" />
                            </div>
                            <div class="content">
                                <h3><?= $prod['prod_name'] ?></h3>
                                <h4>
                                    <p>ราคา: &nbsp;&nbsp;<span style="font-size: x-large;color:#000000;"><?= $prod['prod_price'] ?></span>&nbsp;&nbsp; บาท</p>
                                </h4>
                                <h4>
                                    <p>ยอดเข้าดู <?= $prod['sum_view'] ?> ครั้ง, 
                                        <?= ($prod['sum_star'] == 0 ? 'ยังไม่ได้รับการโหวต' : 'คะแนนผลโหวต  ' . $prod['sum_star'] . '  คะแนน') ?></p>
                                </h4>
                            </div>
                        </div>      
                    <?php } ?>
                </div>
            </div>
        </section>
        <section class="content-box box-2">
            <!--Start Box-->
            <div class="zerogrid">
                <div class="row">
                    <div class="header ui">
                        <h2 class="heading">
                            <span>กิจกรรม</span>
                        </h2>
                    </div>
                    <h3>
                        ติดตามชมและเข้าร่วมกิจกรรมกับทางเราได้ที่ &nbsp <a href="http://192.168.143.1/deeteesood/">  www.deeteesoodcarandservice.com </a>  &nbspและ  &nbsp 
                        <a href="http://www.facebook.com/deeteesoodcarandservice/">
                            <img style="max-height: 30px;max-width: 30px;" src="<?= $baseUrl ?>/images/brands/logo_facebook.png"/>
                        </a> <br><br> 
                    </h3>
                </div>
            </div>
            <div class="zerogrid">
                <div class="ui cards special three stackable">
                    <?php foreach ($socials as $index => $social) { ?>
                        <div class="ui card">
                            <div class="blurring dimmable image">
                                <div class="ui dimmer">
                                    <div class="content">
                                        <div class="center">
                                            <a class="ui inverted button"
                                               href="<?= Yii::app()->createUrl('/site/social/', array('id' => $social['soc_id'])) ?>">ดูภาพอื่น ๆ</a>
                                        </div>
                                    </div>
                                </div>
                                <img src="<?= $baseUrl ?>/uploads/socials/<?= $social['alb_picture'] ?>" />
                            </div>
                            <div class="content">
                                <h3><a><?= $social['soc_title'] ?></a></h3>
                                <div class="description">
                                    <a><?= $social['soc_desc'] ?></a>
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
                    <div class="header ui">
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
                                        <!--<a class="btn" href="<?= Yii::app()->createUrl('site/video', array('id' => $video['vid_id'])) ?>">Read More</a>-->
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
        <section class="content-box box-2">
            <!--Start Box-->
            <div class="zerogrid">
                <div class="row">
                    <div class="header ui">
                        <h2 class="heading">
                            <span>ทำไมต้องเลือกเรา</span>
                        </h2>
                    </div>
                    <div class="ui container">
                        <div class="ui grid stackable">
                            <div class="thirteen wide column">
                                <img src="<?= $baseUrl ?>/images/app/whywe.png"/>
                            </div>
                            <div class="three wide column">
                                <img src="<?= $baseUrl ?>/images/app/logo_deeteesood.png"/>
                            </div>
                        </div>                        
                    </div>
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
                            <span>ศูนย์รวมรถมือสอง สระแก้ว รถยนต์ รถกะบะทุกรุ่น สภาพนางฟ้า ราคาดี รับประกันคุณภาพ ฟรีของแถม</span>
                            <img style="max-width: 180px;" src="<?= $baseUrl ?>/images/home/deeteesood-logo.png" />
                        </div>
                    </div>
                    <div class="col-1-3">
                        <div class="wrap-col item">
                            <h3 class="item-header">สาขา</h3>
                            <span>ดีที่สุด คาร์ แอนด์ เซอร์วิส สาขาสระแก้ว</span>
                            <p>ตรงข้ามบิ๊กซีสระแก้ว</p>
                            <hr style="border: 1px dashed #ccc;margin: 17px 0;">
                            <span>ดีที่สุด คาร์ แอนด์ เซอร์วิส สาขากบินทร์บุรี</span>
                            <p> </p>
                            <hr style="border: 1px dashed #ccc;margin: 17px 0;">
                            <h3 class="item-header">ติดตามเรา</h3>
                            <div class="five column doubling ui grid">
                                <div class="column">
                                    <a class="ui image" href="http://www.facebook.com/deeteesoodcarandservice/"><img style="min-height: 50px;min-width: 50px;" src="<?= $baseUrl ?>/images/brands/logo_facebook.png"/></a>                         
                                </div>
                                <div class="column">
                                    <a class="ui image" href="#"><img style="min-height: 50px;min-width: 50px;" src="<?= $baseUrl ?>/images/brands/logo_youtube.png"/></a>  <br>
                                </div>
                                <div class="column">
                                    <a class="ui image" href="#"><img style="min-height: 50px;min-width: 50px;" src="<?= $baseUrl ?>/images/brands/logo_line.png"/></a>                                          
                                </div>
                                <!--<div class="column">
                                   <a class="ui image" href="#">Line ID : deeteesood</a>              
                                </div> -->
                            </div>
                        </div>   
                    </div>
                    <div class="col-1-3">
                        <!-- <div class="wrap-col item" style="border-right: none;">
                             <h3 class="item-header">ติดต่อฝ่ายขาย</h3>                                
                             <span>คุณ xxx xxx</span>
                             <p>เจ้าหน้าที่ดูแลการขาย 1</p>
                             <hr style="border: 1px dashed #ccc;margin: 17px 0;">
                             <span>คุณ xxx xxx</span>
                             <p>เจ้าหน้าที่ดูแลการขาย 1</p>
                             <hr style="border: 1px dashed #ccc;margin: 17px 0;">
                             <span>คุณ xxx xxx</span>
                             <p>เจ้าหน้าที่ดูแลการขาย 1</p>
                             <hr style="border: 1px dashed #ccc;margin: 17px 0;">
                             <span>คุณ xxx xxx</span>
                             <p>เจ้าหน้าที่ดูแลการขาย 1</p>
                             <hr style="border: 1px dashed #ccc;margin: 17px 0;">
                             <span>คุณ xxx xxx</span>
                             <p>เจ้าหน้าที่ดูแลการขาย 1</p>
                             <hr style="border: 1px dashed #ccc;margin: 17px 0;">
                         </div>-->          
                        <div class="wrap-col item">
                            <h3 class="item-header">พัทธมิตรของเรา</h3>         
                            <div class="ui small image">
                                <img  src="<?= $baseUrl ?>/images/home/SP-Group.gif"/>
                            </div>
                            <hr style="border: 1px dashed #ccc;margin: 17px 0;">           
                            <a target="_blank" href="https://www.facebook.com/%E0%B8%AE%E0%B8%AD%E0%B8%99%E0%B8%94%E0%B9%89%E0%B8%B2%E0%B8%9B%E0%B8%A3%E0%B8%B0%E0%B8%AA%E0%B8%B4%E0%B8%97%E0%B8%98%E0%B8%B4%E0%B9%8C%E0%B8%A1%E0%B8%AD%E0%B9%80%E0%B8%95%E0%B8%AD%E0%B8%A3%E0%B9%8C%E0%B8%AA%E0%B8%A3%E0%B8%B0%E0%B9%81%E0%B8%81%E0%B9%89%E0%B8%A7-2554-%E0%B8%88%E0%B8%B3%E0%B8%81%E0%B8%B1%E0%B8%94-928062800589987/?__mref=message_bubble">
                                <strong>บริษัท ฮอนด้าประสิทธิ์มอเตอร์สระแก้ว (2554) จำกัด</strong>
                            </a>
                            <hr style="border: 1px dashed #ccc;margin: 17px 0;">                                                                                     
                            <strong>บริษัท สุรพล ซัพพอร์ต ลิสซิ่ง จำกัด</strong>
                        </div>
                    </div>                    
                </div>
            </div>
        </section>
    </div>


</div>