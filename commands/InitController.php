<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;
use yii\helpers\Console;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class InitController extends Controller
{

    public $defaultAction = 'database';

    /**
     * @var array
     */
    private $sqlMap = [
        '01-schema.sql',
//        '02-testdata.sql',
    ];

    public function actionConfig()
    {
        $configPath = \Yii::getAlias('@app/config/db.php');

        if (!file_exists($configPath) && $this->confirm('Write database parameters now?', true))
        {
            $database = $this->prompt('Name of the **existing** database?', ['required' => true]);
            $hostname = $this->prompt('Hostname?', ['required' => true, 'default' => 'localhost']);
            $username = $this->prompt('Username?', ['required' => true, 'default' => 'root']);
            $password = $this->prompt('Password?');

        $config = <<<"CONF"
<?php

return [
	'class' => 'yii\db\Connection',
	'dsn' => 'mysql:host={$hostname};dbname={$database}',
	'username' => '{$username}',
	'password' => '{$password}',
	'charset' => 'utf8',
];

CONF;
            if (file_put_contents($configPath, $config)) {
                \Yii::$app->setComponent('db', require $configPath);
                $this->stdout("Wrote data to: {$configPath}" . \PHP_EOL);
                $this->actionDatabase();
            }
        }

    }

	public function actionDatabase()
	{
        if ($this->confirm('Import database dumps now?', true))
        {
            \Yii::$app->db->open();
            \Yii::$app->db->pdo->setAttribute(\PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, 1);
            foreach ($this->sqlMap as $sqlFile) {
                $path = \Yii::getAlias('@app/schema/' . $sqlFile);
                echo sprintf('Loading "%s"%s', $sqlFile, PHP_EOL);

                $sql = implode("\n", file($path));

                $res = \Yii::$app->db->pdo->prepare($sql)->execute();

                if ($res) {
                    echo sprintf('Success' . \PHP_EOL);
                } else {
                    echo sprintf('Failure' . \PHP_EOL);
                }
            }
            $this->stdout("Done");
        }
    }
}
