const schedule = require('node-schedule')
const queue = require('./queue.js')

module.exports = {

    async queueConsume() {
        // return schedule.scheduleJob('10 * * * * *', () => {
            console.log('Waiting for payload to consume..')
            queue.consume()
        // })
    }
}
