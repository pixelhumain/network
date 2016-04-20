<?php
/**
 * StatController.php
 *
 * @author: Childéric THOREAU <childericthoreau@gmail.com>
 * Date: 3/18/16
 * Time: 12:25 AM
 */
class StatController extends NetworkController {

	public function actions()
	{
	    return array(
	        'createglobalstat'    	 => 'citizenToolKit.controllers.stat.CreateGlobalStatAction',
	    );
	}
}