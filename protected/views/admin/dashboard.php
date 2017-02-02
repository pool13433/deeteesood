<div class="ui container">
    <h2 class="ui top attached header left aligned clearing" style="background-color: #F3542D;">
        เมนูการใช้งาน        
        <a class="ui right floated button inverted blue" href="<?= Yii::app()->createUrl('admin/logout') ?>">ออกจากระบบ</a>
    </h2>
    <div class="ui attached segment">
        <div class="ui cards three stackable">
            <div class="card">
                <div class="content">
                    <div class="header ui left aligned">จัดการสินค้า</div>
                    <div class="meta">เพิ่ม แก้ไข ลบ</div>
                </div>
                <a class="ui bottom attached button blue"  href="<?= Yii::app()->createUrl('admin/MRGProduct') ?>">
                    <i class="car icon"></i>
                    เข้าใช้งาน
                </a>
            </div>
            
            <div class="card">
                <div class="content">
                    <div class="header ui left aligned">จัดการยี่ห้อ</div>
                    <div class="meta">เพิ่ม แก้ไข ลบ</div>
                </div>
                <a class="ui bottom attached button brown" href="<?= Yii::app()->createUrl('admin/MRGBrand') ?>">
                    <i class="youtube icon"></i>
                    เข้าใช้งาน
                </a>
            </div>
            
            <div class="card">
                <div class="content">
                    <div class="header ui left aligned">จัดการรุ่นสินค้า</div>
                    <div class="meta">เพิ่ม แก้ไข ลบ</div>
                </div>
                <a class="ui bottom attached button pink" href="<?= Yii::app()->createUrl('admin/MRGModel') ?>">
                    <i class="youtube icon"></i>
                    เข้าใช้งาน
                </a>
            </div>
            
            <span class="ui divider"></span>            
            <div class="card">
                <div class="content">
                    <div class="header ui left aligned">จัดการภาพกิจกรรม</div>
                    <div class="meta">เพิ่ม แก้ไข ลบ</div>
                </div>
                <a class="ui bottom attached button teal" href="<?= Yii::app()->createUrl('admin/MRGSocial') ?>">
                    <i class="trophy icon"></i>
                    เข้าใช้งาน
                </a>
            </div>
            <div class="card">
                <div class="content">
                    <div class="header ui left aligned">จัดการสไลด์</div>
                    <div class="meta">เพิ่ม แก้ไข ลบ</div>
                </div>
                <a class="ui bottom attached button orange" href="<?= Yii::app()->createUrl('admin/MRGSlide') ?>">
                    <i class="sitemap icon"></i>
                    เข้าใช้งาน
                </a>
            </div>
            <div class="card">
                <div class="content">
                    <div class="header ui left aligned">จัดการวิดีโอ</div>
                    <div class="meta">เพิ่ม แก้ไข ลบ</div>
                </div>
                <a class="ui bottom attached button olive" href="<?= Yii::app()->createUrl('admin/MRGVideo') ?>">
                    <i class="youtube icon"></i>
                    เข้าใช้งาน
                </a>
            </div>

        </div>
    </div>
</div>