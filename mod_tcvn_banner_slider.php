<?php
/*
# ------------------------------------------------------------------------
# TCVN Banner Slider for Joomla 2.5
# ------------------------------------------------------------------------
# Copyright(C) 2008-2012 www.Thecoders.vn. All Rights Reserved.
# @license http://www.gnu.org/licenseses/gpl-3.0.html GNU/GPL
# Author: Thecoders.vn
# Websites: http://Thecoders.com
# ------------------------------------------------------------------------
*/

// no direct access
defined('_JEXEC') or die;

// Include the syndicate functions only once
require_once dirname(__FILE__).'/helper.php';

$headerText	= trim($params->get('header_text'));
$footerText	= trim($params->get('footer_text'));
$mwidth		= $params->get('width', 180);
$mheight	= $params->get('height', 'auto');
$delay		= $params->get('delay', 5000);
$random		= $params->get('random', 1);
$fadein		= $params->get('fadein', 1);
$bInSlide	= $params->get('bannerInSlide', 1) ? $params->get('bannerInSlide') : 1;

require_once JPATH_ROOT . '/administrator/components/com_banners/helpers/banners.php';
BannersHelper::updateReset();
$list = &modBannerSliderHelper::getList($params);
modBannerSliderHelper::loadMediaFiles($params, $module);
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

require JModuleHelper::getLayoutPath('mod_tcvn_banner_slider', $params->get('layout', 'default'));
?>
<script type="text/javascript">
	new TCVNBannerSlider("tcvn-banner-slider<?php echo $module->id; ?>", <?php echo $delay; ?>, <?php echo $random; ?>, <?php echo $fadein; ?>);
</script>