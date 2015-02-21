<?php
// src/Blogger/BlogBundle/Twig/Extensions/BloggerBlogExtension.php

namespace PlanIt\UserBundle\Twig\Extensions;

class UserExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('offsetDate', array($this, 'offsetDateFilter')),
        );
    }

    public function offsetDateFilter($date)
    {
        $now = new \DateTime();
        $diff = $date->diff($now);
        //$diff->format("%r%a")
        if ((int)$diff->format("%r%a") < 0){
            return $diff->format("%r%a");
        }
        else {
            return "+".$diff->format("%r%a");
        }
        
    }

    public function getName()
    {
        return 'user_extension';
    }
}