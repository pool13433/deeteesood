<?php $baseUrl = Yii::app()->baseUrl; ?>
<style>
    [ng\:cloak], [ng-cloak], [data-ng-cloak], [x-ng-cloak], .ng-cloak, .x-ng-cloak {
        display: none !important;
    }
</style>
<div class="ui container" ng-controller="ProductController as vm">
    <div class="ui  inverted dimmer" ng-class="{active : vm.isLoader}">
        <div class="ui large text loader">Loading</div>
    </div>
    <div class="ui styled accordion fluid" ng-cloak>

        <?php $this->renderPartial('/site/product_filter_brand') ?>

        <?php
        $this->renderPartial('/site/product_filter_advance', array(
            'colors' => $colors,
            'brands' => $brands,
            'sortOption' => $sortOption,
            'types' => $types,
            'years' => $years,
            'gears' => $gears,
            'condition' => $condition
        ))
        ?>

        <div class="title" style="font-size: medium;background-color: #F3542D;">
            <i class="dropdown icon"></i>
            <i class="car icon"></i> สินค้า ( จำนวนสินค้าทั้งหมด {{vm.countProduct}} ชิ้น )
        </div>
        <div class="content active" ng-cloak>           

            <div class="ui vertical segment" ng-repeat="cat in vm.productList" ng-cloak>
                <h4 class="ui header">{{cat.cat_name}} ( จำนวนสินค้า {{cat.products.length}} ชิ้น )</h4>
                <div class="ui special cards three stackable">
                    <div class="card" ng-repeat="prod in cat.products" ng-cloak>
                        <div class="blurring dimmable image">
                            <div class="ui dimmer">
                                <div class="content">
                                    <div class="center">
                                        <a class="ui inverted button"  target="_blank"
                                           href="<?= Yii::app()->createUrl('/site/detail') ?>/{{prod.prod_id}}">ดูรายละเอียด</a>
                                    </div>
                                </div>
                            </div>
                            <img class="image" src="<?= $baseUrl ?>/uploads/{{prod.prod_picture}}">
                        </div>
                        <div class="content">
                            <h3>{{prod.prod_name}} (ปี {{(prod.prod_year !== '' ? prod.prod_year : 'ไม่ระบุ')}})</h3>
                            <div class="meta">

                            </div>
                            <div class="meta">
                                ยี่ห้อ: {{prod.bra_name}}
                            </div>
                        </div>
                        <div class="extra content">
                            <span class="right floated">
                                อัพเดทข้อมูลเมื่อ: {{prod.prod_date}}
                            </span>
                            <span>
                                <i class="money icon"></i>
                                ราคา: {{prod.prod_price}}
                            </span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
