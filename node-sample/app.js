const express = require('express')
const bodyParser = require('body-parser')
const dotenv = require("dotenv")

dotenv.config()

const jobs = require('./jobs.js')
const queue = require('./queue.js')

const app = express()
const port = process.env.NODE_PORT !== null ? process.env.NODE_PORT : 43000

app.use(express.json())
app.use(bodyParser.text({type: '*/*'}))
app.use(express.urlencoded({ extended: true }))

app.all('*', async (req, res, next) => {
    console.info('HTTP requested started..')
    try {
        await queue.publish(JSON.stringify(req.body))
        console.log('Queue 1 payload..')
        res.header('Content-Type','application/json')
        res.header('Accept','application/json')
        res.jsonp(req.body)
    } catch (error) {
        res.jsonp({"status": 0, "message": error})
    }
    next()
})

app.listen(port, () => {
    /** Start basic 10 seconds queue consumer */
    jobs.queueConsume()
    console.log(`Running at http://${process.env.NODE_HOST}:${process.env.NODE_PORT}`)
})
