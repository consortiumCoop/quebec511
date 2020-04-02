Fetch Quebec511 Rss feeds

see https://www.quebec511.info

# Installation

    $ composer require 1franck/quebec511

# Usage

```php
$q511 = Quebec511Factory::createDefault();
$result = $q511->forRegion(4000)->getRoadStatuses([20, 85]);
```

# Regions and Roads codes

check file ``/config/quebec511.yml``