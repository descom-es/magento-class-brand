# Magento Brand Class

module for Magento2 add brand to the body class.

## Install

From Magento2 root dir:

```bash
COMPOSER_MEMORY_LIMIT=-1 composer require  descom-es/magento-class-brand
bin/magento module:enable Descom_BrandClass
bin/magento setup:upgrade
```

also, if in production mode:

```bash
bin/magento setup:static-content:deploy
```
