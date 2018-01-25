# rodrigoiii/queue-job-slim

Don't let your visitor wait to finish the process of your application.
The goal of this library is to ease the loading process.
Just create the job and let it do that for you.

## Setup for server side
I assume you are using slim micro framework. If not ignore this library.

Create file `server.php` or any name do you want and include the `autoload.php` file.
Instantiate your worker and put the host.

```php
$queue = new RodrigoIII\QueueJob\Worker("127.0.0.1");
```

Then put your jobs to watch it.

```php
$queue->listen(["PunchUp", "PunchDown"]);
```
After all, just run it in the terminal/console. Like `php server.php`

## Setup for client side
Put your queue-job settings in slim application like below.

```php
$app = new Slim\App([
    'settings' => [
        'displayErrorDetails' => true,

        'queue-job' => [
            'host' => "127.0.0.1", // this is host
            'job_namespace' => "Example\Jobs" // this is where your jobs location
        ]
    ]
]);
```

Get the container of application (this is must because the library will fetch it globally).
```php
$container = $app->getContainer();
```

And then produce what job you want to process.
```php
$app->get('/test', function ()
{
    new RodrigoIII\QueueJob\Producer("PunchDown"); // Call the PunchDown job
    new RodrigoIII\QueueJob\Producer("PunchUp"); // Call the PunchUp job
});

$app->run();
```

Checkout the demo in this link https://github.com/rodrigoiii/queue-job-slim/tree/master/example.