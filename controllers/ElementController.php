<?php
/**
 * EventController.php
 *
 * tous ce que propose le PH en terme de gestion d'evennement
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 15/08/13
 */
class ElementController extends NetworkController {
    const moduleTitle = "Élément";
    
  protected function beforeAction($action) {
    parent::initPage();
    return parent::beforeAction($action);
  }
  public function actions()
  {
      return array(
            'detail'                => 'citizenToolKit.controllers.element.DetailAction',
            'getalllinks'                => 'citizenToolKit.controllers.element.GetAllLinksAction',
            'directory'                => 'citizenToolKit.controllers.element.DirectoryAction'
        );
  }
}