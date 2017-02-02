<?php

class SiteController extends Controller {

    public $status = array(
        'active' => 'เปิด',
        'inactive' => 'ปิด',
    );
    public $gears = array(
        'auto' => 'อัตโนมัติ',
        'manual' => 'ธรรมดา'
    );

    public function actionLogin() {
        if (empty($_POST)) {
            $this->render('/login');
        } else {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $member = Member::model()->findByAttributes(array(
                'mem_username' => $username,
                'mem_password' => md5($password)
            ));
            if ($member) {
                Yii::app()->session['member'] = $member;
                $this->redirect(array('/admin/dashboard'));
            } else {
                Yii::app()->user->setFlash('error', "ไม่พบข้อมูลผู้ใช้งาน");
                $this->render('/login');
            }
        }
    }

    public function actionIndex() {
        $products = Yii::app()->db->createCommand("
                    SELECT p.*,FORMAT(p.prod_price, 0) as prod_price FROM (
                            SELECT 
                                p.* ,                                
                                (SELECT COUNT(rat_id) FROM product_rating r WHERE  r.prod_id = p.prod_id AND r.rat_type = 'VIEW') as sum_view,
                                (SELECT IFNULL(SUM(rat_level),0) FROM product_rating r WHERE  r.prod_id = p.prod_id AND r.rat_type = 'STAR') as sum_star
                            FROM product p  
                            JOIN category c ON c.cat_id = p.cat_id
                            WHERE p.prod_status = 'active'  AND c.cat_status = 'active'
                      ) as p
                      ORDER BY p.sum_star DESC
                      LIMIT 0,9
                ")
                ->queryAll();

        $videos = SocialVideo::model()->findAllByAttributes(array('vid_status' => 'active'));
        $socials = Yii::app()->db->createCommand()
                ->select("s.*,a.*")
                ->from('social s')
                ->join('social_album a', 'a.soc_id = s.soc_id')
                ->where("s.soc_status = 'active' ")
                ->group('a.soc_id')
                ->having('min(a.alb_id)')
                ->order('s.soc_date DESC')
                ->limit('3')
                ->queryAll();

        $slides = Yii::app()->db->createCommand()
                ->select('s.*')
                ->from('slide s')
                ->where("s.sli_status = 'active' ")
                ->order('s.sli_date DESC')
                ->limit('3')
                ->queryAll();

        $webRootPath = Yii::getPathOfAlias('webroot') . '/uploads/brands/';
        $logos = array();
        if (file_exists($webRootPath)) {
            $fileNames = array_diff(scandir($webRootPath), array('..', '.'));
            foreach ($fileNames as $fileName) {
                $logos[] = $fileName;
            }
        }
        $brands = Yii::app()->db->createCommand()
                ->select('b.*')->from('brand b')
                ->where('b.bra_picture <> \'\' ')
                ->order('b.bra_id ASC')
                ->queryAll();

        $categorys = Yii::app()->db->createCommand()
                ->select('c.*')
                ->from('category c')
                ->where("c.cat_status = 'active'")
                ->queryAll();

        $this->render('/site/index', array(
            'products' => $products,
            'videos' => $videos,
            'socials' => $socials,
            'slides' => $slides,
            'brands' => $brands,
            'logos' => $logos,
            'categorys' => $categorys
        ));
    }

    public function actionArchive() {
        $this->render('/site/archive');
    }

    public function actionAbout() {
        $this->render('/site/about');
    }

    public function actionSocial($id = null) {
        if (empty($id)) {
            $socials = Yii::app()->db->createCommand()
                    ->select('s.*,(
                                    SELECT alb_picture 
                                    FROM social_album a 
                                    WHERE a.soc_id = s.soc_id
                                    ORDER BY a.soc_id ASC
                                    LIMIT 0,1
                                ) as first_image')
                    ->from('social s')
                    ->where("s.soc_status = 'active' ")
                    ->order('s.soc_date DESC')
                    ->queryAll();
            $this->render('/site/social', array(
                'socials' => $socials
            ));
        } else {
            $social = Social::model()->findByPk($id);
            $social_picture = Yii::app()->db->createCommand()
                    ->select('a.*')->from('social_album a')
                    ->where('a.soc_id =:id', array(':id' => $id))
                    ->queryAll();
            $this->render('/site/social_detail', array(
                'social' => $social,
                'pictures' => $social_picture
            ));
        }
    }

    public function actionContact() {
        $this->render('/site/contact');
    }

    public function actionDetail($id) {
        $product = Yii::app()->db->createCommand()
                ->select("p.*,b.*,c.*,t.*,m.*,CONCAT('$', FORMAT(p.prod_price, 2)) as prod_price
                        ,DATE_FORMAT(p.prod_date,'%d-%m-%Y') as prod_date
                        ")
                ->from('product p')
                ->join('brand b', 'b.bra_id = p.bra_id')
                ->leftJoin('category c', 'c.cat_id = p.cat_id')
                ->leftJoin('car_type t', 't.type_id = p.type_id')
                ->leftJoin('car_model m', 'm.mod_id = p.mod_id')
                ->where('p.prod_id =:prodId', array(':prodId' => $id))
                ->queryRow();
        $pictures = ProductAlbum::model()->findAllByAttributes(array(
            'prod_id' => $id
        ));
        $this->render('/site/product_detail', array(
            'product' => $product,
            'pictures' => $pictures
        ));
    }

    public function actionProduct() {

// *********** Filter Option ****************
        $years = $this->getYears();
        $colors = Yii::app()->db->createCommand()
                ->selectDistinct('p.prod_color')->from('product p')
                ->order('p.prod_color ASC')
                ->queryAll();
        $brands = Yii::app()->db->createCommand()
                ->select('b.*')->from('brand b')
//->where("b.bra_status = 'acrive' ")
                ->order('b.bra_name ASC')
                ->queryAll();
        $types = Yii::app()->db->createCommand()
                ->select('c.*')->from('car_type c')
//->where("c.type_status = 'acrive' ")
                ->order('c.type_name ASC')
                ->queryAll();
        $sort = array(
            'ASC' => 'น้อย => มาก',
            'DESC' => 'มาก => น้อย'
        );
        $gears = $this->gears;
// *********** Filter Option ****************
        $condition = array(
            'brand' => (empty($_GET['brand']) ? '' : $_GET['brand']),
            'model' => (empty($_GET['model']) ? '' : $_GET['model'])
        );

        $this->render('/site/product', array(
            'colors' => $colors,
            'brands' => $brands,
            'sortOption' => $sort,
            'types' => $types,
            'years' => $years,
            'gears' => $gears,
            'condition' => $condition
        ));
    }

    private function getYears($length = 30) {
        $year = date('Y');
        $years = array();
        for ($i = $year; $i > ($year - $length); $i--) {
            $years[] = $i;
        }
        return $years;
    }

}
