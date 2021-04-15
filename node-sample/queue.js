const q = 'tasks'
const amqp = require('amqplib')

module.exports = {

    async open() {
        return amqp.connect(`amqp://${process.env.RABBITMQ_DEFAULT_USER}:${process.env.RABBITMQ_DEFAULT_PASS}@${process.env.RABBIT_HOST}:${process.env.RABBIT_PORT}`)
    },

    async publish(message = "{}") {
        const open = this.open()
        open.then(function(conn) {
        return conn.createChannel()
        }).then(async function(ch) {
        const ok = await ch.assertQueue(q)
            return ch.sendToQueue(q, Buffer.from(message))
        }).catch(console.warn)
    },

    async consume() {
        const open = this.open()
        open.then(function(conn) {
        return conn.createChannel()
        }).then(async function(ch) {
        const ok = await ch.assertQueue(q)
            return await ch.consume(q, function (msg) {
                if (msg !== null) {
                    console.log("Consumed:")
                    console.log(msg.content.toString())
                    ch.ack(msg)
                }
            });
        }).catch(console.warn)
    }

}