<?php
$conf = new \RdKafka\Conf();

$conf->set('group.id', 'myConsumerGroup');

$rk = new \RdKafka\Consumer($conf);

$rk->addBrokers("127.0.0.1");

$topicConf = new \RdKafka\TopicConf();
$topicConf->set('auto.commit.interval.ms', 100);
$topicConf->set('offset.store.method', 'broker');
$topicConf->set('auto.offset.reset', 'smallest');
$topicConf->set('request.required.acks',1);

$topic = $rk->newTopic('test', $topicConf);
//RD_KAFKA_OFFSET_BEGINNING 重头开始消费
//RD_KAFKA_OFFSET_STORED 最后一条消费的offset记录开始消费
//RD_KAFKA_OFFSET_END  最后一条消费
$topic->consumeStart(0, RD_KAFKA_OFFSET_STORED);

while (true) {
    $message = $topic->consume(0, 120000);
    if(is_null($message)){
        sleep(1);
        echo "no message\n";
        continue;
    }
    switch ($message->err) {
        case RD_KAFKA_RESP_ERR_NO_ERROR:
            echo $message->payload, "\n";
            break;
        case RD_KAFKA_RESP_ERR__PARTITION_EOF:
            echo "No more messages; will wait for more\n";
            break;
        case RD_KAFKA_RESP_ERR__TIMED_OUT:
            echo "Timed out\n";
            break;
        default:
            throw new \Exception($message->errstr(), $message->err);
            break;
    }
}

