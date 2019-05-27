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

namespace SmartSolutionsItaly\CakePHP\YouTube\Model\Behavior;

use Cake\Collection\CollectionInterface;
use Cake\ORM\Behavior;
use Cake\ORM\Query;
use SmartSolutionsItaly\CakePHP\YouTube\Http\Client\YouTubeClient;

/**
 * YouTube behavior.
 * @package SmartSolutionsItaly\CakePHP\YouTube\Model\Behavior
 * @author Lucio Benini
 * @since 1.0.0
 */
class YouTubeBehavior extends Behavior
{
    /**
     * Default configuration.
     * @var array
     */
    protected $_defaultConfig = [
        'count' => 5,
        'field' => 'youtube'
    ];

    /**
     * Finder for YouTube channel items.
     * Adds a formatter to the query.
     * @param Query $query The query object.
     * @param array $options Query options. Usually empty.
     * @return Query The query object.
     */
    public function findYoutube(Query $query, array $options): Query
    {
        $options = $options + [
                'count' => (int)$this->getConfig('count'),
                'field' => (string)$this->getConfig('field'),
                'format' => true
            ];

        return $query
            ->formatResults(function (CollectionInterface $results) use ($options) {
                return $results->map(function ($row) use ($options) {
                    if (!empty($row[$options['field']])) {
                        $res = [];

                        $client = new YouTubeClient;
                        $channel = $client->getChannel($row[$options['field']], (int)$options['count']);

                        foreach ($channel as $media) {
                            $res[] = $media->getId()->getVideoId();
                        }

                        $row[$options['field']] = $res;
                    }

                    return $row;
                });
            }, Query::APPEND);
    }
}
