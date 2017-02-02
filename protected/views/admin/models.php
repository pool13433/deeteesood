
<?php $baseUrl = Yii::app()->baseUrl; ?>
<div class="ui container">
    <h3 class="ui top attached header left aligned" style="background-color: #F3542D;">        
        <div class="ui big breadcrumb">
            <a class="section" href="<?= $baseUrl . '/admin/dashboard' ?>">เมนูการใช้งาน</a>
            <i class="right angle icon divider"></i>
            <div class="active section">จัดการวิดีโอต่างๆ</div>
        </div>
    </h3>
    <div class="ui attached segment form">
        <a class="ui button blue" href="<?= Yii::app()->createUrl('/admin/MRGModel') ?>"><i class="plus icon"></i> สร้างใหม่</a>
        <div class="ui divider"></div>
        <form action="<?= Yii::app()->createUrl('/admin/MRGSaveModel') ?>" method="post">
            
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
                    <label>ชื่อ</label>
                    <input type="hidden" name="model[mod_id]" value="<?= $model['mod_id'] ?>"/>
                    <input type="text" name="model[mod_name]"  placeholder="ชื่อ" required="required" value="<?= $model['mod_name'] ?>"/>
                </div>
                <div class="field">
                    <label>หัวข้อ</label>
                    <select required="required" name="model[bra_id]" id="ddBrand">
                        <option value="">--เลือก--</option>
                        <?php foreach ($brands as $index => $brand) { ?>
                            <?php if ($brand['bra_id'] == $model['bra_id']) { ?>
                                <option value="<?= $brand['bra_id'] ?>" selected><?= $brand['bra_name'] ?></option>
                            <?php } else { ?>
                                <option value="<?= $brand['bra_id'] ?>"><?= $brand['bra_name'] ?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="field">                
                <label>รายละเอียด</label>
                <textarea name="model[mod_desc]" id="message" rows="5" required="required"placeholder="รายละเอียด"><?= $model['mod_desc'] ?></textarea>
            </div>    
            <div class="five fields">
                <?= HTML::dropdownFieldStatus($model['mod_status'], 'model[mod_status]') ?>
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
                    <th>ชื่อ</th>
                    <th>รายละเอียด</th>
                    <th>วันที่</th>
                    <th>#</th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($models as $index => $model) { ?>
                    <tr>
                        <td><?= $model['mod_name'] ?></td>
                        <td><?= $model['mod_desc'] ?></td>
                        <td><?= $model['mod_date'] ?></td>
                        <td><a class="ui button blue" href="<?= Yii::app()->createUrl('/admin/MRGModel', array('id' => $model['mod_id'])) ?>">แก้ไข</a></td>
                        <td><a class="ui button red"  href="<?= Yii::app()->createUrl('/admin/MRGDeleteModel', array('id' => $model['mod_id'])) ?>" onclick="return confirm('ยืนยันการลบ')">ลบ</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>