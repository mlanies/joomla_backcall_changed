<?php

/**
 * @package     Joomla.Site
 * @subpackage  mod_backcall
 *
 * @copyright   (C) 2006 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
use Joomla\CMS\Uri\Uri;


?>
<style>

/* Скрываем кнопку модуля */
.backcall_mainbutt {
    display: none !important;
}

/* Кастомный дизайн модального окна - под стиль сайта */
#modal-default-actpopup<?php echo $module->id; ?> {
    border-radius: 20px !important;
    box-shadow: 0 20px 60px rgba(0,0,0,0.7) !important;
    max-width: 520px !important;
    overflow: hidden !important;
    border: 1px solid rgba(255,255,255,0.1) !important;
}

/* Скрываем стандартную шапку iziModal */
#modal-default-actpopup<?php echo $module->id; ?> .iziModal-header {
    display: none !important;
}

/* Кастомная шапка */
.backcall-custom-header-<?php echo $module->id; ?> {
    background: linear-gradient(135deg, #3D1520 0%, #5A1F2E 100%);
    border-radius: 20px 20px 0 0;
    padding: 30px 35px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    position: relative;
}

.backcall-custom-header-<?php echo $module->id; ?> .backcall-header-title {
    color: #ffffff;
    font-size: 22px;
    font-weight: 400;
    text-transform: none;
    letter-spacing: 0.5px;
    font-family: 'Georgia', serif;
    margin: 0;
    line-height: 1.3;
}

.backcall-custom-header-<?php echo $module->id; ?> .backcall-close-btn {
    background: rgba(255,255,255,0.15);
    border: none;
    border-radius: 50%;
    width: 38px;
    height: 38px;
    min-width: 38px;
    color: #ffffff;
    font-size: 20px;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-left: 15px;
}

.backcall-custom-header-<?php echo $module->id; ?> .backcall-close-btn:hover {
    background: rgba(255,255,255,0.25);
}

#modal-default-actpopup<?php echo $module->id; ?> .iziModal-content {
    background: #ffffff !important;
    border-radius: 0 0 20px 20px !important;
}

#modal-default-actpopup<?php echo $module->id; ?> input[type="text"] {
    width: 100% !important;
    padding: 16px 20px !important;
    margin-bottom: 20px !important;
    border: 2px solid #e0e0e0 !important;
    border-radius: 10px !important;
    font-size: 16px !important;
    transition: all 0.3s ease !important;
    background: #fafafa !important;
    color: #333 !important;
}

#modal-default-actpopup<?php echo $module->id; ?> input[type="text"]:focus {
    border-color: #B91D3B !important;
    outline: none !important;
    background: #ffffff !important;
    box-shadow: 0 0 0 4px rgba(185, 29, 59, 0.08) !important;
}

#modal-default-actpopup<?php echo $module->id; ?> input[type="text"]::placeholder {
    color: #999 !important;
    opacity: 1 !important;
}

#modal-default-actpopup<?php echo $module->id; ?> .buttonform {
    width: 100% !important;
    padding: 18px 30px !important;
    background: #B91D3B !important;
    border: none !important;
    border-radius: 10px !important;
    color: #ffffff !important;
    font-size: 16px !important;
    font-weight: 600 !important;
    text-transform: uppercase !important;
    letter-spacing: 1px !important;
    cursor: pointer !important;
    transition: all 0.3s ease !important;
    margin-top: 20px !important;
}

#modal-default-actpopup<?php echo $module->id; ?> .buttonform:hover {
    background: #9B1831 !important;
    box-shadow: 0 4px 15px rgba(185, 29, 59, 0.3) !important;
}

#modal-default-actpopup<?php echo $module->id; ?> .pretext_backcall,
#modal-default-actpopup<?php echo $module->id; ?> .posttext_backcall {
    margin-bottom: 20px !important;
    padding: 16px 20px !important;
    background: #F9F5F6 !important;
    border-left: 3px solid #B91D3B !important;
    border-radius: 8px !important;
    font-size: 14px !important;
    color: #555 !important;
    line-height: 1.6 !important;
}

.iziModal-overlay {
    background: rgba(61, 21, 32, 0.85) !important;
    backdrop-filter: blur(5px) !important;
}

@media (max-width: 768px) {
    #modal-default-actpopup<?php echo $module->id; ?> {
        width: 95% !important;
        border-radius: 16px !important;
    }
    #modal-default-actpopup<?php echo $module->id; ?> .iziModal-header {
        border-radius: 16px 16px 0 0 !important;
        padding: 25px 20px !important;
    }
    .backcall-custom-header-<?php echo $module->id; ?> {
        border-radius: 16px 16px 0 0;
        padding: 25px 20px;
    }
    .backcall-custom-header-<?php echo $module->id; ?> .backcall-header-title {
        font-size: 18px;
    }
    #modal-default-actpopup<?php echo $module->id; ?> .iziModal-content {
        padding: 30px 20px !important;
        border-radius: 0 0 16px 16px !important;
    }
    #modal-default-actpopup<?php echo $module->id; ?> .buttonform {
        font-size: 15px !important;
        padding: 16px 25px !important;
    }
}

</style>
<script>
    document.addEventListener('DOMContentLoaded', function(){
        jQuery("#modal-default-actpopup<?php echo $module->id; ?>").iziModal();
        jQuery("#modal-default-actpopup<?php echo $module->id; ?>").iziModal("setFullscreen", false);
    });
    function open_act_popup<?php echo $module->id; ?> () {
        jQuery("#modal-default-actpopup<?php echo $module->id; ?>").iziModal("open", {

        });
    }
</script>
<div class="backcall_mainbutt <?php echo $mainbuttonclass ?>">
    <a onclick="open_act_popup<?php echo $module->id; ?>()" id="CallBackButton" type="button"
       class="btn btn-primary btn-lg">
        <?php echo Text::_('MOD_BACKCALL_BUTTONTEXT'); ?>
    </a>
</div>
<div id="modal-default-actpopup<?php echo $module->id; ?>">
    <div class="backcall-custom-header-<?php echo $module->id; ?>">
        <h2 class="backcall-header-title">Оставьте ваш номер телефона для консультации</h2>
        <button type="button" class="backcall-close-btn" onclick="jQuery('#modal-default-actpopup<?php echo $module->id; ?>').iziModal('close');">&times;</button>
    </div>
    <div class="iziModal-wrap" style="height: 593px;">
        <div class="iziModal-content" style="padding: 20px;">
            <div class="popup_act_content">
                <form method="post" action="<?php echo Uri::root() ?>index.php?option=com_backcall&task=call.send" id="<?php echo $formbackcall ?>" name="<?php echo $formbackcall ?>">
                    <?php if ($params->get('phone_mask') && $params->get('phone_mask') != '') { ?>
                        <script>
                            jQuery(function ($) {
                                jQuery("#<?php echo $phone_input ?>").mask("<?php echo $params->get('phone_mask') ?>");
                            });
                        </script>
                    <?php } ?>
                    <?php if ($params->get('pretext') && $params->get('pretext') != '') { ?>
                        <div class="pretext_backcall">
                            <?php echo $params->get('pretext') ?>
                        </div>
                    <?php } ?>
                    <input required="true" id="<?php echo $name_input ?>" type="text" name="name"
                           placeholder="<?php echo Text::_('MOD_BACKCALL_ENTERNAME'); ?>"/>
                    <input required="true" id="<?php echo $phone_input ?>" type="text" name="phone"
                           placeholder="<?php echo Text::_('MOD_BACKCALL_ENTERPHONE'); ?>"/>
                    <input type="hidden" name="module_id" value="<?php echo $module->id; ?>">
                    <input type="hidden" name="backcall_action" value="sendsend">
                    <input type="hidden" name="option" value="com_backcall">
                    <input type="hidden" name="task" value="call.send">
                    <input type="hidden" name="returl" value="<?php echo $url ?>">
                    <input class="buttonform btn btn-primary btn-lg <?php echo $buttsubm_dopclass ?>"
                           id="<?php echo $buttonbackcall ?>" type="submit"
                           value="<?php echo Text::_('MOD_BACKCALL_BUTTONTEXT'); ?>"
                    />
                    <?php if ($params->get('posttext') && $params->get('posttext') != '') { ?>
                        <div class="posttext_backcall">
                            <?php echo $params->get('posttext') ?>
                        </div>
                    <?php } ?>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo URI::root() . 'media/com_backcall/js/jquery.maskedinput.min.js' ?>"></script>
<script src="<?php echo \Joomla\CMS\Uri\Uri::root() ?>media/com_backcall/js/iziModal.js"></script>