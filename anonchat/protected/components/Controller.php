<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

    protected function DAO_insert_4($sql,$myname,$time,$toname)
    {
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":ausername",$myname,PDO::PARAM_STR);    // 同样
        $command->bindParam(":timea",$time,PDO::PARAM_STR);    // 同样
        $command->bindParam(":usera",$toname,PDO::PARAM_STR);    // 同样
        $command->execute();
    }

    protected function DAO_insert_3($sql,$myname,$time)
    {
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":username",$myname,PDO::PARAM_STR);    // 同样
        $command->bindParam(":timea",$time,PDO::PARAM_STR);    // 同样
        $command->execute();
    }

    protected function DAO_insert_2($sql,$myname)
    {
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":matchingID",$myname,PDO::PARAM_STR);    // 同样
        $command->execute();
    }

}