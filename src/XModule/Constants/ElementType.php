<?php

namespace XModule\Constants;

use \XModule\Constants\Enum;

abstract class ElementType extends Enum
{
  const TABS = 'tabs';
  const list = 'list';
  const DETAIL = 'detail';
  const TOOLBAR = 'toolbar';
  const TOOLBAR_BUTTON = 'toolbarButton';
  const TOOLBAR_LABEL = 'toolbarLabel';
  const TOOLBAR_MENU = 'toolbarMenu';
  const LINK_BUTTON = 'linkButton';
  const BUTTON_CONTAINER = 'buttonContainer';
  const COLLAPSIBLE = 'collapsible';
  const CONTAINER = 'container';
  const FORM = 'form';
  const FORM_BUTTON = 'formButton';
  const HEADING = 'heading';
  const TABLE = 'table';
  const IMAGE = 'image';
  const INPUT = 'input';
  const HTML = 'html';
  const GRID = 'grid';
  const GRID_ITEM = 'gridItem';
  const AJAX_CONTENT = 'ajaxContent';
  const MULTICOLUMN = 'multicolumn';
}
