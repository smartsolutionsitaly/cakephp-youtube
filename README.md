# cakephp-youtube
[![LICENSE](https://img.shields.io/github/license/smartsolutionsitaly/cakephp-youtube.svg)](LICENSE)
[![packagist](https://img.shields.io/badge/packagist-smartsolutionsitaly%2Fcakephp--youtube-brightgreen.svg)](https://packagist.org/packages/smartsolutionsitaly/cakephp-youtube)
[![issues](https://img.shields.io/github/issues/smartsolutionsitaly/cakephp-youtube.svg)](https://github.com/smartsolutionsitaly/cakephp-youtube/issues)
[![CakePHP](https://img.shields.io/badge/CakePHP-3.6%2B-brightgreen.svg)](https://github.com/cakephp/cakephp)

YouTube plugin for [CakePHP](https://github.com/cakephp/cakephp)

## Installation
You can install _cakephp-youtube_ into your project using [Composer](https://getcomposer.org).

``` bash
composer require smartsolutionsitaly/cakephp-youtube
```

## Setup
Insert at the bottom of your _src/Application.php_ file the following line:

``` php
$this->addPlugin('SmartSolutionsItaly/CakePHP/YouTube');
```

And add or edit the method _initialize_ in your _Table_ classes.

``` php
public function initialize(array $config)
{
    parent::initialize($config);
    
    $this->addBehavior('SmartSolutionsItaly/CakePHP/YouTube.YouTube');
}
```

## License
Licensed under The MIT License
For full copyright and license information, please see the [LICENSE](LICENSE)
Redistributions of files must retain the above copyright notice.

## Copyright
Copyright (c) 2019 Smart Solutions S.r.l. (https://smartsolutions.it)
