<?php 
namespace Core;

class H {

    public static function dnd($data=[], $die = true){
        echo "<pre>";
        var_dump($data);
        echo "</pre>";
        if($die) {
            die;
        }
    }

    public static function isCurrentPage($page) {
        global $currentPage;
        if(!empty($page) && strpos($page, ':id') > -1) {
            $page = str_replace(":id", "", $page);
            return strpos($currentPage, $page) > -1;
        }
        return $page == $currentPage;
    }

    public static function activeClass($page, $class = '') {
        $active = self::isCurrentPage($page);
        $class = $active? $class . " active" : $class;
        return $class;
    }

    public static function navItem($link, $label, $isDropdownItem = false) {
        $active = self::isCurrentPage($link);
        $class = self::activeClass($link, 'nav-item');
        $linkClass = $isDropdownItem? 'dropdown-item' : 'nav-link';
        $linkClass .= $active && $isDropdownItem? " active" : "";
        $link = ROOT . $link;
        $html = "<li class=\"{$class}\">";
        $html .= "<a class=\"{$linkClass}\" href=\"{$link}\" >{$label}</a>";
        $html .= "</li>";
        return $html;
    }
    
}