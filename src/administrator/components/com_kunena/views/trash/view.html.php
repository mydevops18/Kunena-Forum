<?php
/**
 * Kunena Component
 *
 * @package     Kunena.Administrator
 * @subpackage  Views
 *
 * @copyright   (C) 2008 - 2018 Kunena Team. All rights reserved.
 * @license     https://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link        https://www.kunena.org
 **/
defined('_JEXEC') or die();

/**
 * Trash view for Kunena backend
 *
 * @since  K1.0
 */
class KunenaAdminViewTrash extends KunenaView
{
	/**
	 *
	 */
	function displayDefault()
	{
		$this->setLayout($this->state->get('layout'));
		$this->trash_items       = $this->get('Trashitems');
		$this->pagination        = $this->get('Navigation');
		$this->view_options_list = $this->get('ViewOptions');

		$this->sortFields          = $this->getSortFields();
		$this->sortDirectionFields = $this->getSortDirectionFields();

		$this->filterSearch   = $this->escape($this->state->get('list.search'));
		$this->filterTitle    = $this->escape($this->state->get('filter.title'));
		$this->filterTopic    = $this->escape($this->state->get('filter.topic'));
		$this->filterCategory = $this->escape($this->state->get('filter.category'));
		$this->filterIp       = $this->escape($this->state->get('filter.ip'));
		$this->filterAuthor   = $this->escape($this->state->get('filter.author'));
		$this->filterDate     = $this->escape($this->state->get('filter.date'));
		$this->filterActive   = $this->escape($this->state->get('filter.active'));
		$this->listOrdering   = $this->escape($this->state->get('list.ordering'));
		$this->listDirection  = $this->escape($this->state->get('list.direction'));

		$this->setToolBarDefault();
		$this->display();
	}

	/**
	 *
	 */
	function displayPurge()
	{
		$this->purgeitems    = $this->get('PurgeItems');
		$this->md5Calculated = $this->get('Md5');

		$this->setToolBarPurge();
		$this->display();
	}

	/**
	 *
	 */
	protected function setToolBarDefault()
	{
		// Set the titlebar text
		JToolBarHelper::title(JText::_('COM_KUNENA') . ': ' . JText::_('COM_KUNENA_TRASH_MANAGER'), 'trash');
		JToolBarHelper::spacer();
		JToolBarHelper::custom('restore', 'checkin.png', 'checkin_f2.png', 'COM_KUNENA_TRASH_RESTORE');
		JToolBarHelper::divider();
		JToolBarHelper::custom('purge', 'trash.png', 'trash_f2.png', 'COM_KUNENA_TRASH_PURGE');
		JToolBarHelper::spacer();

		$help_url  = 'https://docs.kunena.org/en/manual/backend/trashbin';
		JToolBarHelper::help('COM_KUNENA', false, $help_url);
	}

	/**
	 *
	 */
	protected function setToolBarPurge()
	{
		// Set the titlebar text
		JToolBarHelper::title(JText::_('COM_KUNENA'), 'kunena.png');
		JToolBarHelper::spacer();
		JToolBarHelper::custom('purge', 'delete.png', 'delete_f2.png', 'COM_KUNENA_DELETE_PERMANENTLY');
		JToolBarHelper::spacer();
		JToolBarHelper::cancel();
		JToolBarHelper::spacer();

		$help_url  = 'https://docs.kunena.org/en/manual/backend/trashbin';
		JToolBarHelper::help('COM_KUNENA', false, $help_url);
	}

	/**
	 *
	 * @return array
	 */
	protected function getSortFields()
	{
		$sortFields = array();

		if ($this->state->get('layout') == 'topics')
		{
			$sortFields[] = JHtml::_('select.option', 'title', JText::_('COM_KUNENA_TRASH_TITLE'));
			$sortFields[] = JHtml::_('select.option', 'category', JText::_('COM_KUNENA_TRASH_CATEGORY'));
			$sortFields[] = JHtml::_('select.option', 'author', JText::_('COM_KUNENA_TRASH_AUTHOR'));
			$sortFields[] = JHtml::_('select.option', 'time', JText::_('COM_KUNENA_TRASH_DATE'));
		}
		else
		{
			$sortFields[] = JHtml::_('select.option', 'title', JText::_('COM_KUNENA_TRASH_TITLE'));
			$sortFields[] = JHtml::_('select.option', 'topic', JText::_('COM_KUNENA_MENU_TOPIC'));
			$sortFields[] = JHtml::_('select.option', 'category', JText::_('COM_KUNENA_TRASH_CATEGORY'));
			$sortFields[] = JHtml::_('select.option', 'ip', JText::_('COM_KUNENA_TRASH_IP'));
			$sortFields[] = JHtml::_('select.option', 'author', JText::_('COM_KUNENA_TRASH_AUTHOR'));
			$sortFields[] = JHtml::_('select.option', 'time', JText::_('COM_KUNENA_TRASH_DATE'));
		}

		$sortFields[] = JHtml::_('select.option', 'id', JText::_('JGRID_HEADING_ID'));

		return $sortFields;
	}

	/**
	 *
	 * @return array
	 */
	protected function getSortDirectionFields()
	{
		$sortDirection = array();
		$sortDirection[] = JHtml::_('select.option', 'asc', JText::_('JGLOBAL_ORDER_ASCENDING'));
		$sortDirection[] = JHtml::_('select.option', 'desc', JText::_('JGLOBAL_ORDER_DESCENDING'));

		return $sortDirection;
	}
}
