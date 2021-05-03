<?php

namespace Grav\Plugin;

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
            'onPluginsInitialized' => ['onPluginsInitialized', 0],
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
                'onTwigTemplatePaths' => ['onTwigTemplatePaths', 0],
                'onTwigPageVariables' => ['onTwigPageVariables', 0],
                'onTwigSiteVariables' => ['onTwigSiteVariables', 0],
                'onAssetsInitialized' => ['onAssetsInitialized', 0]
            ]);
        }
    }

    /**
     * We set twig variable in case the template is included in a page and not in a theme template
     *
     * @param Event $e
     */
    public function onTwigPageVariables(Event $e)
    {
        $this->onTwigSiteVariables();
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
        $twig->twig_vars['aboutme_picture_src'] = $this->config->get('plugins.aboutme.gravatar.enabled') ?
            $this->getGravatarUrl() : $this->config->get('plugins.aboutme.picture_src');
        if (is_array($twig->twig_vars['aboutme_picture_src'])) { // grav 1.1 gives an array instead of a simple string
            $twig->twig_vars['aboutme_picture_src'] = key($twig->twig_vars['aboutme_picture_src']);
        }
        $pages = $this->config->get('plugins.aboutme.social_pages.pages');
        uasort($pages, function ($a, $b) {
            return $a['position'] < $b['position'] ? -1 : ($a['position'] == $b['position'] ? 0 : 1);
        });
        $twig->twig_vars['aboutme_pages'] = $pages;
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
        $url = '//www.gravatar.com/avatar/';
        $url .= md5(strtolower(trim($gravatar['email'])));
        $url .= '?s=' . $gravatar['size'];
        return $url;
    }

    public function onAssetsInitialized()
    {
        if ($this->config->get('plugins.aboutme.built_in_css')) {
            $this->grav['assets']->add('plugin://aboutme/assets/css/aboutme.css');
        }
        if ($this->config->get('plugins.aboutme.social_pages.use_font_awesome')) {
            $this->grav['assets']->addJs('https://kit.fontawesome.com/6c3a3c60c8.js');
        }
    }
}
