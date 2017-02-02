<?php $baseUrl = Yii::app()->baseUrl; ?>
<div class="title" style="font-size: medium;background-color: #F3542D;">
    <i class="dropdown icon"></i> <i class="search icon"></i>  ค้นหา แบบละเอียด
</div>
<div class="content">
    <form class="ui form" ng-model="vm.product"
          ng-init="vm.product.brand = '<?= $condition['brand'] ?>'">
        <div class="five fields">
            <div class="field">
                <label>ยี่ห้อ</label>
                <select name="brand" ng-model="vm.product.brand" class="fluid search selection ui dropdown"
                        ng-options="brand.bra_id as brand.bra_name for brand in vm.brandList" ng-change="vm.selectBrand(vm.product.brand)">
                    <option value="">--ทั้งหมด--</option>                        
                </select>
            </div>
            <div class="field">
                <label>รุ่น</label>
                <select name="model" id="ddModel" ng-model="vm.product.model" class="fluid search selection ui dropdown"
                        ng-options="model.mod_id as model.mod_name for model in vm.modelList">                                        
                </select>
            </div>       
            <div class="field">
                <label>สี</label>
                <select name="color" ng-model="vm.product.color" class="fluid search selection ui dropdown">
                    <option value="">--ทั้งหมด--</option>
                    <?php foreach ($colors as $index => $color) { ?>
                        <option value="<?= $color['prod_color'] ?>"><?= $color['prod_color'] ?></option>
                    <?php } ?>
                </select>
            </div>              
            <div class="field">
                <label>ปี</label>
                <select name="year" ng-model="vm.product.year" class="fluid search selection ui dropdown">
                    <option value="">--ทั้งหมด--</option>
                    <?php foreach ($years as $year) { ?>
                        <option value="<?= $year ?>"><?= $year ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="five fields">
            <div class="field">
                <label>ช่วง ราคาสินค้า จาก</label>
                <input type="number" name="price_begin" ng-model="vm.product.price_begin" placeholder="ราคาต่ำสุด"/>
            </div>
            <div class="field">
                <label>ถึง</label>
                <input type="number" name="price_end"  ng-model="vm.product.price_end"  placeholder="ราคาสูงสุด"/>
            </div>
            <div class="field">
                <label>เรียงราคา จาก</label>
                <select name="price_sort" ng-model="vm.product.price_sort" class="fluid  selection ui dropdown">
                    <option value="">--เลือก--</option>
                    <?php foreach ($sortOption as $index => $sort) { ?>
                        <option value="<?= $index ?>"><?= $sort ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="field">
                <label>ระบบเกียร์</label>
                <select name="gear" ng-model="vm.product.gear" class="fluid  selection ui dropdown">
                    <option value="">--เลือก--</option>
                    <?php foreach ($gears as $index => $data) { ?>
                        <option value="<?= $index ?>"><?= $data ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <div class="field">
            <div class="required inline field">
                <label>ประเภท</label>
                <div class="ui checkbox">
                    <input tabindex="0"  type="checkbox" ng-model="vm.carALL" ng-init="vm.carALL = true">
                    <label>ทั้งหมด</label>
                </div>
                <?php foreach ($types as $index => $type) { ?>
                    <div class="ui checkbox" ng-init="vm.car[<?= $type['type_id'] ?>] = false;">
                        <input tabindex="0"  type="checkbox" value="<?= $type['type_name'] ?>" 
                               ng-model="vm.car[<?= $type['type_id'] ?>]" ng-value="<?= $type['type_id'] ?>">
                        <label><?= $type['type_name'] ?></label>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="ui submit button green" ng-click="vm.filterProduct(vm.product)">
            <i class="search icon"></i> ค้นหา
        </div>
        <div class="ui submit button blue" ng-click="vm.filterReset()">
            <i class="eraser icon"></i> ล้างการค้นหา
        </div>
        <!--    <div class="ui submit button red closed">
                <i class="remove icon"></i> ปิด
            </div>-->
    </form>
</div>