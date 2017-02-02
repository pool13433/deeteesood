<?php $baseUrl = Yii::app()->baseUrl; ?>
<div class="ui top sidebar ui segment">
    <div class="ui center aligned container grid">
        <div class="one column row">
<!--            <div class="sixteen wide column inverted red fluid">
                <h3 class="ui header">รถยี่ห้อ {{vm.brand.bra_name}}</h3>
            </div>-->
            <div class="column red clearing">
                <h3 class="ui right floated header">
                    <i class="remove icon large closed" style="cursor: pointer;"></i>
                </h3>
                <h3 class="ui left floated header">
                   รถยี่ห้อ {{vm.brand.bra_name}}
                </h3>
            </div>
        </div>
        <div class="one column row">
            <div class="ui cards six special stackable">
                <div class="ui card" ng-repeat="car in vm.carList">
                    <div class="blurring dimmable image">
                        <div class="ui dimmer">
                            <div class="content">
                                <div class="center">
                                    <a class="ui inverted button" target="_blank"
                                       href="<?= Yii::app()->createUrl('/site/detail') ?>/{{car.prod_id}}">ดูรายละเอียด</a>
                                </div>
                            </div>
                        </div>
                        <img src="<?= $baseUrl ?>/uploads/{{car.prod_picture}}" ng-if="car.prod_picture"/>
                    </div>
                    <div class="content">
                        <h3>{{car.prod_name}}</h3>
                        <!--                    <h4>
                                                <p>ราคา: &nbsp;&nbsp;<span style="font-size: x-large;color:#000000;">
                                                        {{car.prod_price}}</span>&nbsp;&nbsp; บาท</p>
                                            </h4>-->
                    </div>
                </div>      
                <div class="ui card">
                    <div class="blurring dimmable image">
                        <div class="ui dimmer">
                            <div class="content">
                                <div class="center" style="cursor: pointer;">
                                    <a class="ui inverted button" ng-click="vm.hrefProduct(vm.brand.bra_id)">ดูรถยี่ห้อนี้เพิ่มเติม กด</a>
                                </div>
                            </div>
                        </div>
                        <img src="<?= $baseUrl ?>/images/app/logo_deeteesood.png"/>
                    </div>
                </div>      
            </div>
        </div>
    </div>
</div>