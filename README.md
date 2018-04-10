# yii2-crmapp
This repository contains the project of a book called "Web Application Development with Yii 2 and PHP" by Mark Safronov, Jeffrey Winesett


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

// Add git tags to chapters
git tag -a c2 -m"Chapter 2" 929021e9535eaf1ac
git tag -a c3 -m"Chapter 3" 24c5c5b7bd6d7e355d
git push origin --tags

phantomjs --webdriver=4444

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

# Switch from PhpBrowser to Selenium to be able to deal with popups
# use xvfb to run headless browser
Xvfb &
java -jar selenium_sa_3.8.1.jar -enablePassThrough false
```