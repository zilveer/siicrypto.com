<?php
use app\models\Trades;
use lithium\storage\Session;
use app\extensions\action\Functions;
?>
<?php use lithium\core\Environment; 
if(substr(Environment::get('locale'),0,2)=="en"){$locale = "en";}else{$locale = Environment::get('locale');}
//if(strlen($locale>2)){$locale='en';}
// print_r(Environment::get('locale'));
// print_r($locale);
?>

<?php $user = Session::read('member'); ?>
<div class="navbar-header">
	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
		<span class="sr-only"><?=$t('Toggle navigation')?></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	</button>
	<a class="navbar-brand" href="/<?=$locale?>/"><img src="/img/logo.png" alt="SiiCrypto.com" title="SII Crypto"></a>
</div> <!-- navbar-header-->
<div class="navbar-collapse collapse">
	<?php 
			if(strtolower($this->_request->controller)=='ex'){ ?>
	
	<?php }else{?>
	
<?php }?>				
	<ul class="nav navbar-nav navbar-right">
		<li><a href='#' class='dropdown-toggle' data-toggle='dropdown' >Lang: <?=$locale?>
		 <i class='glyphicon glyphicon-chevron-down'></i>
		</a>
			<ul  class="dropdown-menu">
			<li style="font-size:13px;"><a href="#" onclick="ChangeLanguage('en','<?=$_SERVER['REQUEST_URI']?>');"><small>English</small></a></li>	
			<li style="font-size:13px;"><a href="#" onclick="ChangeLanguage('de','<?=$_SERVER['REQUEST_URI']?>');"><small>Deutsch</small></a></li>
			<li style="font-size:13px;"><a href="#" onclick="ChangeLanguage('es','<?=$_SERVER['REQUEST_URI']?>');"><small>Español</small></a></li>
			<li style="font-size:13px;"><a href="#" onclick="ChangeLanguage('hi','<?=$_SERVER['REQUEST_URI']?>');"><small>हिन्दी</small></a></li>
			</ul>
		</li>
		<?php if($user!=""){ ?>
		<li><a href='#' class='dropdown-toggle' data-toggle='dropdown' >
			<?=$t('Company')?> <i class='glyphicon glyphicon-chevron-down'></i>
			</a>
		
			<ul class="dropdown-menu">
					<li style="font-size:13px;"><a href="/<?=$locale?>/company/aboutus"><?=$t('About')?></a></li>	
					<li style="font-size:13px;"><a href="/<?=$locale?>/company/howitworks"><?=$t('How it works')?></a></li>	
<!--					<li style="font-size:13px;"><a href="/<?=$locale?>/company/funding"><?=$t('Funding')?></a></li>						-->
					<li style="font-size:13px;"><a href="/<?=$locale?>/company/security"><?=$t('Security & Risk')?></a></li>	
					<li style="font-size:13px;"><a href="/<?=$locale?>/company/verification"><?=$t('Verification')?></a></li>						
					<li style="font-size:13px;"><a href="/<?=$locale?>/company/privacy"><?=$t('Privacy & Terms')?></a></li>		
					<li style="font-size:13px;"><a href="/<?=$locale?>/company/press"><?=$t('Press')?></a></li>		
			</ul>
			</li>
			<li><a href='#' class='dropdown-toggle' data-toggle='dropdown' >
			<?=$user['username']?> <i class='glyphicon glyphicon-chevron-down'></i>&nbsp;&nbsp;&nbsp;
			</a>
			<ul class="dropdown-menu">
				<li><a href="/<?=$locale?>/users/settings"><i class="fa fa-gears"></i> <?=$t('Your Account')?></a></li>			
				<li><a href="/<?=$locale?>/ex/dashboard"><i class="fa fa-dashboard"></i> <?=$t('Dashboard')?></a></li>
				<li class="divider"></li>				
<?php 
$trades = Trades::find('all');
$currencies = array();
$VirtualCurr = array(); $FiatCurr = array();
foreach($trades as $tr){
	$first_curr = substr($tr['trade'],0,3);
	array_push($currencies,$first_curr);
	$second_curr = substr($tr['trade'],4,3);
	array_push($currencies,$second_curr);

		if($tr['FirstType']=='Virtual'){
			array_push($VirtualCurr,$first_curr);
			}else{
			array_push($VirtualCurr,$first_curr);
		}
		if($tr['SecondType']=='Virtual'){
			array_push($VirtualCurr,$second_curr);
			}else{
			array_push($FiatCurr,$second_curr);
		}
}	//for

	$currencies = array_unique($currencies);
	$VirtualCurr = array_unique($VirtualCurr);
	$FiatCurr = array_unique($FiatCurr);
	foreach($VirtualCurr as $currency){
		echo '<li><a href="/'.$locale.'/users/funding/'.$currency.'"><i class="fa fa-exchange"></i> Funding '.$currency.'</a></li>';
	}
	foreach($FiatCurr as $currency){
		echo '<li><a href="/'.$locale.'/users/funding_fiat/'.$currency.'"><i class="fa fa-exchange"></i> Funding '.$currency.'</a></li>';
	}

?>
				<li><a href="/logout"><i class="fa fa-power-off"></i> <?=$t('Logout')?></a></li>
			</ul>
			<?php }else{?>
			<li ><a href='#' class='dropdown-toggle' data-toggle='dropdown' >
			<?=$t('Company')?> <i class='glyphicon glyphicon-chevron-down'></i>
				</a>
			
				<ul class="dropdown-menu">
					<li style="font-size:13px;"><a href="/<?=$locale?>/company/aboutus"><?=$t('About')?></a></li>	
					<li style="font-size:13px;"><a href="/<?=$locale?>/company/howitworks"><?=$t('How it works')?></a></li>	
					<li style="font-size:13px;"><a href="/<?=$locale?>/company/funding"><?=$t('Funding')?></a></li>
					<li style="font-size:13px;"><a href="/<?=$locale?>/company/security"><?=$t('Security & Risk')?></a></li>	
					<li style="font-size:13px;"><a href="/<?=$locale?>/company/verification"><?=$t('Verification')?></a></li>						
					<li style="font-size:13px;"><a href="/<?=$locale?>/company/privacy"><?=$t('Privacy & Terms')?></a></li>		
					<li style="font-size:13px;"><a href="/<?=$locale?>/company/press"><?=$t('Press')?></a></li>		
				</ul>
				</li>
			<li><a href="/<?=$locale?>/login"><?=$t('Login')?></a></li>
			<li><a href="/<?=$locale?>/users/signup"><?=$t('Register')?>&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
			<?php }?>				
		</ul>
</div> <!-- navbar-collapse -->
<!-- Modal on default page-->