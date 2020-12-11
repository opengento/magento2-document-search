# Document Module for Magento 2

[![Latest Stable Version](https://img.shields.io/packagist/v/opengento/module-document-search.svg?style=flat-square)](https://packagist.org/packages/opengento/module-document-search)
[![License: MIT](https://img.shields.io/github/license/opengento/magento2-document-search.svg?style=flat-square)](./LICENSE) 
[![Packagist](https://img.shields.io/packagist/dt/opengento/module-document-search.svg?style=flat-square)](https://packagist.org/packages/opengento/module-document-search/stats)
[![Packagist](https://img.shields.io/packagist/dm/opengento/module-document-search.svg?style=flat-square)](https://packagist.org/packages/opengento/module-document-search/stats)

This module aims to make documents searchable for customers in Magento 2.

 - [Setup](#setup)
   - [Composer installation](#composer-installation)
   - [Setup the module](#setup-the-module)
 - [Features](#features)
 - [Settings](#settings)
 - [Documentation](#documentation)
 - [Support](#support)
 - [Authors](#authors)
 - [License](#license)

## Setup

Magento 2 Open Source or Commerce edition is required.

###  Composer installation

Run the following composer command:

```
composer require opengento/module-document-search
```

### Setup the module

Run the following magento command:

```
bin/magento setup:upgrade
```

**If you are in production mode, do not forget to recompile and redeploy the static resources.**

## Features

This module aims to make documents searchable for customers in Magento 2.  
Documents can be searchable if their visibility is set to `search`.

## Documentation

You can change the full search behavior by using the collection modifier extension point.  
Add you own `Magento\Framework\Data\CollectionModifierInterface` implementation to the modifiers list of:

`\Opengento\DocumentSearch\Model\Collection\CollectionModifier`

Query parameters can be read through: `\Opengento\DocumentSearch\Model\QueryData`

## Support

Raise a new [request](https://github.com/opengento/magento2-document-search/issues) to the issue tracker.

## Authors

- **Opengento Community** - *Lead* - [![Twitter Follow](https://img.shields.io/twitter/follow/opengento.svg?style=social)](https://twitter.com/opengento)
- **Thomas Klein** - *Maintainer* - [![GitHub followers](https://img.shields.io/github/followers/thomas-kl1.svg?style=social)](https://github.com/thomas-kl1)
- **Contributors** - *Contributor* - [![GitHub contributors](https://img.shields.io/github/contributors/opengento/magento2-document-search.svg?style=flat-square)](https://github.com/opengento/magento2-document-search/graphs/contributors)

## License

This project is licensed under the MIT License - see the [LICENSE](./LICENSE) details.

***That's all folks!***
