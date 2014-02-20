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

jimport('joomla.application.component.model');

class modBannerSliderHelper
{
	static function &getList(&$params)
	{
		jimport('joomla.application.component.model');
		JModel::addIncludePath(JPATH_ROOT.'/components/com_banners/models', 'BannersModel');
		$document	= JFactory::getDocument();
		$app		= JFactory::getApplication();
		$keywords	= explode(',', $document->getMetaData('keywords'));

		$model = JModel::getInstance('Banners', 'BannersModel', array('ignore_request'=>true));
		$model->setState('filter.client_id', (int) $params->get('cid'));
		$model->setState('filter.category_id', $params->get('catid', array()));
		$model->setState('list.limit', (int) $params->get('count', 1));
		$model->setState('list.start', 0);
		$model->setState('filter.ordering', $params->get('ordering'));
		$model->setState('filter.tag_search', $params->get('tag_search'));
		$model->setState('filter.keywords', $keywords);
		$model->setState('filter.language', $app->getLanguageFilter());

		$banners = $model->getItems();
		$model->impress();

		return $banners;
	}
	
	/**
	 * Get name of current template
	 */
	public static function getTemplate()
	{
		$mainframe = JFactory::getApplication();
		return $mainframe->getTemplate();
	}
	
	
	/**
	 * Load media files
	 */
	public static function loadMediaFiles($params, $module, $theme='')
	{
		$mainframe 	= JFactory::getApplication();
		$template 	= self::getTemplate();
		$document 	= &JFactory::getDocument();
		$url_base 	= JURI::base() . 'modules/' . $module->module . '/assets/';
		
		$document->addScript($url_base . 'script.js');
		
		//load style of module
		if(file_exists(JPATH_BASE . DS . 'templates/' . $template . '/css/' . $module->module . '.css')) {
			$document->addStyleSheet(JURI::base() . 'templates/' . $template . '/css/' . $module->module . '.css');		
		}
		else {
			$document->addStyleSheet($url_base . 'style.css');
		}
	}
}
