Yii2 Queue Manager
==================
Yii2 Queue Manager

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