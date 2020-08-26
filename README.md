# API Glow CDN

A set of functions for working with Glow CDN:
- Bucket creation;
- Creating views;
- Authorization;
- File access;
- Uploaded files;

### How to start

```php
$client = new \Bavix\GlowApi\HttpClient(BASE_URL, APP_TOKEN);
$api = new \Bavix\GlowApi\Api($client);
$api->createBucket('users');
$api->createView('users', 'avatar', [
    'name' => 'avatar',
    'type' => 'contain',
    'width' => 160,
    'height' => 160,
    'quality' => 75,
    'optimize' => true,
    'webp' => true,
]);

$files = (new \Bavix\GlowApi\File\Upload())
    ->addFile('id_1.jpg', 'https://stat.babichev.net/svg/logo.svg')
;

$response = $api->writeFile('users', $files); // upload to cdn

// Glow CDN will automatically generate views and you can get them from the links:
// original: http://glow.local/capsule/users/id_1.svg
// thumbnail: http://glow.local/capsule/users:avatar/id_1.svg
// thumbnail+webp: http://glow.local/capsule/users:avatar/id_1.svg.webp
```

---
Supported by

[![Supported by JetBrains](https://cdn.rawgit.com/bavix/development-through/46475b4b/jetbrains.svg)](https://www.jetbrains.com/)
