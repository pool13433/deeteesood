<?php $baseUrl = Yii::app()->baseUrl; ?>
<div class="ui container" ng-controller="MRGSocialController as vm">
    <h3 class="ui top attached header left aligned" style="background-color: #F3542D;">        
        <div class="ui big breadcrumb">
            <a class="section" href="<?= $baseUrl . '/admin/dashboard' ?>">เมนูการใช้งาน</a>
            <i class="right angle icon divider"></i>
            <div class="active section">จัดการภาพกิจกรรม</div>
        </div>
    </h3>
    <div class="ui attached segment form">
        <a class="ui button blue" href="<?= Yii::app()->createUrl('/admin/MRGSocial') ?>"><i class="plus icon"></i> สร้างใหม่</a>
<!--         <form action="<?= Yii::app()->createUrl('/admin/MRGSaveSocial') ?>" class="dropzone" id="my-dropzone" method="post" enctype="multipart/form-data">
           <div class="fallback">
               <input name="file" type="file" multiple />
           </div>
       </form>-->
        <div class="ui divider"></div>
        <form action="<?= Yii::app()->createUrl('/admin/MRGSaveSocial') ?>" class="ui form" id="my-dropzone" method="post" enctype="multipart/form-data">
            
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
            
            <div class="field">
                <label>รูปกิจกรรม</label>
                <input type="file" multiple name="filUpload[]" id="socialInput" style="display: none;" accept="image/*"/>
                <button class="ui button pink" type="button" ng-click="vm.btnSocialClick()">เลือกรูปภาพ (เลือกรูปได้มากกว่า 1 รูปโดยเวลาเลือกให้กดปุ่ม Ctrl ค้างไว้ขณะเลือก)</button>
                <div class="ui small images">
                    <img class="ui image" id="image{{$index}}"  ng-repeat="image in vm.imageList">
                    <div class="ui divider">รูปเดิม <i class="arrow down icon"></i></div>
                    <?php foreach ($social['albums'] as $index => $picture) { ?>
                        <div class="original-picture">
                            <img class="ui image mini" src="<?= $baseUrl ?>/uploads/socials/<?= $picture['alb_picture'] ?>">
                            <button class="ui label mini" type="button" ng-click="vm.trashPic($event,<?= $picture['alb_id'] ?>)"><i class="remove icon red"></i></button>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="two fields">
                <div class="field">
                    <label>หัวข้อ</label>
                    <input type="hidden" name="soc_id" value="<?= $social['soc_id'] ?>"/>
                    <input type="text" name="soc_title"  placeholder="หัวข้อ" required="required" value="<?= $social['soc_title'] ?>"/>
                </div>
                <div class="field">
                    <label>วันที่ทำกิจกรรม (dd-mm-yyyy; ex 20-12-2016)</label>
                    <input type="text" name="soc_eventdate"  placeholder="วันที่ทำกิจกรรม" 
                           required="required" value="<?= $social['soc_eventdate'] ?>"/>
                </div>
            </div>
            <div class="field">                
                <label>รายละเอียด</label>
                <textarea name="soc_desc" id="message" rows="5" required="required"placeholder="รายละเอียด"><?= $social['soc_desc'] ?></textarea>
            </div>    
            <div class="five fields">
                <?=HTML::dropdownFieldStatus($social['soc_status'], 'soc_status')?>
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
                    <th>จำนวนรูป</th>
                    <th>หัวข้อ</th>
                    <th>รายละเอียด</th>
                    <th>วันทำกิจกรรม</th>
                    <th>วันเพิ่ม</th>
                    <th>#</th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($socials as $index => $prod) { ?>
                    <tr>
                        <td class="center aligned"><?= $prod['cnt_picture'] ?> รูป</td>
                        <td><?= $prod['soc_title'] ?></td>
                        <td><?= $prod['soc_desc'] ?></td>
                        <td><?= $prod['soc_eventdate'] ?></td>
                        <td><?= $prod['soc_date'] ?></td>
                        <td><a class="ui button blue" href="<?= Yii::app()->createUrl('/admin/MRGSocial', array('id' => $prod['soc_id'])) ?>">แก้ไข</a></td>
                        <td><a class="ui button red"  href="<?= Yii::app()->createUrl('/admin/MRGDeleteSocial', array('id' => $prod['soc_id'])) ?>" onclick="return confirm('ยืนยันการลบ')">ลบ</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>