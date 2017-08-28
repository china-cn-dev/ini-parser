# ini-parser
PHP INI Parser

## 1.Installation via Composer

Add "chinacn/ini-parser": "~0.1" to the require block in your composer.json and then run composer install.
 ```
{
        "require": {
                "chinacn/ini-parser": "~0.1"
        }
}
```
Alternatively, you can simply run the following from the command line:

composer require chinacn/ini-parser "~0.1";

## 2.Usage

you can use code like:
```
$str=  <<<'EOT'

[numa]

interleave          = all       # Interleave

#cpunodebind         = 1         # Bind to node 1

#membind             = 1



[mysqld]

# Network

port                = 3306

socket              = /data1/mysql/tmp/mysql.sock



large-pages                      # Enable large pages

EOT;

$parser = chinacn\parser\IniParser();

$parser->parse($str);

```