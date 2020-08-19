<?php
require './vendor/autoload.php';
date_default_timezone_set('PRC');


$config = \Kafka\ConsumerConfig::getInstance();
$config->setMetadataRefreshIntervalMs(10000);
$config->setMetadataBrokerList('127.0.0.1:9092');
$config->setGroupId('test1');
$config->setBrokerVersion('1.0.0');
$config->setTopics(['test1']);
//$config->setOffsetReset('earliest');
$consumer = new \Kafka\Consumer();

$consumer->start(function($topic, $part, $message) {
    var_dump($message);
});
exit;










$conf =   new RdKafka\Conf();
$conf->set('log_level', (string) LOG_DEBUG);
$conf->set('debug', 'all');
https://www.cnblogs.com/zhangkaimin/p/10947553.html


$rk = new \RdKafka\Consumer($conf);
//指定 broker 地址,多个地址用"," 分割
$rk->addBrokers("localhost:9092");

$topic = $rk->newTopic("xy-topic-test");
/**
 * consumeStart
 *   第一个参数标识分区，生产者是往分区0发送的消息，这里也从分区0拉取消息
 *   第二个参数标识从什么位置开始拉取消息，可选值为
 *     RD_KAFKA_OFFSET_BEGINNING : 从开始拉取消息
 *     RD_KAFKA_OFFSET_END : 从当前位置开始拉取消息
 *     RD_KAFKA_OFFSET_STORED : 猜测跟RD_KAFKA_OFFSET_END一样
 */

$topic->consumeStart(0, RD_KAFKA_OFFSET_BEGINNING);

while (true) {
    //第一个参数是分区，第二个参数是超时时间
    $msg = $topic->consume(0, 1000);
    if (null === $msg) {
        continue;
    } elseif ($msg->err) {
        echo $msg->errstr(), "\n";
        break;
    } else {
        echo $msg->payload, "\n";
    }
}
