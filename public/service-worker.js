var version = '1.1'
var CACHE_NAME = 'pwa-yooty-' + version
var doCache = true;

var dataCacheName = 'pwa-yooty-data-' + version

// clear old cache
self.addEventListener('activate', event => {
    const cacheWhitelist = [CACHE_NAME];
    event.waitUntil(
        caches.keys()
            .then(keyList =>
                Promise.all(keyList.map(key => {
                    if (!cacheWhitelist.includes(key)) {
                        //console.log('Deleting cache: ' + key)
                        return caches.delete(key);
                    }
                }))
            )
    );
});

// 'install' for first time
self.addEventListener('install', function(event) {
    if (doCache) {
        event.waitUntil(
            caches.open(CACHE_NAME)
                .then(function(cache) {
                    // receive the manifest data (they are cached)
                    fetch('/static/reader/manifest.json')
                        .then(response => {
                            response.json()
                        })
                        .then(assets => {
                            // open and cache files and pages
                            const urlsToCache = [
                                './man.txt'
                        ]
                            cache.addAll(urlsToCache)
                            console.log('cached');
                        })
                })
        );
    }
});

// if app is open, service-worker take the requests and answer on it
self.addEventListener('fetch', function(event) {
    if (doCache) {
        event.respondWith(
            caches.match(event.request).then(function(response) {
                return response || fetch(event.request);
            })
        );
    }
});
