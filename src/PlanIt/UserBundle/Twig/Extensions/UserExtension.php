<?php
// src/Blogger/BlogBundle/Twig/Extensions/BloggerBlogExtension.php

namespace PlanIt\UserBundle\Twig\Extensions;

class UserExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            'created_ago' => new \Twig_Filter_Method($this, 'createdAgo'),
        );
    }

    public function createdAgo(\DateTime $dateTime)
    {

        return $dateTime;
    }

    public function getName()
    {
        return 'created_ago';
    }
}