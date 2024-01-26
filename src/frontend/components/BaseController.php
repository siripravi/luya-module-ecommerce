<?php

/**
 * User: TheCodeholic
 * Date: 12/12/2020
 * Time: 7:04 PM
 */

namespace siripravi\ecommerce\frontend\components;

use common\models\CartItem;
use frontend\models\Search;

/**
 * Class Controller
 *
 * @author  
 * @package 
 */
class BaseController extends \luya\cms\frontend\base\Controller
{
    // public $layout = '@app/themes/escapeVelocity/views/layouts/detail';
    public $secClass = "container my-2 my-md-3";

    public $bannerTitle = "Some Title";


    public function beforeAction($action)
    {   
        if (!parent::beforeAction($action)) {
            return false;
        }
    
       echo "BEFORE ACTION";
    
        return true; //
    }

    public function beforeRender($event)
    {       
        if (!parent::beforeRender($action)) {
            return false;
        }
    
       echo "BEFORE ACTION"; die;
    
        return true; //
        
    }
}
