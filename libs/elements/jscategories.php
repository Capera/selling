<?php
/**
 * @package JS Categories for Joomla! 2.5
 * @author http://Thecoders.vn
 * @copyright (C) 2011- Thecoders.vn
 * @license http://www.gnu.org/licenseses/gpl-2.0.html GNU/GPL
**/

// no direct access
defined('_JEXEC') or die('Restricted access');
error_reporting(E_ALL & ~E_NOTICE);

class JFormFieldJSCategories extends JFormField
{

	public $type = 'jscategories';
	
	protected function getInput()
	{
		
		require_once (JPATH_SITE.DS.'components'.DS.'com_jshopping'.DS."lib".DS."factory.php"); 
		require_once (JPATH_SITE.DS.'components'.DS.'com_jshopping'.DS."lib".DS."functions.php");        
		   
		$db = &JFactory::getDBO();
		$jshopConfig = &JSFactory::getConfig();
		$jshopConfig->cur_lang = $jshopConfig->frontend_lang;
		
		$tmp = new stdClass();  
		$tmp->category_id = "";
		$tmp->name = JText::_('JALL');
		$categories_1  = array($tmp);
		$categories_select =array_merge($categories_1 , buildTreeCategory(0)); 
		$ctrl  =  $this->name ;      

		$value = empty($this->value) ? '' : $this->value;    
		
		return JHTML::_('select.genericlist', $categories_select, $ctrl, 'class="inputbox" id = "category_ordering" multiple="multiple" style="width: 123px;"', 'category_id', 'name', $value);	
	}
}