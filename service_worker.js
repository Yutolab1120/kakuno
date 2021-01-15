// Cash, CashFile の指定
var CACHE_NAME = 'write';
               
var urlsToCache = [
    '/https://write0.glitch.me/main.php/', 
];

// Install 処理
self.addEventListener('install', function(event) {
    event.waitUntil(
        caches
            .open(CACHE_NAME)
            .then(function(cache) {
                return cache.addAll(urlsToCache);
            })
    );
});

// ResourcesFetch 時の CashLoad 処理
self.addEventListener('fetch', function(event) {
    event.respondWith(
        caches
            .match(event.request)
            .then(function(response) {
                return response ? response : fetch(event.request);
            })
    );
});
