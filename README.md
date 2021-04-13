# Sample Trcacar Queue

## Basic deplyment command

```bash
git clone https://github.com/gpproton/microQueue.git && \
git checkout dev && \
cd microQueue && \
docker-compose up -d && \
sleep 15 && \
tail -f ./data/traccar/logs/tracker-server.log
```

NOTE: Extensive test have not been performed on the RabbitMQ integration, due to time i hope it works for you.
