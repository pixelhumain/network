<?php
/**
 * DirectoryController.php
 *
 *
 * @author: Childéric THOREAU 
 * Date: 24/03/2016
 */
class DirectoryController extends NetworkController {

	public function actions()
	{
	    return array(
	    	'simply'       	=> 'citizenToolKit.controllers.directory.DefaultAction'
	    );
	}
}