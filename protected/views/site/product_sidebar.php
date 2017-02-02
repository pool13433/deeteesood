<?php $baseUrl = Yii::app()->baseUrl; ?>
<div class="ui container" ng-controller="ProductController as vm">
    <div class="ui top attached menu filter"  style="background-color: #F3542D">
        <a class="item"><h3></i> <i class="search icon"></i>  ค้นหา</h3></a>
    </div>
    <div class="ui bottom attached segment pushable" style="min-height: 280px;">
        <div class="ui inverted icon top sidebar">
            <?php
            $this->renderPartial('/site/product_filter', array(
                'colors' => $colors,
                'brands' => $brands,
                'sortOption' => $sortOption,
                'types' => $types,
                'years' => $years,
                'condition' => $condition
            ))
            ?>
        </div>
        <div class="pusher">
            <div class="ui segment" style="background-color: #E6E6E6">
                <h3>ผลการค้นหาพบสินค้า {{vm.countProduct}} ชิ้น </h3>
                <div class="ui  inverted dimmer" ng-class="{active : vm.isLoader}">
                    <div class="ui large text loader">Loading</div>
                </div>

                <div class="ui vertical segment" ng-repeat="cat in vm.productList">
                    <h4 class="ui header">{{cat.cat_name}} ( จำนวนสินค้า {{cat.products.length}} ชิ้น )</h4>
                    <div class="ui special cards three stackable">
                        <div class="card" ng-repeat="prod in cat.products">
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
                                    <span class="date"> {{prod.prod_date}}</span>
                                </div>
                                <div class="meta">
                                    Brand {{prod.bra_name}}, 
                                </div>
                                <div class="description">
                                    {{prod.prod_desc}}
                                </div>
                            </div>
                            <div class="extra content">
                                <a>
                                    <i class="money icon"></i>
                                    Price : {{prod.prod_price}}
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

