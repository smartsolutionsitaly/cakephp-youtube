<?php
/**
 * cakephp-youtube (https://github.com/smartsolutionsitaly/cakephp-youtube)
 * Copyright (c) 2019 Smart Solutions S.r.l. (https://smartsolutions.it)
 *
 * YouTube plugin for CakePHP
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE
 * Redistributions of files must retain the above copyright notice.
 *
 * @category  cakephp-plugin
 * @package   cakephp-youtube
 * @author    Lucio Benini <dev@smartsolutions.it>
 * @copyright 2019 Smart Solutions S.r.l. (https://smartsolutions.it)
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 * @link      https://smartsolutions.it Smart Solutions
 * @since     1.0.0
 */

namespace SmartSolutionsItaly\CakePHP\YouTube\View\Helper;

use Cake\View\Helper;
use Cake\View\StringTemplateTrait;
use SmartSolutionsItaly\CakePHP\Database\Color;

/**
 * Provides base frontend features.
 * @package App\View\Helper
 * @author Lucio Benini <dev@smartsolutions.it>
 * @since 1.0.0
 */
class YouTubeHelper extends Helper
{
    use StringTemplateTrait;

    /**
     * List of helpers used by this helper.
     * @var array
     * @see \Cake\View\Helper::$helpers
     */
    public $helpers = [
        'Html'
    ];

    /**
     * Default configuration for this helper.
     * @var array
     * @see \Cake\View\Helper::$_defaultConfig
     */
    protected $_defaultConfig = [
        'templates' => [
            'iframe' => '<iframe width="{{width}}" height="{{height}}" src="{{src}}" frameborder="0" allow="{{allow}}" allowfullscreen></iframe>'
        ]
    ];

    /**
     * Generates an HTML code for the given YouTube video ID.
     * @param string $id YouTube video ID.
     * @param array $options HTML options
     * @return string An HTML code for the given YouTube video ID.
     */
    public function embed(string $id, array $options = []): string
    {
        $options = $options + [
                'width' => (int)$this->getConfig('count'),
                'height' => (string)$this->getConfig('field'),
                'allow' => [
                    'accelerometer',
                    'autoplay',
                    'encrypted-media',
                    'gyroscope',
                    'picture-in-picture'
                ]
            ];

        if (is_array($options['allow'])) {
            $options['allow'] = implode('; ', $options['allow']);
        }

        $options['src'] = 'https://www.youtube.com/embed/' . $id;

        return $this->formatTemplate('iframe', $options);
    }
}
