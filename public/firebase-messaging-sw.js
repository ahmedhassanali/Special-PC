importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');

firebase.initializeApp({
    apiKey: "AIzaSyDYPsYCso9o5f3dBdDZPErxNM1KvmJlZjg",
    projectId: "live-hemdania",
    messagingSenderId: "763430146805",
    appId: "1:763430146805:web:8692efced8c3211c95abbc",
});

const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function ({ data: { title, body, icon } }) {
    return self.registration.showNotification(title, { body, icon });

});

