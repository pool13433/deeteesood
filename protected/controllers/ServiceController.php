<?php

class ServiceController extends Controller {

    public function __construct($id, $module = null) {
        header('Content-type: application/json');
    }

    public function actionGetProducts() {
        //var_dump($_POST['car']);
        //exit();
        $criteria = array(
            'price_sort' => (empty($_POST['price_sort']) ? 'ASC' : $_POST['price_sort']),
            'brand' => (empty($_POST['brand']) ? '' : $_POST['brand']),
            'color' => (empty($_POST['color']) ? '' : $_POST['color']),
            'price_begin' => (empty($_POST['price_begin']) ? '' : $_POST['price_begin']),
            'price_end' => (empty($_POST['price_end']) ? '' : $_POST['price_end']),
            'cars' => (empty($_POST['car']) ? '' : $_POST['car']),
            'year' => (empty($_POST['year']) ? '' : $_POST['year']),
            'model' => (empty($_POST['model']) ? '' : $_POST['model']),
            'gear' => (empty($_POST['gear']) ? '' : $_POST['gear'])
        );

        // *********** Filter Option ****************

        $categorys = Yii::app()->db->createCommand()
                ->select('c.*')
                ->from('category c')
                ->where("c.cat_status = 'active'")
                ->order('c.cat_name')
                ->queryAll();
        foreach ($categorys as $index => $cat) {
            $command = Yii::app()->db->createCommand()
                    ->select("p.*,b.*,DATE_FORMAT(p.prod_date,'%d-%m-%Y') as prod_date")
                    ->from('product p')
                    ->where('p.cat_id =:catId and p.prod_status =:status', array(
                ':catId' => $cat['cat_id'],
                ':status' => 'active'
            ));
            if (!empty($criteria['brand'])) {
                $command->andWhere('p.bra_id =:brand', array(':brand' => $criteria['brand']));
            }
            if (!empty($criteria['color'])) {
                $command->andWhere('p.prod_color =:color', array(':color' => $criteria['color']));
            }
            if (!empty($criteria['year'])) {
                $command->andWhere('p.prod_year =:year', array(':year' => $criteria['year']));
            }
            if (!empty($criteria['model'])) {
                $command->andWhere('p.mod_id =:model', array(':model' => $criteria['model']));
            }
            if (!empty($criteria['gear'])) {
                $command->andWhere('p.prod_gear =:gear', array(':gear' => $criteria['gear']));
            }
            if (!empty($criteria['price_begin']) && !empty($criteria['price_end'])) {
                $command->andWhere('p.prod_price >:begin AND p.prod_price <:end', array(
                    ':begin' => $criteria['price_begin'],
                    ':end' => $criteria['price_end'],
                ));
            }
            if (!empty($criteria['cars'])) {
                $cars = array_map('intval', $criteria['cars']);
                //$command->andWhere('p.type_id IN (:inCar)', array(':inCar' => implode(",", $cars)));
                $command->andWhere(array('in', 'p.type_id', $cars));
            }
            $command->leftJoin('brand b', 'b.bra_id = p.bra_id');
            if ($criteria['price_sort'] == 'DESC') {
                $command->order('p.prod_price DESC');
            } else {
                $command->order('p.prod_price ASC');
            }
            $products = $command->queryAll();
            $categorys[$index]['products'] = $products;
        }
        echo CJSON::encode($categorys);
    }

    public function actionGetProductsByBrand() {
        $response = array();
        if (!empty($_POST)) {
            $brandId = $_POST['brand'];
            $products = Product::model()->findAllByAttributes(array(
                'bra_id' => $brandId
                    ), array(
                'limit' => '5'
            ));
            $brand = Brand::model()->findByPk($brandId);
            $response['products'] = $products;
            $response['brand'] = $brand;
        }
        echo CJSON::encode($response);
    }

    public function actionGetCarModels() {
        $response = array();
        if (!empty($_POST['brand'])) {
            $response = CarModel::model()->findAllByAttributes(array(
                'bra_id' => $_POST['brand']
            ));
        }
        echo CJSON::encode($response);
    }

    public function actionGetCarBrands() {
        $response = Brand::model()->findAll(array('order' => 'bra_name'));
        echo CJSON::encode($response);
    }

    public function actionDeleteSocialPicture($id) {
        if (!empty($id)) {
            $social = SocialAlbum::model()->findByPk($id);
            if ($social->delete()) {
                $image = Yii::getPathOfAlias('webroot') . '/uploads/socials/' . $social['alb_picture'];
                if (file_exists($image)) {
                    unlink($image);
                }
                echo CJSON::encode(array('status' => true, 'message' => 'ok'));
            }
        }
    }

    public function actionDeleteProductPicture($id) {
        if (!empty($id)) {
            if (ProductAlbum::model()->deleteByPk($id)) {
                echo CJSON::encode(array('status' => true, 'message' => 'ok'));
            }
        }
    }

    public function actionSaveProductRating() {
        if (!empty($_POST)) {
            $ratType = $_POST['rat_type']; // VIEW,STAR
            $prodId = $_POST['prod_id'];
            $ratLevel = (empty($_POST['rat_level']) ? '' : $_POST['rat_level']);
            $clientIp = $_POST['client_ip'];
//            $rating = ProductRating::model()->findByAttributes(array(
//                'rat_ip' => $clientIp,
//                'rat_type' => $ratType,
//                'prod_id' => $prodId,
//                'rat_date' => date('Y-m-d')
//            ));
            $rating = Yii::app()->db->createCommand()
                    ->select('count(r.rat_id)')->from('product_rating r')
                    ->where('r.rat_type =:type AND r.rat_ip =:ip AND r.prod_id =:prod AND r.rat_date = CURDATE() ', array(
                        ':type' => $ratType,
                        ':ip' => $clientIp,
                        ':prod' => $prodId
                    ))
                    ->queryScalar();
            if ($rating == 0) {
                $rating = new ProductRating();
                $rating->rat_date = new CDbExpression('NOW()');
                $rating->rat_ip = $clientIp;
                $rating->rat_level = $ratLevel;
                $rating->rat_type = $ratType;
                $rating->prod_id = $prodId;

                if ($rating->save()) {
                    $res = array('status' => true, 'message' => 'OK');
                } else {
                    $res = array('status' => false, 'message' => 'FAIL');
                }
            } else {
                $res = array('status' => true, 'message' => 'เคยบันทึกไปแล้ว');
            }
            echo CJSON::encode($res);
        }
    }

}
