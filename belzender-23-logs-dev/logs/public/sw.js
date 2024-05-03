self.addEventListener("push", (event) =>{

    notification = event.data.json()
    //{"title": "HI"}
    event.waitUntil(self.registration.showNotification(notification.title))
})

self.addEventListener("notificationclick", (event) =>{
    event.waitUntil(clients.openWindow(event.notification.data.title))
})

// self.addEventListener("push", (event) => {
//     const notification = event.data.json();
//
//     const options = {
//         body: notification.body, // Assuming you have a 'body' property in your payload
//         icon: notification.icon, // Assuming you have an 'icon' property in your payload
//     };
//
//     event.waitUntil(self.registration.showNotification(notification.title, options));
// });
//
// self.addEventListener("notificationclick", (event) => {
//     event.waitUntil(clients.openWindow(event.notification.data.url)); // Assuming you have a 'url' property in your payload
// });
