Fetch Quebec511 Rss feeds

see https://www.quebec511.info

# Installation
```php
    // In your composer.json : 
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/consortiumCoop/quebec511"
        }
    ]

    // and :
    "require": {
        "1frank/quebec511": "0.2"
    }

```
# Usage

```php
$q511 = Quebec511Factory::createDefault();
$result = $q511->forRegion(4000)->getRoadStatuses([20, 85]);
```

# Regions and Roads codes

check file ``/config/quebec511.yml``