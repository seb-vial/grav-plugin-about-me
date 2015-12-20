<?php

namespace Grav\Plugin;

use Grav\Common\Data\Blueprints;
use Grav\Common\Plugin;
use Grav\Common\Page\Page;
use RocketTheme\Toolbox\Event\Event;

/**
 * Class AboutMePlugin
 * @package Grav\Plugin
 */
class AboutMePlugin extends Plugin
{
    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            'onPluginsInitialized'  => ['onPluginsInitialized', 0],
        ];
    }

    /**
     *
     */
    public function onPluginsInitialized()
    {
        if (true === $this->isAdmin()) {
            $this->active = false;
            return;
        }

        if ($this->config->get('plugins.aboutme.enabled')) {
            $this->enable([
                'onTwigTemplatePaths'   => ['onTwigTemplatePaths', 0],
                'onTwigSiteVariables'     => ['onTwigSiteVariables', 0]
            ]);
        }
    }

    /**
     * Set variables for the template
     */
    public function onTwigSiteVariables()
    {
        $twig = $this->grav['twig'];
        $twig->twig_vars['aboutme_name'] = $this->config->get('plugins.aboutme.name');
        $twig->twig_vars['aboutme_title'] = $this->config->get('plugins.aboutme.title');
        $twig->twig_vars['aboutme_description'] = $this->config->get('plugins.aboutme.description');
        $twig->twig_vars['aboutme_gravatar'] = $this->config->get('plugins.aboutme.gravatar.enabled');
        if ($twig->twig_vars['aboutme_gravatar']) {
            $twig->twig_vars['aboutme_picture_src'] = $this->getGravatarUrl();
        }
        else {
            $twig->twig_vars['aboutme_picture_src'] = $this->config->get('plugins.aboutme.picture.src');
            $twig->twig_vars['aboutme_picture_size'] = $this->config->get('plugins.aboutme.picture.size'); 
        }
    }

    /**
     *
     */
    public function onTwigTemplatePaths()
    {
        $this->grav['twig']->twig_paths[] = __DIR__ . '/templates';
    }

    /**
    * Get the profile picture based on the gravatar config
    **/
    private function getGravatarUrl()
    {
        $gravatar = $this->config->get('plugins.aboutme.gravatar');
        $url = 'http://www.gravatar.com/avatar/';
        $url .= md5(strtolower(trim($gravatar['email'])));
        $url .= '?s=' . $gravatar['size'];
        return $url;
    }
}
