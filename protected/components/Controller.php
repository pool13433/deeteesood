<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController {

    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '//layouts/column1';

    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();

    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();

    protected function beforeAction($action) {
        $baseUrl = Yii::app()->baseUrl;
        if (parent::beforeAction($action)) {

            $cs = Yii::app()->clientScript;
            $cs->registerCssFile($baseUrl . '/css/zerogrid.css');
            $cs->registerCssFile($baseUrl . '/css/style.css');
            $cs->registerCssFile($baseUrl . '/css/responsiveslides.css');
            $cs->registerCssFile($baseUrl . '/font-awesome/css/font-awesome.min.css');
            $cs->registerCssFile($baseUrl . '/css/jquery.dataTables.min.css');
            $cs->registerCssFile($baseUrl . '/semantic-ui-css/semantic.css');
            //$cs->registerCssFile($baseUrl . '/node_modules/dropzone/dist/dropzone.css');
            $cs->registerCssFile($baseUrl . '/node_modules/gamma-gallery/css/gamma-gallery.css');
            $cs->registerCssFile($baseUrl . '/node_modules/gamma-gallery/css/noJS.css');
            $cs->registerCssFile($baseUrl . '/node_modules/tinymce/skins/lightgray/skin.min.css');
            //C:\xampp\htdocs\deeteesood\node_modules\tinymce\skins\lightgray\skin.min.css

            $cs->registerScriptFile($baseUrl . '/js/jquery.min.2.2.4.js', CClientScript::POS_END);
            $cs->registerScriptFile($baseUrl . '/js/script.js', CClientScript::POS_END);
            //$cs->registerScriptFile($baseUrl . '/js/jquery183.min.js', CClientScript::POS_END);
            $cs->registerScriptFile($baseUrl . '/js/responsiveslides.min.js', CClientScript::POS_END);
            $cs->registerScriptFile($baseUrl . '/js/jquery.dataTables.min.js', CClientScript::POS_END);
            $cs->registerScriptFile($baseUrl . '/semantic-ui-css/semantic.js', CClientScript::POS_END);
            
            $cs->registerScriptFile($baseUrl . '/node_modules/tinymce/tinymce.jquery.min.js', CClientScript::POS_END);
            $cs->registerScriptFile($baseUrl . '/node_modules/tinymce/tinymce.min.js', CClientScript::POS_END);   
            
             $cs->registerScriptFile($baseUrl . '/node_modules/gamma-gallery/js/modernizr.custom.70736.js', CClientScript::POS_END);          
            $cs->registerScriptFile($baseUrl . '/node_modules/gamma-gallery/js/jquery.masonry.min.js', CClientScript::POS_END);            
            $cs->registerScriptFile($baseUrl . '/node_modules/gamma-gallery/js/jquery.history.js', CClientScript::POS_END);            
            $cs->registerScriptFile($baseUrl . '/node_modules/gamma-gallery/js/js-url.min.js', CClientScript::POS_END);            
            $cs->registerScriptFile($baseUrl . '/node_modules/gamma-gallery/js/jquerypp.custom.js', CClientScript::POS_END);            
            $cs->registerScriptFile($baseUrl . '/node_modules/gamma-gallery/js/gamma.js', CClientScript::POS_END);            
            
            
            $cs->registerScriptFile($baseUrl . '/node_modules/angular/angular.min.js', CClientScript::POS_END);
            
            //$cs->registerScriptFile($baseUrl . '/node_modules/dropzone/dist/dropzone.js', CClientScript::POS_END);
            //$cs->registerScriptFile($baseUrl . '/node_modules/angular-dropzone/lib/angular-dropzone.js', CClientScript::POS_END);
            
            $cs->registerScriptFile($baseUrl . '/js/app/app.js', CClientScript::POS_END);
            $cs->registerScriptFile($baseUrl . '/js/app/app.factory.js', CClientScript::POS_END);
            $cs->registerScriptFile($baseUrl . '/js/app/app.directive.js', CClientScript::POS_END);
            $cs->registerScriptFile($baseUrl . '/js/app/app.service.js', CClientScript::POS_END);
            $cs->registerScriptFile($baseUrl . '/js/app/app.controller.js', CClientScript::POS_END);
            

            return true;
        }
        return false;
    }

}
