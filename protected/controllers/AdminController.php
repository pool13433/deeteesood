<?php

class AdminController extends Controller {

    public $status = array(
        'active' => 'เปิด',
        'inactive' => 'ปิด',
    );
    public $gears = array(
        'auto' => 'อัตโนมัติ',
        'manual' => 'ธรรมดา'
    );

    public function __construct() {
        if (empty(Yii::app()->session['member'])) {
            $this->redirect(array('site/login'));
        }
    }

    public function actionDashboard() {
        if (empty(Yii::app()->session['member'])) {
            $this->redirect(array('/admin/login'));
        } else {
            $this->render('/admin/dashboard');
        }
    }

    public function actionLogout() {
        unset(Yii::app()->session['member']);
        $this->redirect(array('/admin/login'));
    }

    public function actionMRGModel($id = null) {
        if (empty($id)) {
            $model = new CarModel();
        } else {
            $model = CarModel::model()->findByPk($id);
        }
        $models = CarModel::model()->findAllByAttributes(array(
            'mod_status' => 'active'
                ), array(
            'order' => 'mod_date DESC'
        ));
        $brands = Brand::model()->findAllByAttributes(array('bra_status' => 'active'));
        $this->render('/admin/models', array(
            'models' => $models,
            'model' => $model,
            'brands' => $brands
        ));
    }

    public function actionMRGSaveModel() {
        if (!empty($_POST)) {
            $form = $_POST['model'];
            if (empty($form['mod_id'])) {
                $model = new CarModel();
            } else {
                $model = CarModel::model()->findByPk($form['mod_id']);
            }
            $model->mod_date = new CDbExpression('NOW()');
            $model->mod_desc = $form['mod_desc'];
            $model->mod_name = $form['mod_name'];
            $model->mod_status = $form['mod_status'];
            $model->bra_id = $form['bra_id'];
            if ($model->save()) {
                $this->setFlashMessage('SAVE', 'SUCCESS');
                $this->redirect(array('/admin/MRGModel'));
            } else {
                $this->setFlashMessage('SAVE', 'ERROR');
                $this->redirect(array('/admin/MRGModel/' . $form['mod_id']));
            }
        }
    }

    public function actionMRGSlide($id = null) {
        $slides = Yii::app()->db->createCommand()
                ->select('s.*')->from('slide s')->order('s.sli_date DESC')
                ->queryAll();
        if (empty($id)) {
            $slide = new Slide();
        } else {
            $slide = Slide::model()->findByPk($id);
        }
        $this->render('/admin/slides', array(
            'status' => $this->status,
            'slides' => $slides,
            'slide' => $slide
        ));
    }

    public function actionMRGProduct($id = null) {
        $years = $this->getYears();
        $gears = $this->gears;
        $brands = Yii::app()->db->createCommand()->select('b.*')->from('brand b')->where("b.bra_status = 'active'")->order('b.bra_name ASC')->queryAll();
        $models = Yii::app()->db->createCommand()->select('m.*')->from('car_model m')->where("m.mod_status = 'active'")->order('m.mod_name ASC')->queryAll();
        $types = Yii::app()->db->createCommand()->select('t.*')->from('car_type t')->where("t.type_status = 'active'")->order('t.type_name ASC')->queryAll();
        $categorys = Yii::app()->db->createCommand()->select('c.*')->from('category c')->where("c.cat_status = 'active'")->order('c.cat_name ASC')->queryAll();
        $products = Yii::app()->db->createCommand()
                ->select('p.*,b.*,c.*,t.*')
                ->from('product p')
                ->join('brand b', 'b.bra_id = p.bra_id')
                ->leftJoin('category c', 'c.cat_id = p.cat_id')
                ->leftJoin('car_type t', 't.type_id = p.type_id')
                ->order('p.prod_date DESC')
                ->queryAll();
        if (empty($id)) {
            $product = new Product();
        } else {
            $product = Product::model()->findByPk($id);
            $pictures = ProductAlbum::model()->findAllByAttributes(array(
                'prod_id' => $product['prod_id']
            ));
            $product['albums'] = $pictures;
        }



        $this->render('/admin/products', array(
            'brands' => $brands,
            'categorys' => $categorys,
            'products' => $products,
            'product' => $product,
            'status' => $this->status,
            'types' => $types,
            'years' => $years,
            'gears' => $gears,
            'models' => $models
        ));
    }

    public function actionMRGVideo($id = null) {
        $videos = Yii::app()->db->createCommand()
                ->select('v.*')->from('social_video v')->order('v.vid_date DESC')
                ->queryAll();
        if (empty($id)) {
            $video = new SocialVideo();
        } else {
            $video = SocialVideo::model()->findByPk($id);
        }
        $this->render('/admin/videos', array(
            'status' => $this->status,
            'videos' => $videos,
            'video' => $video
        ));
    }

    public function actionMRGBrand($id = null) {
        if (empty($id)) {
            $brand = new Brand();
        } else {
            $brand = Brand::model()->findByPk($id);
        }
        $brands = Brand::model()->findAllByAttributes(array(
            'bra_status' => 'active'
                ), array('order' => 'bra_date DESC'));
        $this->render('/admin/brands', array(
            'brands' => $brands,
            'brand' => $brand
        ));
    }

    public function actionMRGSaveBrand() {
        if (!empty($_POST)) {
            $form = $_POST['brand'];
            if (empty($form['bra_id'])) {
                $brand = new Brand();
            } else {
                $brand = Brand::model()->findByPk($form['bra_id']);
            }
            $brand->bra_date = new CDbExpression('NOW()');
            $brand->bra_desc = $form['bra_desc'];
            $brand->bra_name = $form['bra_name'];
            $brand->bra_status = $form['bra_status'];

            $file = CUploadedFile::getInstanceByName('picture');

            if ($file != NULL) {
                $fileNameNew = 'logo_' . date('Ymd_His') . '.' . $file->extensionName;
                $isUpload = $file->saveAs(Yii::getPathOfAlias('webroot') . '/uploads/brands/' . $fileNameNew);
                $brand->bra_picture = $fileNameNew;
            }

            if ($brand->save()) {
                $this->setFlashMessage('SAVE', 'SUCCESS');
                $this->redirect(array('/admin/MRGBrand'));
            } else {
                $this->setFlashMessage('SAVE', 'ERROR');
                $this->redirect(array('/admin/MRGBrand/' . $form['bra_id']));
            }
        }
    }

    public function actionMRGSaveVideo() {
        if (!empty($_POST)) {
            if (empty($_POST['vid_id'])) {
                $video = new SocialVideo();
            } else {
                $video = SocialVideo::model()->findByPk($_POST['vid_id']);
            }
            $video->vid_title = $_POST['vid_title'];
            $video->vid_desc = $_POST['vid_desc'];
            $video->vid_eventdate = $_POST['vid_eventdate'];
            $video->vid_url = $_POST['vid_url'];
            $video->vid_status = $_POST['vid_status'];
            $video->vid_date = new CDbExpression('NOW()');
            if ($video->save()) {
                $this->setFlashMessage('SAVE', 'SUCCESS');
            } else {
                $this->setFlashMessage('SAVE', 'ERROR');
            }
            $this->redirect(array('/admin/MRGVideo'));
        }
    }

    public function actionMRGSocial($id = null) {
        $socials = Yii::app()->db->createCommand()
                ->select("s.*,
                        (SELECT count(alb_id) FROM social_album a WHERE a.soc_id = s.soc_id) as cnt_picture,
                        DATE_FORMAT(soc_date,'%d-%m-%Y') as soc_date
                ")
                ->from('social s')->order('s.soc_date DESC')
                ->queryAll();

        if (empty($id)) {
            $social = new Social();
        } else {
            $social = Yii::app()->db->createCommand()
                    ->select("s.*")
                    ->from('social s')
                    ->where('s.soc_id =:id', array(':id' => $id))
                    ->queryRow();
            $social['albums'] = SocialAlbum::model()->findAllByAttributes(array(
                'soc_id' => $social['soc_id']
            ));
        }

        $this->render('/admin/socials', array(
            'status' => $this->status,
            'socials' => $socials,
            'social' => $social,
        ));
    }

    public function actionMRGSaveSocial() {
        if (!empty($_POST)) {
            if (empty($_POST['soc_id'])) {
                $social = new Social();
            } else {
                $social = Social::model()->findByPk($_POST['soc_id']);
            }
            $social->soc_date = new CDbExpression('NOW()');
            $social->soc_desc = $_POST['soc_desc'];
            $social->soc_eventdate = $_POST['soc_eventdate'];
            $social->soc_title = $_POST['soc_title'];
            $social->soc_status = $_POST['soc_status'];
            if ($social->save()) {
                $files = $_FILES['filUpload'];
                for ($i = 0; $i < count($_FILES["filUpload"]["name"]); $i++) {
                    if ($_FILES["filUpload"]["name"][$i] != "") {
                        $rootPATH = Yii::getPathOfAlias('webroot') . '/uploads/socials/';
                        $originPIC = $_FILES["filUpload"]["name"][$i];
                        $extPIC = pathinfo($originPIC, PATHINFO_EXTENSION);
                        $renamePIC = date('Ymd_His') . '_' . $i . '.' . $extPIC;
                        if (move_uploaded_file($_FILES["filUpload"]["tmp_name"][$i], $rootPATH . $renamePIC)) {
                            $album = new SocialAlbum();
                            $album->alb_date = new CDbExpression('NOW()');
                            $album->alb_picture = $renamePIC;
                            $album->soc_id = $social->soc_id;
                            if (!$album->save()) {
                                Yii::app()->user->setFlash('error' . $i, "บันทึกรูปภาพรูปที่ '.$i.' ไม่สำเร็จ");
                            }
                        }
                    }
                }
                $this->setFlashMessage('SAVE', 'SUCCESS');
            } else {
                $this->setFlashMessage('SAVE', 'ERROR');
            }
            $this->redirect(array('/admin/MRGSocial' . (empty($_POST['soc_id']) ? '' : '/' . $_POST['soc_id'])));
        }
    }

    public function actionMRGSaveSlide($id = null) {
        if (!empty($_POST)) {
            if (empty($_POST['sli_id'])) {
                $slide = new Slide();
            } else {
                $slide = Slide::model()->findByPk($_POST['sli_id']);
            }
            $slide->sli_date = new CDbExpression('NOW()');
            $slide->sli_desc = $_POST['sli_desc'];
            $slide->sli_title = $_POST['sli_title'];
            $slide->sli_status = $_POST['sli_status'];

            $file = CUploadedFile::getInstanceByName('picture');

            if ($file != NULL) {
                $fileNameNew = date('Ymd_His') . '.' . $file->extensionName;
                $isUpload = $file->saveAs(Yii::getPathOfAlias('webroot') . '/uploads/slides/' . $fileNameNew);
                $slide->sli_picture = $fileNameNew;
            }

            if ($slide->save()) {
                $this->setFlashMessage('SAVE', 'SUCCESS');
            } else {
                $this->setFlashMessage('SAVE', 'ERROR');
            }
            $this->redirect(array('/admin/MRGSlide' . (empty($_POST['sli_id']) ? '' : '/' . $_POST['sli_id'])));
        }
    }

    public function actionMRGSaveProduct() {
        if (!empty($_POST)) {
            $form = $_POST['product'];
            if (empty($form['prod_id'])) {
                $product = new Product();
            } else {
                $product = Product::model()->findByPk($form['prod_id']);
            }
            $product->prod_code = $form['prod_code'];
            $product->prod_color = $form['prod_color'];
            $product->prod_date = new CDbExpression('NOW()');
            $product->prod_desc = $form['prod_desc'];
            $product->prod_name = $form['prod_name'];
            $product->prod_price = $form['prod_price'];
            $product->prod_status = $form['prod_status'];
            $product->prod_year = $form['prod_year'];
            $product->prod_engine = $form['prod_engine'];
            $product->prod_gear = $form['prod_gear'];
            $product->mod_id = $form['mod_id'];
            $product->cat_id = $form['cat_id'];
            $product->bra_id = $form['bra_id'];
            $product->type_id = $form['type_id'];
            $file = CUploadedFile::getInstanceByName('picture');

            if ($file != NULL) {
                $fileNameNew = date('Ymd_His') . '.' . $file->extensionName;
                $isUpload = $file->saveAs(Yii::getPathOfAlias('webroot') . '/uploads/' . $fileNameNew);
                $product->prod_picture = $fileNameNew;
            }
            if ($product->save()) {
                $files = $_FILES['filUpload'];
                for ($i = 0; $i < count($_FILES["filUpload"]["name"]); $i++) {
                    if ($_FILES["filUpload"]["name"][$i] != "") {
                        $rootPATH = Yii::getPathOfAlias('webroot') . '/uploads/products/';
                        $originPIC = $_FILES["filUpload"]["name"][$i];
                        $extPIC = pathinfo($originPIC, PATHINFO_EXTENSION);
                        $renamePIC = date('Ymd_His') . '_' . $i . '.' . $extPIC;
                        if (move_uploaded_file($_FILES["filUpload"]["tmp_name"][$i], $rootPATH . $renamePIC)) {
                            $album = new ProductAlbum();
                            $album->alb_date = new CDbExpression('NOW()');
                            $album->alb_picture = $renamePIC;
                            $album->prod_id = $product->prod_id;
                            if (!$album->save()) {
                                Yii::app()->user->setFlash('error' . $i, "บันทึกรูปภาพรูปที่ '.$i.' ไม่สำเร็จ");
                            }
                        }
                    }
                }
                $this->setFlashMessage('SAVE', 'SUCCESS');
                $this->redirect(array('/admin/MRGProduct'));
            } else {
                $this->setFlashMessage('SAVE', 'ERROR');
                $this->redirect(array('/admin/MRGProduct/' . $form['prod_id']));
            }
        }
    }

    public function actionMRGDeleteProduct($id) {
        if (!empty($id)) {
            $product = Product::model()->findByPk($id);
            if ($product->delete()) {
                $rootPath = Yii::getPathOfAlias('webroot');
                $image = Yii::getPathOfAlias('webroot') . '/uploads/' . $product['prod_picture'];
                if (file_exists($image)) {
                    unlink($image);
                }
                $albums = ProductAlbum::model()->findAllByAttributes(array(
                    'prod_id' => $id
                ));
                foreach ($albums as $index => $data) {
                    $image = $rootPath . '/uploads/products/' . $data['alb_picture'];
                    if (file_exists($image)) {
                        unlink($image);
                    }
                }
                $this->setFlashMessage('DELETE', 'SUCCESS');
            } else {
                $this->setFlashMessage('DELETE', 'ERROR');
            }
            $this->redirect(array('/admin/MRGProduct'));
        }
    }

    public function actionMRGDeleteVideo($id) {
        if (!empty($id)) {
            if (SocialVideo::model()->deleteByPk($id)) {
                $this->setFlashMessage('DELETE', 'SUCCESS');
            } else {
                $this->setFlashMessage('DELETE', 'ERROR');
            }
            $this->redirect(array('/admin/MRGVideo'));
        }
    }

    public function actionMRGDeleteSlide($id) {
        if (!empty($id)) {
            $slide = Slide::model()->findByPk($id);
            if ($slide->delete()) {
                $image = Yii::getPathOfAlias('webroot') . '/uploads/slides/' . $slide['sli_picture'];
                if (file_exists($image)) {
                    unlink($image);
                }
                $this->setFlashMessage('DELETE', 'SUCCESS');
            } else {
                $this->setFlashMessage('DELETE', 'ERROR');
            }
            $this->redirect(array('/admin/MRGSlide'));
        }
    }

    public function actionMRGDeleteBrand($id) {
        if (!empty($id)) {
            $brand = Brand::model()->findByPk($id);
            if ($brand->delete()) {
                $image = Yii::getPathOfAlias('webroot') . '/uploads/brands/' . $brand['bra_picture'];
                if (file_exists($image)) {
                    unlink($image);
                }
                $this->setFlashMessage('DELETE', 'SUCCESS');
            } else {
                $this->setFlashMessage('DELETE', 'ERROR');
            }
            $this->redirect(array('/admin/MRGBrand'));
        }
    }

    public function actionMRGDeleteModel($id) {
        if (!empty($id)) {
            if (CarModel::model()->deleteByPk($id)) {
                $this->setFlashMessage('DELETE', 'SUCCESS');
            } else {
                $this->setFlashMessage('DELETE', 'ERROR');
            }
            $this->redirect(array('/admin/MRGModel'));
        }
    }

    public function actionMRGDeleteSocial($id) {
        if (!empty($id)) {
            if (Social::model()->deleteByPk($id)) {
                $albums = SocialAlbum::model()->findAllByAttributes(array(
                    'soc_id' => $id
                ));
                $rootPath = Yii::getPathOfAlias('webroot');
                foreach ($albums as $index => $data) {
                    $image = $rootPath . '/uploads/socials/' . $data['alb_picture'];
                    if (file_exists($image)) {
                        unlink($image);
                    }
                }
                $this->setFlashMessage('DELETE', 'SUCCESS');
            } else {
                $this->setFlashMessage('DELETE', 'ERROR');
            }
            $this->redirect(array('/admin/MRGSocial'));
        }
    }

    private function getYears($length = 30) {
        $year = date('Y');
        $years = array();
        for ($i = $year; $i > ($year - $length); $i--) {
            $years[] = $i;
        }
        return $years;
    }

    private function setFlashMessage($action, $status) {
        if ($action == 'SAVE') {
            if ($status == 'SUCCESS') {
                Yii::app()->user->setFlash('green', array(
                    'title' => "สถานะการบันทึกข้อมูล",
                    'message' => "บันทึกข้อมูลสำเร็จ"
                ));
            } else { // ERROR
                Yii::app()->user->setFlash('red', array(
                    'title' => "เกิดข้อผิดพลาด",
                    'message' => "ไม่สามารถบันทึกข้อมูลได้  กรุณาติดต่อเจ้าหน้าที่ดูแลระบบ"
                ));
            }
        } else { // DELETE
            if ($status == 'SUCCESS') {
                Yii::app()->user->setFlash('green', array(
                    'title' => "สถานะการลบข้อมูล",
                    'message' => "ลบข้อมูลสำเร็จ"
                ));
            } else { // ERROR
                Yii::app()->user->setFlash('red', array(
                    'title' => "เกิดข้อผิดพลาด",
                    'message' => "ไม่สามารถลบข้อมูลได้ กรุณาติดต่อเจ้าหน้าที่ดูแลระบบ"
                ));
            }
        }
    }

}
