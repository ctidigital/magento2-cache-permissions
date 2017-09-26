# Advanced Acl Permissions module for Magento 2

## Overview

Magento's default access control rules mean that a user with access to the 'Cache Management' section can flush any cache. This can have very serious performance impacts on the website.

This module adds more access control rules allowing you to control what certain users are able to do.
## Installation details
 
Simply require module in your project using composer.
* `composer require ctidigital/module-advanced-acl-permissions`
* `php bin/magento module:enable CtiDigital_AdvancedAclPermissions`
* `php bin/magento setup:upgrade`
 
## Features

### Configuration 
Configuration is available in admin panel for a given customer role System > All Users

![Configuration](./README/advanced_acl_options.png)

The module allows control of whether the user can view, flush, or toggle a cache as well as performing complete cache flushes.

### Overrides
* Preference for Magento\Backend\Block\Cache

