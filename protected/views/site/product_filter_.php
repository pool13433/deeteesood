<?php $baseUrl = Yii::app()->baseUrl; ?>
<form class="ui form" ng-model="vm.product">
    <div class="fields three">
        <div class="field">
            <div class="fields two">
                <div class="field">
                    <label>ช่วง ราคาสินค้า จาก</label>
                    <input type="number" name="price_begin" ng-model="vm.product.price_begin" placeholder="ราคาต่ำสุด"/>
                </div>
                <div class="field">
                    <label>ถึง</label>
                    <input type="number" name="price_end"  ng-model="vm.product.price_end"  placeholder="ราคาสูงสุด"/>
                </div>
            </div>
        </div>
        <div class="field">
            <div class="fields two">
                <div class="field">
                    <label>เรียงราคา จาก</label>
                    <select name="price_sort" ng-model="vm.product.price_sort" class="fluid  selection ui dropdown">
                        <?php foreach ($sortOption as $index => $sort) { ?>
                            <option value="<?= $index ?>"><?= $sort ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>

    </div>
    <div class="three fields">
        <div class="field">
            <div class="two fields">
                <div class="field" ng-init="vm.product.brand = '<?=$condition['brand']?>' ">
                    <label>ยี่ห้อ</label>
                    <select name="brand" ng-model="vm.product.brand" class="fluid search selection ui dropdown">
                        <option value="">--ทั้งหมด--</option>
                        <?php foreach ($brands as $index => $brand) { ?>
                            <?php if ($condition['brand'] == $brand['bra_id']) { ?>
                                <option value="<?= $brand['bra_id'] ?>" selected><?= $brand['bra_name'] ?></option>
                            <?php } else { ?>
                                <option value="<?= $brand['bra_id'] ?>"><?= $brand['bra_name'] ?></option>
                            <?php } ?>
                        <?php } ?>
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
            </div>
        </div>       
        <div class="field">
            <div class="two fields">
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
</form>