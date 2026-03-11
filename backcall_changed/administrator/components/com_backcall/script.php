<?php

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;

defined('_JEXEC') or die('Restricted access');


class com_backcallInstallerScript {
    public $release;
    function preflight( $type, $parent ) {
        $this->release = $parent->getParent()->get( "manifest" )->version;
    }
    function postflight( $type, $parent ) {

        if ($type == 'install' || $type == 'update') {
            $app = Factory::getApplication();
            $lang = $app->getLanguage();
            $lang->load('com_backcall');

            echo '<p>' . Text::_('COM_BACKCALL_XML_DESCRIPTION') . '</p>';
            echo '<p>' . Text::sprintf('COM_BACKCALL_VERSION', $this->release) . '</p>';
            echo '<p>' . Text::_('COM_BACKCALL_DEV') . '</p>';
        }

    }


}


