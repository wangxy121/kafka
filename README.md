Kafka 一款是基于磁盘顺序读写,支持批处理的消息队列。
1,安装
docker-compose up -d kafka

2，测试 启动服务
先启动zookeeper,默认自带的
 ./bin/zkServer.sh  ./conf/zoo.cfg
 然后启动kafka服务
 bin/kafka-server-start.sh config/server.properties
 
在服务器上打开一个生产者，然后把输入的每行数据发送到kafka中的命令
bin/kafka-console-producer.sh --broker-list localhost:9092 --topic test
后面光标提示数据数据，然后回车就会发送到kafka中了

打开一个消费者
bin/kafka-console-consumer.sh --bootstrap-server localhost:9092 --topic test --from-beginning
当有数据往kafka的test主题发送消息，这边就会进行消费。

一些常见问题
https://www.cnblogs.com/hellxz/p/why_cnnect_to_kafka_always_failure.html

有windows下的包，新版本 kafka 集成了zookeeper 