<?php $baseUrl = Yii::app()->baseUrl; ?>
<div class="ui container" ng-controller="MRGSlideController as vm">
    <h3 class="ui top attached header left aligned" style="background-color: #F3542D;">        
        <div class="ui big breadcrumb">
            <a class="section" href="<?= $baseUrl . '/admin/dashboard' ?>">เมนูการใช้งาน</a>
            <i class="right angle icon divider"></i>
            <div class="active section">จัดการ Slide</div>
        </div>
    </h3>
    <div class="ui attached segment form">
        <a class="ui button blue" href="<?= Yii::app()->createUrl('/admin/MRGSlide') ?>"><i class="plus icon"></i> สร้างใหม่</a>
        <div class="ui divider"></div>
        <form action="<?= Yii::app()->createUrl('/admin/MRGSaveSlide') ?>" class="ui form" id="my-dropzone" method="post" enctype="multipart/form-data">
           
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
            
            <?php
            $image = '/images/app/icon-upload_master.png';
            if (!empty($slide['sli_id'])) {
                $image = '/uploads/slides/' . $slide['sli_picture'];
            }
            ?>
            <div class="fields">
                <div class="four wide field">
                    <!--                    <h4>รูป</h4>-->
                    <img id="idImgPicture" class="ui image rounded fluid" src="<?= $baseUrl ?><?= $image ?>"/>
                    <input type="file" name="picture"  id="idInputPicture" <?= empty($slide['sli_id']) ? 'required' : '' ?> 
                           style="display: none;" accept="image/*"/>
                    <button class="ui button blue fluid" type="button" id="idBtnPicture">เลือกรูป</button>
                </div>
            </div>
            <div class="two fields">
                <div class="field">
                    <label>หัวข้อ</label>
                    <input type="hidden" name="sli_id" value="<?= $slide['sli_id'] ?>"/>
                    <input type="text" name="sli_title"  placeholder="หัวข้อ" required="required" value="<?= $slide['sli_title'] ?>"/>
                </div>
            </div>
            <div class="field">                
                <label>รายละเอียด</label>
                <textarea name="sli_desc" id="message" rows="5" required="required"placeholder="รายละเอียด"><?= $slide['sli_desc'] ?></textarea>
            </div>    
            <div class="five fields">
                <?= HTML::dropdownFieldStatus($slide['sli_status'], 'sli_status') ?>
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
                    <th>หัวข้อ</th>
                    <th>รายละเอียด</th>
                    <th>วันเพิ่ม</th>
                    <th>#</th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($slides as $index => $slide) { ?>
                    <tr>
                        <td class="ui image small"><img src="<?= $baseUrl ?>/uploads/slides/<?= $slide['sli_picture'] ?>"/></td>
                        <td><?= $slide['sli_title'] ?></td>
                        <td><?= $slide['sli_desc'] ?></td>
                        <td><?= $slide['sli_date'] ?></td>
                        <td><a class="ui button blue" href="<?= Yii::app()->createUrl('/admin/MRGSlide', array('id' => $slide['sli_id'])) ?>">แก้ไข</a></td>
                        <td><a class="ui button red"  href="<?= Yii::app()->createUrl('/admin/MRGDeleteSlide', array('id' => $slide['sli_id'])) ?>" onclick="return confirm('ยืนยันการลบ')">ลบ</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
