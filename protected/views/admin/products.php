<?php $baseUrl = Yii::app()->baseUrl; ?>
<div class="ui container" ng-controller="MRGProductController as vm">
    <h3 class="ui top attached header left aligned" style="background-color: #F3542D;">        
        <div class="ui big breadcrumb">
            <a class="section" href="<?= $baseUrl . '/admin/dashboard' ?>">เมนูการใช้งาน</a>
            <i class="right angle icon divider"></i>
            <div class="active section">จัดการสินค้า</div>
        </div>
    </h3>
    <div class="ui attached segment">
        <form class="ui form"  method="post" action="<?= Yii::app()->createUrl('/admin/MRGSaveProduct') ?>" enctype="multipart/form-data">
            <a class="ui button blue" href="<?= Yii::app()->createUrl('/admin/MRGProduct') ?>"><i class="plus icon"></i> สร้างใหม่</a>
            <div class="ui divider"></div>    
            
             <div class="two fields">
                <div class="field">
                    <?php foreach (Yii::app()->user->getFlashes() as $key => $message) { ?>
                        <div class="ui <?= $key ?> message large">
                            <i class="close icon"></i>
                            <div class="header left aligned">
                                <?= $message['title'] ?>
                            </div>
                            <p><?= $message['message'] ?> </p>
                        </div>
                    <?php } ?>
                </div>
            </div>
            
            <div class="fields">
                <div class="four wide field">
                    <h4>รูป</h4>
                    <?php
                    $image = '/images/app/icon-upload_master.png';
                    if (!empty($product['prod_picture'])) {
                        $image = '/uploads/' . $product['prod_picture'];
                    }
                    ?>
                    <img id="idImgPicture" class="ui image rounded fluid" src="<?= $baseUrl ?><?= $image ?>"/>
                    <input type="file" name="picture"  id="idInputPicture" <?= empty($product['prod_id']) ? 'required' : '' ?> 
                           style="display: none;" accept="image/*"/>
                    <button class="ui button blue fluid" type="button" id="idBtnPicture">เลือกรูป</button>
                </div>
                <div class=" twelve wide field">
                    <label>รูปเพิ่มเติม</label>
                    <input type="file" multiple name="filUpload[]" id="productInput" style="display: none;" accept="image/*"/>
                    <button class="ui button pink" type="button" ng-click="vm.btnProductsClick()">เลือกรูปภาพเพิ่มเติ่ม (เลือกรูปได้มากกว่า 1 รูปโดยเวลาเลือกให้กดปุ่ม Ctrl ค้างไว้ขณะเลือก)</button>

                    <div class="ui small images">                
                        <img class="ui image" id="image{{$index}}"  ng-repeat="image in vm.imageList">
                        <?php if (count($product['albums']) > 0) { ?>
                            <div class="ui divider">รูปเดิม <i class="arrow down icon"></i></div>
                            <?php foreach ($product['albums'] as $index => $picture) { ?>
                                <div class="original-picture">
                                    <img class="ui image mini" src="<?= $baseUrl ?>/uploads/products/<?= $picture['alb_picture'] ?>">
                                    <button class="ui label mini red" type="button" ng-click="vm.trashPic($event,<?= $picture['alb_id'] ?>)"><i class="remove icon"></i></button>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="four fields">
                <div class="field">
                    <h4>รหัสสินค้า</h4>
                    <input type="hidden" name="product[prod_id]" value="<?= $product['prod_id'] ?>"/>
                    <input type="text" name="product[prod_code]"  placeholder="รหัสสินค้า" required="required" value="<?= $product['prod_code'] ?>"/>
                </div>
                <div class="field">
                    <h4>ชื่อสินค้า</h4>
                    <input type="text" name="product[prod_name]" placeholder="ชื่อสินค้า" required="required" value="<?= $product['prod_name'] ?>"/>
                </div>
                <div class="field">
                    <h4>ยี่ห้อ</h4>
                    <select required="required" name="product[bra_id]" id="ddBrand">
                        <option value="">--เลือก--</option>
                        <?php foreach ($brands as $index => $brand) { ?>
                            <?php if ($brand['bra_id'] == $product['bra_id']) { ?>
                                <option value="<?= $brand['bra_id'] ?>" selected><?= $brand['bra_name'] ?></option>
                            <?php } else { ?>
                                <option value="<?= $brand['bra_id'] ?>"><?= $brand['bra_name'] ?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </div>
                <div class="field">
                    <h4>รุ่น</h4>
                    <select  name="product[mod_id]"  id="ddModel">
                        <option value="">--เลือก--</option>                        
                        <?php foreach ($models as $index => $model) { ?>
                            <?php if ($model['mod_id'] == $product['mod_id']) { ?>
                                <option value="<?= $model['mod_id'] ?>" selected><?= $model['mod_name'] ?></option>
                            <?php } else { ?>
                                <option value="<?= $model['mod_id'] ?>"><?= $model['mod_name'] ?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </div>
                <!--                <div class="field">
                                    <h4>ยี่ห้อ</h4>
                                    <select required="required" name="product[bra_id]" ng-model="vm.brand"
                                            ng-change="vm.changeBrand(vm.brand)">
                                        <option value="">--เลือก--</option>
                                        <option ng-repeat="brand in vm.brandList"
                                                value="{{brand.bra_id}}">{{brand.bra_name}}</option>
                                    </select>
                                </div>
                                <div class="field">
                                    <h4>รุ่น</h4>
                                    <select required="required" name="product[mod_id]" class="fluid search selection ui dropdown" ng-model="vm.model">
                                        <option value="">--เลือก--</option>
                                        <option ng-repeat="model in vm.modelList" value="{{model.mod_id}}">{{model.mod_name}}</option>
                                    </select>
                                </div>-->
            </div>
            <div class="four fields">
                <div class="field">
                    <h4>ขนาดเครื่องยนต์</h4>
                    <input type="text" name="product[prod_engine]" placeholder="ขนาดเครื่องยนต์" required="required" value="<?= $product['prod_engine'] ?>"/>
                </div>
                <div class="field">
                    <h4>ระบบเกียร์</h4>
                    <select required="required" name="product[prod_gear]" >
                        <option value="">--เลือก--</option>
                        <?php foreach ($gears as $index => $data) { ?>
                            <?php if ($product['prod_gear'] == $index) { ?>
                                <option value="<?= $index ?>" selected><?= $data ?></option>
                            <?php } else { ?>
                                <option value="<?= $index ?>"><?= $data ?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </div>

                <div class="field">
                    <h4>กลุ่ม</h4>
                    <select required="required" name="product[cat_id]">
                        <option value="">--เลือก--</option>
                        <?php foreach ($categorys as $index => $cat) { ?>
                            <?php if ($cat['cat_id'] == $product['cat_id']) { ?>
                                <option value="<?= $cat['cat_id'] ?>" selected><?= $cat['cat_name'] ?></option>
                            <?php } else { ?>
                                <option value="<?= $cat['cat_id'] ?>"><?= $cat['cat_name'] ?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </div>
                <div class="field">
                    <h4>ประเภท</h4>
                    <select required="required" name="product[type_id]">
                        <option value="">--เลือก--</option>
                        <?php foreach ($types as $index => $type) { ?>
                            <?php if ($type['type_id'] == $product['type_id']) { ?>
                                <option value="<?= $type['type_id'] ?>" selected><?= $type['type_name'] ?></option>
                            <?php } else { ?>
                                <option value="<?= $type['type_id'] ?>"><?= $type['type_name'] ?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="four fields">
                <div class="field">
                    <h4>ราคาสินค้า</h4>
                    <input type="number" name="product[prod_price]" placeholder="ราคาสินค้า" required="required" value="<?= $product['prod_price'] ?>"/>
                </div>
                <div class="field">
                    <h4>สี</h4>
                    <input type="text" name="product[prod_color]" placeholder="สี" required="required" value="<?= $product['prod_color'] ?>"/>
                </div>
                <?= HTML::dropdownFieldStatus($product['prod_status'], 'product[prod_status]') ?>
                <!--                <div class="field">
                                    <h4>สถานะสินค้า</h4>
                <?php
                $default = 'active';
                if (!empty($product['prod_status'])) {
                    $default = '';
                }
                ?>
                                    <select required="required" name="product[prod_status]">
                                        <option value="">--เลือก--</option>
                <?php foreach ($status as $index => $data) { ?>
                    <?php if ($product['prod_status'] == $index || $default == $index) { ?>
                                                        <option value="<?= $index ?>" selected><?= $data ?></option>
                    <?php } else { ?>
                                                        <option value="<?= $index ?>"><?= $data ?></option>
                    <?php } ?>
                <?php } ?>
                                    </select>
                                </div>-->
                <div class="field">
                    <h4>ปีสินค้า</h4>
                    <select required="required" name="product[prod_year]">
                        <option value="">--เลือก--</option>
                        <?php foreach ($years as $data) { ?>
                            <?php if ($product['prod_year'] == $data) { ?>
                                <option value="<?= $data ?>" selected><?= $data ?></option>
                            <?php } else { ?>
                                <option value="<?= $data ?>"><?= $data ?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="fields">                
                <div class="sixteen wide field">
                    <h4>รายละเอียด</h4>
                    <textarea id="mytextarea" name="product[prod_desc]" id="message" rows="7" placeholder="รายละเอียด"><?= $product['prod_desc'] ?></textarea>
                </div>
            </div>              
            <div class="ui buttons actions center aligned">
                <button class="ui button green" type="submit">บันทึก</button>
            </div>
        </form>
    </div>
    <h3 class="ui attached header left aligned" style="background-color: #F3542D;">
        ตารางแสดงข้อมูล
    </h3>
    <div class="ui attached segment">
        <table class="ui table celled striped dtl-table">
            <thead>
                <tr>
                    <th>รูป</th>
                    <th>ชื่อ</th>
                    <th>ราคา</th>
                    <th>สี</th>
                    <th>หมวดหมู่</th>
                    <th>ยี่ห้อ</th>
                    <th>ประเภท</th>
                    <th>ระบบ</th>
                    <th>เครื่อง</th>
                    <th>ปี</th>
                    <th>#</th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $index => $prod) { ?>
                    <tr>
                        <td class="ui image small"><img src="<?= $baseUrl ?>/uploads/<?= $prod['prod_picture'] ?>"/></td>
                        <td><?= $prod['prod_name'] ?></td>
                        <td><?= $prod['prod_price'] ?></td>
                        <td><?= $prod['prod_color'] ?></td>
                        <td><?= $prod['cat_name'] ?></td>
                        <td><?= $prod['bra_name'] ?></td>
                        <td><?= $prod['type_name'] ?></td>
                        <td><?= $prod['prod_gear'] ?></td>
                        <td><?= $prod['prod_engine'] ?></td>
                        <td><?= $prod['prod_year'] ?></td>
                        <td><a class="ui button blue" href="<?= Yii::app()->createUrl('/admin/MRGProduct', array('id' => $prod['prod_id'])) ?>">แก้ไข</a></td>
                        <td><a class="ui button red"  href="<?= Yii::app()->createUrl('/admin/MRGDeleteProduct', array('id' => $prod['prod_id'])) ?>" onclick="return confirm('ยืนยันการลบ')">ลบ</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>