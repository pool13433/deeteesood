<?php $baseUrl = Yii::app()->baseUrl; ?>
<section class="ui container" ng-controller="ProductDetailController as vm" ng-init="vm.prodId = <?= $product['prod_id'] ?>">

    <div class="ui grid container stackable">
        <div class="eight wide column">
            <h2>
                <?= $product['prod_name'] ?>       
            </h2>
        </div>
        <div class="eight wide column right aligned">
            <h3>
                    <!-- Share Button -->
               <div id="fb-root"></div>
               <span class="fb-share-button" data-href="<?=$baseUrl?>/site/detail/<?=$product['prod_id'] ?>" data-layout="button_count" data-size="large" data-mobile-iframe="true">
                   <a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">แชร์</a>
               </span>
               <!-- Share Button -->
                ให้ดาว <span class="ui massive star rating" data-rating="0" data-max-rating="5"></span>
            </h3>
        </div>
    </div>
    <div class="ui attached segment">        
        <div class="ui grid stackable">
            <!--            <div class="six wide column">          
                            <div id="idPicurePreview" style="text-align:center;">
                                <img class="ui image" src="<?= $baseUrl ?>/uploads/<?= $product['prod_picture'] ?>" style="max-height: 400px;">
                            </div>
                        </div>
                        <div class="ten wide column">                      
                            <div class="five column doubling ui grid">                
                                <div class="column" ng-class="{'red' : vm.pictureView == - 1}">
                                    <img class="ui image" src="<?= $baseUrl ?>/uploads/<?= $product['prod_picture'] ?>" 
                                         ng-click="vm.picturePreview($event, - 1)" style="max-height: 400px;cursor: pointer;">
                                </div>
            <?php foreach ($pictures as $index => $picture) { ?>
                                                                                <div class="column" ng-class="{'red' : vm.pictureView == <?= $index ?>}"   >
                                                                                    <img src="<?= $baseUrl ?>/uploads/products/<?= $picture['alb_picture'] ?>" 
                                                                                         ng-click="vm.picturePreview($event,<?= $index ?>)" style="max-height: 400px;cursor: pointer;">
                                                                                </div>
            <?php } ?>
                            </div>
                        </div>-->
            <div class="eight wide column">        
                <div class="ui one column grid">
                    <div class="column">
                        <div class="ui segment">
                            <img src="<?= $baseUrl ?>/uploads/<?= $product['prod_picture'] ?>"> 
                        </div>
                    </div>
                    <div class="column">                        
                        <div class="gamma-container gamma-loading" id="gamma-container">
                            <ul class="gamma-gallery">
                                <li>
                                    <div data-alt="<?= $product['prod_name'] ?>" 
                                         data-description="<h3>รูปหลักของสินค้า</h3>" data-max-width="1800" 
                                         data-max-height="1350">
                                        <div data-src="<?= $baseUrl ?>/uploads/<?= $product['prod_picture'] ?>"></div>
                                        <noscript>
                                        <img src="<?= $baseUrl ?>/uploads/<?= $product['prod_picture'] ?>">              
                                        </noscript>
                                    </div>
                                </li>
                                <?php foreach ($pictures as $index => $pic) { ?>
                                    <li>
                                        <div data-alt="<?= $pic['alb_picture'] ?>" 
                                             data-description="<h3>รูปที่ <?= $index + 1 ?></h3>" data-max-width="1800" 
                                             data-max-height="1350">
                                            <div data-src="<?= $baseUrl ?>/uploads/products/<?= $pic['alb_picture'] ?>"></div>
                                            <noscript>
                                            <img src="<?= $baseUrl ?>/uploads/products/<?= $pic['alb_picture'] ?>">              
                                            </noscript>
                                        </div>
                                    </li>
                                <?php } ?>                
                            </ul>
                        </div>
                    </div>
                </div>                
            </div>
            <div class="eight wide column">       
                <div class="ui grid container stackable">
                    <div class="eight wide column">
                        <h3 class="ui header left aligned">
                            ชื่อรถ: <span class="ui sub header left aligned"><?= $product['prod_name'] ?></span>            
                        </h3>                      
                        <h3 class="ui header left aligned">
                            ราคา: <span class="ui sub header left aligned"><?= $product['prod_price'] ?> บาท</span>        
                        </h3>
                        <h3 class="ui header left aligned">
                            ปี: <span class="ui sub header left aligned"><?= $product['prod_year'] ?></span>
                        </h3>
                        <h3 class="ui header left aligned">
                            ประเภท: <span class="ui sub header left aligned"><?= $product['cat_name'] ?></span> 
                        </h3>     
                        <h3 class="ui header left aligned">
                            สี:  <span class="ui sub header left aligned"><?= $product['prod_color'] ?></span>
                        </h3>     
                    </div>
                    <div class="eight wide column">
                        <h3 class="ui header left aligned">
                            ยี่ห้อ: <span class="ui sub header left aligned"><?= $product['bra_name'] ?></span>
                        </h3>
                        <h3 class="ui header left aligned">
                            รุ่น: <span class="ui sub header left aligned"><?= $product['mod_name'] ?></span>
                        </h3>
                        <h3 class="ui header left aligned">
                            ชนิด: <span class="ui sub header left aligned"><?= $product['type_name'] ?></span>
                        </h3>
                        <h3 class="ui header left aligned">
                            เครื่องยนต์:  <span class="ui sub header left aligned"><?= $product['prod_engine'] ?></span>
                        </h3>        
                        <h3 class="ui header left aligned">
                            ระบบเกียร์:  <span class="ui sub header left aligned"><?= $product['prod_gear'] ?></span>
                        </h3>        
                    </div>
                    <div class="sixteen wide column">
                        <h3 class="ui header left aligned">
                            รายละเอียด: <span class="ui sub header left aligned"><?= $product['prod_desc'] ?></span>        
                        </h3>
                    </div>
                    <div class="eight wide column">
                        <h3 class="ui header left aligned">
                            อัพเดทข้อมูลเมื่อ: <span class="ui sub header left aligned"><?= $product['prod_date'] ?></span>            
                        </h3>  
                    </div>
                </div>


            </div>
        </div>
    </div>
</section>
