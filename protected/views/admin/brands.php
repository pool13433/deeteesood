
<?php $baseUrl = Yii::app()->baseUrl; ?>
<div class="ui container" ng-controller="MRGBrandController as vm">
    <h3 class="ui top attached header left aligned" style="background-color: #F3542D;">
        <div class="ui big breadcrumb">
            <a class="section" href="<?= $baseUrl . '/admin/dashboard' ?>">เมนูการใช้งาน</a>
            <i class="right angle icon divider"></i>
            <div class="active section">จัดการยี่ห้อ</div>
        </div>
    </h3>
    <div class="ui attached segment form">
        <a class="ui button blue" href="<?= Yii::app()->createUrl('/admin/MRGBrand') ?>"><i class="plus icon"></i> สร้างใหม่</a>
        <div class="ui divider"></div>
        <form action="<?= Yii::app()->createUrl('/admin/MRGSaveBrand') ?>" method="post" enctype="multipart/form-data">
           
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
                <?php
                $image = '/images/app/icon-upload_master.png';
                if (!empty($brand['bra_id'])) {
                    $image = '/uploads/brands/' . $brand['bra_picture'];
                }
                ?>
                <div class="four wide field">
                    <img id="idImgPicture" class="ui image rounded small" src="<?= $baseUrl ?><?= $image ?>"/>
                    <input type="file" name="picture"  id="idInputPicture" <?= !empty($slide['bra_id']) ? 'required' : '' ?> 
                           style="display: none;" accept="image/*"/>
                    <button class="ui button blue fluid" type="button" id="idBtnPicture">เลือกรูป</button>
                </div>
            </div>
            <div class="two fields">
                <div class="field">
                    <label>ชื่อ</label>
                    <input type="hidden" name="brand[bra_id]" value="<?= $brand['bra_id'] ?>"/>
                    <input type="text" name="brand[bra_name]"  placeholder="ชื่อ" required="required" value="<?= $brand['bra_name'] ?>"/>
                </div>
            </div>
            <div class="field">                
                <label>รายละเอียด</label>
                <textarea name="brand[bra_desc]" id="message" rows="5" required="required"placeholder="รายละเอียด"><?= $brand['bra_desc'] ?></textarea>
            </div>    
            <div class="five fields">
                <?= HTML::dropdownFieldStatus($brand['bra_status'], 'brand[bra_status]') ?>
            </div>

            <div class="ui buttons actions center aligned">
                <button class="ui button green submit" type="submit" ng-click="vm.uploadGallery()">บันทึก</button>
            </div>
        </form>        
    </div>
    <h2 class="ui attached header left aligned" style="background-color: #F3542D;">
        ตารางแสดงข้อมูล
    </h2>
    <div class="ui attached segment">
        <table class="ui table celled striped dtl-table">
            <thead>
                <tr class="center aligned">
                    <th>รูป</th>
                    <th>ชื่อ</th>
                    <th>รายละเอียด</th>
                    <th>วันที่</th>
                    <th>#</th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($brands as $index => $brand) { ?>
                    <tr>
                        <td class="ui image small"><img src="<?= $baseUrl ?>/uploads/brands/<?= $brand['bra_picture'] ?>"/></td>
                        <td><?= $brand['bra_name'] ?></td>
                        <td><?= $brand['bra_desc'] ?></td>
                        <td><?= $brand['bra_date'] ?></td>
                        <td><a class="ui button blue" href="<?= Yii::app()->createUrl('/admin/MRGBrand', array('id' => $brand['bra_id'])) ?>">แก้ไข</a></td>
                        <td><a class="ui button red"  href="<?= Yii::app()->createUrl('/admin/MRGDeleteBrand', array('id' => $brand['bra_id'])) ?>" onclick="return confirm('ยืนยันการลบ')">ลบ</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>