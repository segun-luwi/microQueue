# Trcacar Queue

## Basic deplyment command

Execute only linux, macOsx, or Windows WSL, as there no promise volume mounting will work directly on windows, thia enviroment is intended for a live development for traccar and is far from an actual production development from security and fucntionality view.

```bash
git clone https://github.com/gpproton/microQueue.git && \
git checkout dev && \
cd microQueue && \
docker-compose up -d && \
sleep 15 && \
tail -f ./data/traccar/logs/tracker-server.log
```

NOTE: Extensive test have not been performed on the RabbitMQ integration, due to time i hope it works for you.

### Component of setup

- Traccar Instance - required for decoding TCP/UDP packet and push to PHP API.
- Apache Container - Recieves raw JSON payload of positions and event from traccar and parse to RabbitMQ for it required purpose.
- RabbitMQ - For message queuing.

A quick view at the sample PHP api allows for posting raw JSOn to `http://localhost:4567/?state-type=Publish` while recieving at `http://localhost:4567/?state-type=Consume` as a cron or background task simulation this purely a test again and not close to a proper implementation at least with the consumer part, but the producer module is clearly a direct explanation on using with traccar forwarder located at `conf/traccar/traccar.xml` with entry key forward.url

for any question or guidance mail me at me@godwin.dev
