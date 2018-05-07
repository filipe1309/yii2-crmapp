# yii2-crmapp
This repository contains the project of a book called "Web Application Development with Yii 2 and PHP" by Mark Safronov, Jeffrey Winesett  with some adaptations to allow the app to run with the new versions of Codeception and Yii2


## Commands
```shell

############
# Chapter 2
############

mkdir yii2-crmapp
cd yii2-crmapp
git init

# Composer
curl -sS https://getcomposer.org/installer | php

composer global require "fxp/composer-asset-plugin:1.0.0-beta4"

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

# Yii2
composer require "yiisoft/yii2:*"

# Yii2 - Create mandatory folders for yii2
mkdir runtime
mkdir web/assets

# MySQL yii2 table
# create database `crmapp` default character set utf8 default collate utf8_unicode_ci;

chmod +x yii

./yii migrate/create init_customer_table
./yii migrate/create init_phone_table
./yii migrate

############
# Chapter 3
############

# run acceptance tests only
cept run acceptance

./yii migrate/create init_service_table
./yii migrate

# Add Gii module
composer require --prefer-dist "yiisoft/yii2-gii:*"

cept generate:cept acceptance RegisterNewService
cept generate:stepobject acceptance CRMServicesManagementSteps
cept generate:stepobject acceptance CRMGuestSteps
cept generate:cept acceptance EditService
cept generate:cept acceptance DeleteService

# Add git tags to chapters
git tag -a c2 -m"Chapter 2" 929021e9535eaf1ac
git tag -a c3 -m"Chapter 3" 24c5c5b7bd6d7e355d
git push origin --tags

## phantomjs --webdriver=4444

# update java
sudo vim /etc/apt/sources.list
deb http://ppa.launchpad.net/webupd8team/java/ubuntu trusty main
deb-src http://ppa.launchpad.net/webupd8team/java/ubuntu trusty main
sudo apt-get update
sudo add-apt-repository ppa:webupd8team/java
sudo apt-get install oracle-java8-installer

# add Gecko Driver (Firefor) for Selenium server
% export PATH=$PATH:/bin
% whereis geckodriver
geckodriver: /bin/geckodriver

# install Xvfb
sudo apt-get install xvfb
# set display number to :99
## Xvfb :99 -ac &
## export DISPLAY=:99    
# you are now having an X display by Xvfb

# Switch from PhpBrowser to Selenium to be able to deal with popups
# use xvfb to run headless browser
## Xvfb &
## java -jar selenium_sa_3.8.1.jar -enablePassThrough false

# command to run test with a headless browser in selenium using xvfb
DISPLAY=:1 xvfb-run java -jar selenium_sa_3.8.1.jar -enablePassThrough false

############
# Chapter 4
############

cept generate:cept acceptance Documentation
cept build
cept run acceptance DocumentationCept
# cept run tests/acceptance/DocumentationCept

# Add git tags to chapters
git tag -a c4 -m"Chapter 4" a8da6a4f16402b40
git push origin --tags

############
# Chapter 5
############

# Add git tags to chapters
git tag -a c5 -m"Chapter 5" acb3ea19c59369
git push origin --tags

cept generate:cept acceptance RegisterNewUser
cept generate:cept acceptance EditUser
cept generate:cept acceptance DeleteUser
cept generate:stepobject acceptance CRMUsersManagementSteps


./yii migrate/create init_user_table
./yii migrate

mysqldump -d crmapp > tests/_data/dump.sql

cept build
## cept generate:test functional PasswordHashing
cept generate:test unit PasswordHashing

cept run functional --debug

# Create a new dump file to include the migrations
mysqldump crmapp > tests/_data/dump.sql

# Add a auth_key fild in user table to use "Remenber me" functionality 
./yii migrate/create add_auth_key_to_user
./yii migrate

cept generate:cept acceptance LoginAndLogout
cept run acceptance LoginAndLogoutCept

############
# Chapter 6
############

# Add git tags to chapters
git tag -a c6 -m"Chapter 6" f9db70aeac32ff
git push origin --tags

./yii migrate/create add_predefined_users
./yii migrate

# Yii2 RBAC DB migrations
./yii migrate --migrationPath='@yii/rbac/migrations'

# Ceate an database specific for the tests, 
# to avoid regenerate the dump file after each migration
## create database `crmapp_test` default character set utf8 default collate utf8_unicode_ci;

# Role Hierarchy (Roles -> Routes)
## Guest   -> site(index, login)
## User    -> Guest + customers(index, query)
## Manager -> User + customers(add) + services(index, view, create, update, delete)
## Admin   -> Manager + users(index, view, create, update, delete)

cept generate:test functional RoleHierarchy

./yii migrate/create create_roles_for_predefined_users 
./yii migrate

# Create a new dump file to include the migration
mysqldump crmapp > tests/_data/dump.sql

# Test for access control from roles hierarchy
cept generate:cept acceptance AdminAccessRights
cept generate:cept acceptance ManagerAccessRights
cept generate:cept acceptance UserAccessRights
cept generate:cept acceptance GuestAccessRights

############
# Chapter 7
############

# Add git tags to chapters
git tag -a c7 -m"Chapter 7" 0fa066f588707e
git push origin --tags

composer require --prefer-dist yiisoft/yii2-debug "*"

cept generate:suite api ApiTester
cept build

cept generate:test api ServicesListApi
cept run api

############
# Chapter 8
############

# Add git tags to chapters
git tag -a c8 -m"Chapter 8" c08efff7168b2a26f
git push origin --tags

composer require --prefer-dist yiisoft/yii2-swiftmailer "*"

./yii asset/template assets/compression/config.php

mkdir web/compiled-assets/js
mkdir web/compiled-assets/css

# Generate the compressed assets files
./yii asset assets/compression/config.php config/assets_compressed.php

############
# Chapter 9
############

# Add git tags to chapters
git tag -a c9 -m"Chapter 9" 7f1d24bae8e64a26ebf8
git push origin --tags

mkdir extensions && cd $_
> AppInfoController.php

# In Malicious extension folder
git init
git commit -a -m "Added the Composer manifest file to repo"
git tag 1.0.0

# In CRMApp folder
# http://yii2-filipe1309.c9users.io/web_app_dev_yii2_php/yii2-crmapp/web/app-info/configuration
composer require "malicious/app-info:*"

############
# Chapter 10
## Events and Behaviors
############

# Add git tags to chapters
git tag -a c10 -m"Chapter 10" f28b8e88b38c342f
git push origin --tags

cept generate:test functional CustomerAudit
cept run functional CustomerAuditTest

./yii migrate/create add_audit_fields_to_customer
./yii migrate

# Create a new dump file to include the migration
mysqldump crmapp > tests/_data/dump.sql

# Custom behavior
# http://yii2-filipe1309.c9users.io/web_app_dev_yii2_php/yii2-crmapp/web/site/behavior

# Custom event
# http://yii2-filipe1309.c9users.io/web_app_dev_yii2_php/yii2-crmapp/web/site/event

############
# Chapter 11
## The Grid
############

# Add git tags to chapters
git tag -a c11 -m"Chapter 11" b36f9172361a2a7
git push origin --tags

./yii migrate/create add_address_table
./yii migrate

# Create a new dump file to include the migration
mysqldump crmapp > tests/_data/dump.sql

./yii migrate/create add_email_table
./yii migrate

# Create a new dump file to include the migration
mysqldump crmapp > tests/_data/dump.sql


# Generate the compressed assets files after create a new asset bundle
./yii asset assets/compression/config.php config/assets_compressed.php


```

# TODO
⋅⋅ *Make the tests run in a separate db (crmapp_test)
