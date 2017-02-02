<?php $baseUrl = Yii::app()->baseUrl; ?>
<section class="content-box">
    <div class="zerogrid">
        <div class="row">
            <form id="ff" method="get" action="<?= Yii::app()->createUrl('/site/product') ?>">
                <h3>ค้นหาสินค้า</h3>
                <label class="row">
                    <div class="col-1-5">
                        <label>ช่วง ราคาสินค้า จาก</label>
                        <input type="number" name="price_begin"  placeholder="ราคาต่ำสุด" value="<?= $criteria['price_begin'] ?>"/>
                    </div>
                    <div class="col-1-5">
                        <label>ถึง</label>
                        <input type="number" name="price_end"  placeholder="ราคาสูงสุด" value="<?= $criteria['price_end'] ?>"/>
                    </div>
                    <div class="col-1-5">
                        <label>เรียงราคา จาก</label>
                         <select name="price_sort">
                            <?php foreach ($sortOption as $index => $sort) { ?>
                                <?php if ($criteria['price_sort'] == $index) { ?>
                                    <option value="<?= $index ?>" selected><?= $sort ?></option>
                                <?php } else { ?>
                                    <option value="<?= $index ?>"><?= $sort ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                </label>
                <label class="row">
                    <div class="col-1-5">
                        <label>ยี่ห้อ</label>
                        <select name="brand">
                            <option value="">--ทั้งหมด--</option>
                            <?php foreach ($brands as $index => $brand) { ?>
                                <?php if ($criteria['brand'] == $brand['bra_id']) { ?>
                                    <option value="<?= $brand['bra_id'] ?>" selected><?= $brand['bra_name'] ?></option>
                                <?php } else { ?>
                                    <option value="<?= $brand['bra_id'] ?>"><?= $brand['bra_name'] ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-1-5">
                        <label>สี</label>
                        <select name="color">
                            <option value="">--ทั้งหมด--</option>
                            <?php foreach ($colors as $index => $color) { ?>
                                <?php if ($criteria['color'] == $color['prod_color']) { ?>
                                    <option value="<?= $color['prod_color'] ?>" selected><?= $color['prod_color'] ?></option>
                                <?php } else { ?>
                                    <option value="<?= $color['prod_color'] ?>"><?= $color['prod_color'] ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                </label>
                <label class="row">
                    <button type="submit">ค้นหา</button>
                </label>
            </form>
        </div>
    </div>
</section>
<?php foreach ($categorys as $index => $cat) { ?>
    <section class="content-box box-1">
        <div class="zerogrid">
            <div class="header">
                <h2 class="heading">
                    <span><?= $cat['cat_name'] ?></span>
                </h2>
                <p><?= $cat['cat_desc'] ?></p>
            </div>
            <div class="row">
                <?php foreach ($cat['products'] as $index => $prod) { ?>
                    <div class="col-1-5">
                        <div class="wrap-col item" style="max-height: 300px;">
                            <div class="zoom-container">
                                <img src="<?= $baseUrl ?>/uploads/<?= $prod['prod_picture'] ?>"/>
                            </div>
                            <div class="item-content">
                                <span><?= $prod['prod_name'] ?> (<?= $prod['bra_name'] ?>)</span>
                                <p>ราคา <?= $prod['prod_price'] ?> บาท, สี <?= $prod['prod_color'] ?></p>
                                <a class="btn" href="single.html">More Details</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
<?php } ?>
