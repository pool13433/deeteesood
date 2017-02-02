
<?php $baseUrl = Yii::app()->baseUrl; ?>
<div class="ui container" ng-controller="MRGVideoController as vm">
    <h3 class="ui top attached header left aligned" style="background-color: #F3542D;">        
        <div class="ui big breadcrumb">
            <a class="section" href="<?= $baseUrl . '/admin/dashboard' ?>">เมนูการใช้งาน</a>
            <i class="right angle icon divider"></i>
            <div class="active section">จัดการวิดีโอต่างๆ</div>
        </div>
    </h3>
    <div class="ui attached segment form">
        <a class="ui button blue" href="<?= Yii::app()->createUrl('/admin/MRGVideo') ?>"><i class="plus icon"></i> สร้างใหม่</a>
        <div class="ui divider"></div>
        <form action="<?= Yii::app()->createUrl('/admin/MRGSaveVideo') ?>" class="ui form" method="post" enctype="multipart/form-data">

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

            <div class="two fields">
                <div class="field">
                    <label>หัวข้อ</label>
                    <input type="hidden" name="vid_id" value="<?= $video['vid_id'] ?>"/>
                    <input type="text" name="vid_title"  placeholder="หัวข้อ" required="required" value="<?= $video['vid_title'] ?>"/>
                </div>
                <div class="field">
                    <label>วันที่ทำกิจกรรม (dd-mm-yyyy; ex 20-12-2016)</label>
                    <input type="text" name="vid_eventdate"  placeholder="วันที่ทำกิจกรรม" 
                           required="required" value="<?= $video['vid_eventdate'] ?>"/>
                </div>
            </div>
            <div class="field">                
                <label>รายละเอียด</label>
                <textarea name="vid_desc" id="message" rows="5" required="required"placeholder="รายละเอียด"><?= $video['vid_desc'] ?></textarea>
            </div>    
            <div class="field">
                <label>Youtube URL</label>
                <input type="text" name="vid_url"  placeholder="Youtube URL" required="required" value="<?= $video['vid_url'] ?>"/>
            </div>
            <div class="five fields">
                <?= HTML::dropdownFieldStatus($video['vid_status'], 'vid_status') ?>
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
                    <th>หัวข้อ</th>
                    <th>รายละเอียด</th>
                    <th>วันทำกิจกรรม</th>
                    <th>URL</th>
                    <th>วันเพิ่ม</th>
                    <th>#</th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($videos as $index => $video) { ?>
                    <tr>
                        <td><?= $video['vid_title'] ?></td>
                        <td><?= $video['vid_desc'] ?></td>
                        <td><?= $video['vid_eventdate'] ?></td>
                        <td><?= $video['vid_url'] ?></td>
                        <td><?= $video['vid_date'] ?></td>
                        <td><a class="ui button blue" href="<?= Yii::app()->createUrl('/admin/MRGVideo', array('id' => $video['vid_id'])) ?>">แก้ไข</a></td>
                        <td><a class="ui button red"  href="<?= Yii::app()->createUrl('/admin/MRGDeleteVideo', array('id' => $video['vid_id'])) ?>" onclick="return confirm('ยืนยันการลบ')">ลบ</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>