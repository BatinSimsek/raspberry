import './bootstrap';

console.debug('init app')

EchoClient.listen('notifications', 'NewLogEvent', (ev) => {
    console.warn('Received event', ev)
    if (ev?.logData?.description) {
        alert(ev.logData.description)
    } else {
        console.warn('Invalid logData event.')
    }
})
