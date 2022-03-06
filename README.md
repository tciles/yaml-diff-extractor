# yaml-diff-extrator
YAML diff extraction

## PhpUnit
Default configuration to put on `phpunit.xml`.
```xml
<?xml version="1.0"?>
<phpunit xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
         xsi:noNamespaceSchemaLocation="https://schema.phpunit.de/9.3/phpunit.xsd" backupGlobals="true"
         backupStaticAttributes="false" cacheResult="false" colors="true" convertErrorsToExceptions="true"
         convertNoticesToExceptions="true" convertWarningsToExceptions="true" forceCoversAnnotation="false"
         processIsolation="false" stopOnError="false" stopOnFailure="false" stopOnIncomplete="false"
         stopOnSkipped="false" stopOnRisky="false" timeoutForSmallTests="1" timeoutForMediumTests="10"
         timeoutForLargeTests="60" verbose="true">
    <coverage/>
    <testsuites>
        <testsuite name="Main Test Suite">
            <directory suffix="Test.php" phpVersion="5.3.0" phpVersionOperator=">=">tests</directory>
            <exclude>src</exclude>
        </testsuite>
    </testsuites>
</phpunit>
```

Run unit tests via:
```shell
make unit
# or
./vendor/bin/phpunit [ --configuration phpunit.xml ]
```