# yii2-crmapp
This repository contains the project of a book called "Web Application Development with Yii 2 and PHP" by Mark Safronov, Jeffrey Winesett


## Commands
```shell
mkdir yii2-crmapp
cd yii2-crmapp
git init

# Composer
curl -sS https://getcomposer.org/installer | php

# Codeption - inital config
composer require "codeception/codeception:*"
alias cept="./vendor/bin/codecept"
cept bootstrap

# Codeption - Create one acceptance test called SmokeTestCept.php in tests/acceptance
cept generate:cept acceptance SmokeTest

# Codeption - run tests
cept run

# Codeption - change tests/acceptance.suite.yml change acceptance.suite.yml
cept build
cept run

# Codeption - Create one acceptance test called QueryCustomerByPhoneNumber.php in tests/acceptance
cept generate:cept acceptance QueryCustomerByPhoneNumber

# Codeption - generate an extended class from AcceptanceTester called CRMOperatorSteps.php in tests/_support/Step/Acceptance
cept generate:stepobject acceptance CRMOperatorSteps

# Codeption - generate an extended class from AcceptanceTester called CRMUserSteps.php in tests/_support/Step/Acceptance
cept generate:stepobject acceptance CRMUserSteps

composer require "fzaninotto/faker:*"

cept run

```