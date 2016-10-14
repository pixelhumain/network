<?php 
	$cssAnsScriptFilesModule = array('/css/docs/docs.css','/js/docs/docs.js');
	HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);
?>

<div class="panel-heading border-light center text-dark partition-white radius-10">
    <span class=" text-red homestead tpl_title"><i class="fa fa-binoculars"></i> Documentation</span>
    <br/>
    <span class="tpl_shortDesc">
		La Métropole Européenne de Lille a fait appel au commun Communecter.org et la <a href="http://hauts.tiers-lieux.org/" target="_blank">communauté des tiers-lieux</a> pour réaliser une cartographie des tiers-lieux sur son territoire.<br/>
		Cette réalisation permet d'avoir une vue cartographique et un annuaire des tiers-lieux (fablab, coworking, espace artistique, cafe solidaire, etc) sur l'ensemble de la métropole lilloise.<br/>
		Vous pouvez ajouter un tiers-lieux <a href="https://www.communecter.org/#organization.addorganizationform" target="_blank">ici</a> (n’oubliez pas d’ajouter le tag « tierslieux » pour que le projet apparaisse sur la cartograhie).<br/>
		Vous pouvez modifier les informations en les recherchant sur le site <a href="https://communecter.org" target="_blank">communecter.org</a> puis en modifiant les informations. Pour améliorer le filtrage, rajouter les tags aux projets correspondant aux filtres de la cartographie.<br/>
		Bonne navigation à vous dans l'univers des espaces partagés !!<br/>
    </span>  
    <span class="tpl_shortDesc"> Tout ce qu'il faut savoir sur le réseau Communecter ...
    </span>
</div>

<style type="text/css">
    .tpl_title{font-size: 38px!important;}
</style>
<div class="col-sm-12 ">

    <div class="panel panel-white ">
        
        <div class="col-md-10 col-md-offset-1 col-sm-12 col-sm-offset-0 no-padding">
        	<?php $this->renderPartial("../docs/docPattern/player"); ?>
        </div>
        
        <div class="panel-body tpl_content">
           
        <div class="col-sm-12" style="margin-top:30px;margin-bottom:30px; " >
	        <div class="col-sm-6 ">
		        <div class="panel panel-white user-list ">
					<div class="panel-heading border-light">
						<a class="btn-chapter lbh " href="#default.view.page.elements.dir.docs">
							<h4 class="panel-title homestead text-red"><i class="fa fa-cubes"></i> 4 Elements</h4>
						</a>
					</div> 
					<div class="panel-body">
						<b>Communecter</b> est construit sur 4 éléments clefs, permettant de modéliser les acteurs et l'acitivté d'un territoire 
						<br/>
				        <ul class="points">
				        	<li><i class='fa fa-arrow-right'></i> <a class="lbh" href="#default.view.page.elements.dir.docs?slide=person">Citoyen</a> </li>
				        	<li><i class='fa fa-arrow-right'></i> <a class="lbh" href="#default.view.page.elements.dir.docs?slide=organisation">Organisation</a></li>
				        	<li><i class='fa fa-arrow-right'></i> <a class="lbh" href="#default.view.page.elements.dir.docs?slide=events">Événement</a></li>
				        	<li><i class='fa fa-arrow-right'></i> <a class="lbh" href="#default.view.page.elements.dir.docs?slide=projects">Projet</a></li>
				        </ul>
				    </div>
				</div>
			</div>
			<div class="col-sm-6 hidden">
		        <div class="panel panel-white user-list ">
					<div class="panel-heading border-light">
						<a class="btn-chapter lbh" href="#default.view.page.pourquoi.dir.docs">
							<h4 class="panel-title homestead text-red"><i class="fa fa-cogs"></i> Pour quoi faire ?</h4>
						</a>
					</div> 
					<div class="panel-body">
						
				        <ul class="points">
				        	<li><i class='fa fa-arrow-right'></i> Connaître les alternatives locales </li>
				        	<li><i class='fa fa-arrow-right'></i> Discuter et débattre localement </li>
				        	<li><i class='fa fa-arrow-right'></i> Participer au conseil citoyen </li>
				        	<li><i class='fa fa-arrow-right'></i> Faire connaître ses projets, et trouver du soutient</li>
				        	<li><i class='fa fa-arrow-right'></i> Devenir un acteur responsable de son territoire</li>
				        </ul>
				    </div>
				</div>
			</div>
			
			<div class="col-sm-6">
		        <div class="panel panel-white user-list ">
					<div class="panel-heading border-light">
						<a class="btn-chapter lbh" href="#default.view.page.modules.dir.docs">
							<h4 class="panel-title homestead text-red"><i class="fa fa-cube"></i> Modules</h4>
						</a>
					</div> 
					<div class="panel-body">
						
				        <ul class="points">
				        	<li><i class='fa fa-arrow-right'></i> <a  class="lbh" href="#default.view.page.modules.dir.docs?slide=news">Fil d'actualités</a> </li>
				        	<li><i class='fa fa-arrow-right'></i> <a  class="lbh" href="#default.view.page.modules.dir.docs?slide=sig">Système d'Information Géographique (SIG)</a> </li>
				        	<li><i class='fa fa-arrow-right'></i> <a  class="lbh" href="#default.view.page.modules.dir.docs?slide=annuaire">Annuaire</a></li>
				        	<li><i class='fa fa-arrow-right'></i> <a  class="lbh" href="#default.view.page.modules.dir.docs?slide=agenda">Agenda</a></li>
				        	<li><i class='fa fa-arrow-right'></i> <a  class="lbh" href="#default.view.page.modules.dir.docs?slide=dda">Espace coopératif</a></li>
				        </ul>
				    	<a href="#news.index.type.pixels" class="lbh btn btn-default"><i class='fa fa-lightbulb-o'></i> Proposer une idée de module</a>
				    </div>
				</div>
			</div>

		</div>
		<div class="col-sm-12">
			
			
			<div class="col-sm-6 hidden">
		        <div class="panel panel-white user-list ">
					<div class="panel-heading border-light">
						<a class="btn-chapter lbh" href="#default.view.page.comprendre.dir.docs">
							<h4 class="panel-title homestead text-red"><i class="fa fa-question-circle"></i> Comprendre </h4>
						</a>
					</div> 
					<div class="panel-body">
			        <ul class="points">
			        	<li><i class='fa fa-arrow-right'></i> <a  class="lbh" href="#default.view.page.ocdb.dir.docs">OCDB : Open Common Database</a> </li>
						<li><i class='fa fa-arrow-right'></i> <a  class="lbh" href="#default.view.page.openSystem.dir.docs">Open System (Code Social)</a></li>
						<li><i class='fa fa-arrow-right'></i> <a  class="lbh" href="#default.view.page.import.dir.docs">Import Export API</a></li>
						<i class='fa fa-arrow-right'></i> <a  class="lbh" href="#default.view.page.explain">Les gros mots</a>
						<li class="hidden"><i class='fa fa-arrow-right'></i> <a  class="lbh" href="#default.view.page.financement.dir.docs">Financement</a> </li>
			        </ul>
			    </div>
				</div>
			</div>
			
		</div>	
		<div class="col-sm-12">
			
			<div class="col-sm-6">
		        <div class="panel panel-white user-list ">
					<div class="panel-heading border-light">
						<a class="btn-chapter lbh" href="#default.view.page.presentation.dir.docs">
							<h4 class="panel-title homestead text-red"><i class="fa fa-tv"></i> Présentation</h4>
						</a>
					</div> 
					<div class="panel-body">
						
				        <ul class="points">
				        	<li><i class='fa fa-arrow-right'></i><a target="_blank" href="https://www.communecter.org/doc/Outils au service d'une villle intelligente et citoyenne V.0.1.pdf"> Outils au service d'une villle intelligente et citoyenne V.0.1</a> </li>
				        	<li><i class='fa fa-arrow-right'></i><a target="_blank" href="https://www.communecter.org/doc/Présentation Courte de Communecter - OPEN ATLAS.pdf"> Présentation Courte</a> </li>
				        	<li><i class='fa fa-arrow-right'></i><a target="_blank" href="https://www.communecter.org/doc/Présentation simplifiée de Communecter - OPEN ATLAS.pdf"> Présentation simplifiée</a> </li>
				        	<li><i class='fa fa-arrow-right'></i><a target="_blank" href="https://www.communecter.org/doc/Innovation Sociétale.pdf"> Innovation Sociétale</a> </li>
				        	<li><i class='fa fa-arrow-right'></i><a target="_blank" href="https://www.communecter.org/doc/Plaquette Offre Carrefour des communes.pdf"> Plaquette Offre Carrefour des communes</a> </li>
				        </ul>
				    </div>
				</div>
			</div>
	
			<div class="col-sm-6 ">
		        <div class="panel panel-white user-list ">
					<div class="panel-heading border-light">
						<a class="btn-chapter lbh" href="#default.view.page.communication.dir.docs">
							<h4 class="panel-title homestead text-red"><i class="fa fa-bullhorn"></i> Communication </h4>
						</a>
					</div> 
					<div class="panel-body">
				        <ul class="points">
				        	<li><i class='fa fa-arrow-right'></i> <a  class="lbh" href="#default.view.page.communication.dir.docs?slide=affiches">Nos Affiches</a> </li>
				        	<li><i class='fa fa-arrow-right'></i> <a  class="lbh" href="#default.view.page.communication.dir.docs?slide=video">Nos Vidéos</a> </li>
				        </ul>
				    </div>
				</div>
			</div>
			
		</div>
		<!-- </div>
		<div class="col-sm-12"> -->
		<div class="col-sm-12">	
			<div class="col-sm-6">
		        <div class="panel panel-white user-list ">
					<div class="panel-heading border-light">
						<a class="btn-chapter lbh" href="#default.view.page.rd.dir.docs">
							<h4 class="panel-title homestead text-red"><i class="fa fa-comments"></i> Développement</h4>
						</a>
					</div> 
					<div class="panel-body">
						
				        <ul class="points">
				        	<li><i class='fa fa-arrow-right'></i> <a  class="lbh" href="#default.view.page.rd.dir.docs?slide=roadmap">Roadmap</a>  </li>
				        	<li><i class='fa fa-arrow-right'></i> <a  class="lbh" href="#default.view.page.architecture.dir.docs?slide=roadmap">Architecture</a>  </li>
				        	<li class="hidden"><i class='fa fa-arrow-right'></i> <a  class="lbh" href="#default.view.page.fin.dir.docs|slides">Wish Liste</a> </li>
				        </ul>
				    </div>
				</div>
			</div>

			<div class="col-sm-6 hidden">
		        <div class="panel panel-white user-list ">
					<div class="panel-heading border-light">
						<a class="btn-chapter lbh" href="#default.view.page.histoire.dir.docs">
							<h4 class="panel-title homestead text-red"><i class="fa fa-comments"></i> L'Histoire</h4>
						</a>
					</div> 
					<div class="panel-body">
						
				        <ul class="points">
				        	<li><i class='fa fa-arrow-right'></i> Avant </li>
				        	<li><i class='fa fa-arrow-right'></i> <a  class="lbh" href="#default.view.page.firstPitch.dir.docs|slides">en 2012</a> </li>
				        	<li><i class='fa fa-arrow-right'></i> L'équipe et les communecteurs</li>
				        	<li><i class='fa fa-arrow-right'></i> La structure </li>
				        	<li><i class='fa fa-arrow-right'></i> <a  class="lbh" href="#default.view.page.fin.dir.docs|slides">des chiffres</a> </li>
				        </ul>
				    </div>
				</div>
			</div>
	    </div>

        <br>
        <div class="col-sm-12 ">
        <a style="display: block;" class="text-extra-large bg-red pull-right tooltips radius-5 padding-10 homestead lbh" href="#default.view.page.elements.dir.docs">c'est Parti <i class="fa fa-arrow-right"></i> </a></div></div>
    </div>
</div>

<script type="text/javascript">
jQuery(document).ready(function() {
	bindLBHLinks();
	$(".panel-group .panel-default").fadeOut();
	$html="<div class='panel panel-back padding-5'>"+
					"<ol class='breadcrumbVertical'><li><a href='javascript:;' onclick='window.location = \""+window.location.pathname+"\";'><i class='fa fa-map-marker'> </i> Retour à la cartographie</a></li>"+
					"</div>";
	$(".panel-group").append($html);
 // setTitle("<span class='text-red'><a href=''>Revenir à la carto</a></span>","connectdevelop", "Communecter : La Doc");
});
</script>

