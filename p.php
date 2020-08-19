<?php


$conf->set('metadata.broker.list', '127.0.0.1:9092');
$topicConf = new \RdKafka\TopicConf();
$topicConf->set('request.required.acks',0);

$producer = new \RdKafka\Producer($conf);

$topic = $producer->newTopic('test');
for($i = 0; $i < 10; $i++){
    $topic->produce(RD_KAFKA_PARTITION_UA, 0, 'xy'.$i);
}


$len = $producer->getOutQLen();

while ($len > 0){
    $len = $producer->getOutQLen();
    var_dump($len);
    $producer->poll(50);//等待时长
}
/*$producer->poll(0);

$result = $producer->flush(10000);

if (RD_KAFKA_RESP_ERR_NO_ERROR !== $result) {
    throw new \RuntimeException('Was unable to flush, messages might be lost!');
}
var_dump($result);*/

