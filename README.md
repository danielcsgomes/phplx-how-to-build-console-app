# How to build Console Applications

[![Build Status](https://travis-ci.org/danielcsgomes/phplx-how-to-build-console-app.png?branch=master)](https://travis-ci.org/danielcsgomes/phplx-how-to-build-console-app)

The source code of my talk at [phplx October 2013 meetup](http://phplx.net)

## Disclaimer

The code in this repository is only for demonstration purposes.

## Installation

```

git clone git@github.com:danielcsgomes/phplx-how-to-build-console-app.git

cd phplx-how-to-build-console-app

# Install using composer with development dependencies:
curl -sS https://getcomposer.org/installer | php

# Then, using the `composer.phar` file:
php composer.phar install --dev

```

## Usage

```

# Run the application
php app.php
  
# Run the examples
php examples/<Folder>/<ExampleName>.php

# Run tests:
./vendor/bin/phpunit

```

## License
The code is licensed under the [MIT License](https://github.com/danielcsgomes/phplx-how-to-build-console-app/blob/master/LICENSE)
