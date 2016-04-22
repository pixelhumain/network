<?php 
	$cs = Yii::app()->getClientScript();

	$cssAnsScriptFilesModule = array(
		//'js/svg/tonfichier.js'
	);
	HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);

?>


<center>
<br><br><br>
<i class="fa fa-book fa-5x" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<i class="fa fa-ellipsis-h fa-5x" aria-hidden="true"></i>&nbsp;
<i class="fa fa-chevron-right fa-5x" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<i class="fa fa-map fa-5x" aria-hidden="true"></i>
</center>