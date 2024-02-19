<?php

namespace App\Http;

use Nwidart\Menus\Presenters\Presenter;

class AdminlteCustomPresenter extends Presenter
{
    /**
     * {@inheritdoc}.
     */
    public function getOpenTagWrapper()
    {
        return PHP_EOL.'<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">'.PHP_EOL;
    }

    /**
     * {@inheritdoc}.
     */
    public function getCloseTagWrapper()
    {
        return PHP_EOL.'</ul>'.PHP_EOL;
    }

    /**
     * {@inheritdoc}.
     */ 
     public function getMenuWithoutDropdownWrapper($item)
    {
        return '<li class="nav-item'.$this->getActiveState($item).'">'.
            '<a href="'.$item->getUrl().'" class="nav-link" '.$item->getAttributes().'>'.
                $item->getIcon().' <p>'.$item->title.'</p>'.
            '</a>'.
            '</li>'.PHP_EOL;
    }
    /**
     * {@inheritdoc}.
     */
    public function getActiveState($item, $state = ' class="active"')
    {
        return $item->isActive() ? $state : null;
    }

    /**
     * Get active state on child items.
     *
     * @param $item
     * @param  string  $state
     * @return null|string
     */
    public function getActiveStateOnChild($item, $state = 'active')
    {
        return $item->hasActiveOnChild() ? $state : null;
    }

    /**
     * {@inheritdoc}.
     */
    public function getDividerWrapper()
    {
        return '<li class="divider"></li>';
    }

    /**
     * {@inheritdoc}.
     */
    public function getHeaderWrapper($item)
    {
        return '<li class="nav-header">'.$item->title.'</li>';
    }

    /**
     * {@inheritdoc}.
     */
    public function getMenuWithDropDownWrapper($item)
    {
        return '<li class="nav-item has-treeview'.$this->getActiveStateOnChild($item).'">'.
            '<a href="#" class="nav-link" '.$item->getAttributes().'>'.
                $item->getIcon().' <p>'.$item->title.'<i class="fas fa-angle-left right"></i></p>'.
            '</a>'.
            '<ul class="nav nav-treeview">'.
                $this->getChildMenuItems($item).
            '</ul>'.
            '</li>'.PHP_EOL;
    }

    /**
     * Get multilevel menu wrapper.
     *
     * @param  \Nwidart\Menus\MenuItem  $item
     * @return string`
     */
    public function getMultiLevelDropdownWrapper($item)
    {
        return '<li class="nav-item has-treeview'.$this->getActiveStateOnChild($item).'">'.
            '<a href="#" class="nav-link" '.$item->getAttributes().'>'.
                $item->getIcon().' <p>'.$item->title.'<i class="fas fa-angle-left right"></i></p>'.
            '</a>'.
            '<ul class="nav nav-treeview">'.
                $this->getChildMenuItems($item).
            '</ul>'.
            '</li>'.PHP_EOL;
    }
}
