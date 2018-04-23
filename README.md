Yii2 Queue Manager
==================

[![Latest Stable Version](https://poser.pugx.org/ignatenkovnikita/yii2-queuemanager/v/stable)](https://packagist.org/packages/ignatenkovnikita/yii2-queuemanager) [![Total Downloads](https://poser.pugx.org/ignatenkovnikita/yii2-queuemanager/downloads)](https://packagist.org/packages/ignatenkovnikita/yii2-queuemanager) [![Latest Unstable Version](https://poser.pugx.org/ignatenkovnikita/yii2-queuemanager/v/unstable)](https://packagist.org/packages/ignatenkovnikita/yii2-queuemanager) [![License](https://poser.pugx.org/ignatenkovnikita/yii2-queuemanager/license)](https://packagist.org/packages/ignatenkovnikita/yii2-queuemanager)


Yii2 Queue Manager

![2017-10-21_13-55-13](https://user-images.githubusercontent.com/4436320/31851112-b75f26e8-b667-11e7-8f54-d907daeb26bb.png)


Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist ignatenkovnikita/yii2-queuemanager "*"
```

or add

```
"ignatenkovnikita/yii2-queuemanager": "*"
```

to the require section of your `composer.json` file.


Usage
-----
Apply migrations

```bash
./console/yii migrate --migrationPath=vendor/ignatenkovnikita/yii2-queuemanager/migrations/

```

Once the extension is installed, simply use it in your code by  :

```php
'modules' => [
        'queuemanager' => [
            'class' => \ignatenkovnikita\queuemanager\QueueManager::class
        ]
],
'components' => [
        'queue' => [
            'class' => \yii\queue\redis\Queue::class,
            'as log' => \yii\queue\LogBehavior::class,
            'as quuemanager' => \ignatenkovnikita\queuemanager\behaviors\QueueManagerBehavior::class
            // Other driver options
        ],
 ]```
