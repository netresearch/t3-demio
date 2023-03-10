<?php
defined('TYPO3_MODE') || die('Access denied.');


(static function() {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Netresearch.Demio',
        'List',
        [
            \Netresearch\Demio\Controller\ListController::class => 'list'
        ],
        // non-cacheable actions
        []
    );

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Netresearch.Demio',
        'Single',
        [
            \Netresearch\Demio\Controller\SingleController::class => 'show'
        ],
        // non-cacheable actions
        []
    );


    $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
        \TYPO3\CMS\Core\Imaging\IconRegistry::class
    );
    $iconRegistry->registerIcon(
        'demio-plugin-list', // Icon-Identifier, z.B. tx-myext-action-preview
        \TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider::class,
        ['source' => 'EXT:demio/Resources/Public/Icons/Icon.png']
    );
    $iconRegistry->registerIcon(
        'demio-plugin-single', // Icon-Identifier, z.B. tx-myext-action-preview
        \TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider::class,
        ['source' => 'EXT:demio/Resources/Public/Icons/Icon.png']
    );

    // wizards
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        'mod {
            wizards.newContentElement.wizardItems.plugins {
                elements {
                    list {
                        iconIdentifier = demio-plugin-list
                        title = LLL:EXT:demio/Resources/Private/Language/locallang_db.xlf:tx_demio_list.name
                        description = LLL:EXT:demio/Resources/Private/Language/locallang_db.xlf:tx_demio_list.description
                        tt_content_defValues {
                            CType = list
                            list_type = demio_list
                        }
                    }
                    single {
                        iconIdentifier = demio-plugin-single
                        title = LLL:EXT:demio/Resources/Private/Language/locallang_db.xlf:tx_demio_single.name
                        description = LLL:EXT:demio/Resources/Private/Language/locallang_db.xlf:tx_demio_single.description
                        tt_content_defValues {
                            CType = list
                            list_type = demio_single
                        }
                    }
                }
                show = *
            }
       }'
    );

    // Set default dashboard preset
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addUserTSConfig(
        'options.dashboard.dashboardPresetsForNewUsers = default, demioPreset'
    );

    // Custom TCA fields
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['nodeRegistry'][1677100495] = [
        'nodeName' => 'selectEvent',
        'priority' => 40,
        'class' => \Netresearch\Demio\Form\Element\SelectEvent::class,
    ];


})();

