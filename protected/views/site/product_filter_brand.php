<?php $baseUrl = Yii::app()->baseUrl; ?>
<div class="title" style="font-size: medium;background-color: #F3542D;">
    <i class="dropdown icon"></i> <i class="search icon"></i>  ค้นหา ด้วยยี่ห้อของรถ
</div>
<div class="content">
    <div class="ui tiny images">
        <img class="ui image" ng-repeat="brand in vm.brandList" 
             src="<?= $baseUrl ?>/uploads/brands/{{brand.bra_picture}}" 
             ng-if="brand.bra_picture !== ''" ng-click="vm.filterProductByBrand(brand.bra_id)" style="cursor: pointer;">
    </div>
</div>