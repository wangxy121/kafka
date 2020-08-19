<?php
require './vendor/autoload.php';
date_default_timezone_set('PRC');

//同步
/*$config = \Kafka\ProducerConfig::getInstance();
$config->setMetadataRefreshIntervalMs(10000);
$config->setMetadataBrokerList('127.0.0.1:9092');
$config->setBrokerVersion('1.0.0');
$config->setRequiredAck(1);
$config->setIsAsyn(false);
$config->setProduceInterval(500);
$producer = new \Kafka\Producer(
    function() {
        return [
            [
                'topic' => 'test',
                'value' => 'test....message.',
                'key' => 'testkey',
            ],
        ];
    }
);

$producer->success(function($result) {
    var_dump($result);
});
$producer->error(function($errorCode) {
    var_dump($errorCode);
});
$producer->send(true);*/





//异步
$config = \Kafka\ProducerConfig::getInstance();
$config->setMetadataRefreshIntervalMs(10000);
$config->setMetadataBrokerList('127.0.0.1:9092');
$config->setBrokerVersion('1.0.0');
$config->setRequiredAck(1);
$config->setIsAsyn(false);
$config->setProduceInterval(500);
$producer = new \Kafka\Producer();

for($i = 0; $i < 100; $i++) {
    $producer->send([
        [
            'topic' => 'test1',
            'value' => 'sync-test1....message.',
            'key' => '',
        ],
    ]);
}


/*$conf = new RdKafka\Conf();
//捕获错误的回调
$conf->setErrorCb(function ($kafka, $err, $reason) {
    \Log::error('kafkaError', ['errorStr' => rd_kafka_err2str($err), 'err' => $err, 'reason' => $reason, 'content' => $kafka]);
});
$conf->set('log_level', (string) LOG_DEBUG);
$conf->set('debug', 'all');

$rk = new \RdKafka\Producer($conf);
$rk->addBrokers("localhost:9092");

$topic = $rk->newTopic("xy-topic-test");

for ($i = 0; $i < 10; $i++) {
    $topic->produce(RD_KAFKA_PARTITION_UA, 0, "Message $i");
}*/
