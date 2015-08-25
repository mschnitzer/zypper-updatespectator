# zypper-updatespectator
A update spectator script for zypper.

The script collects all available updates for the OS and holds the packages (which can be updated) in a PHP array. This script can be integrated in existing projects. Nothing special but I needed that especially for me.

For example:
```
Array
(
    [0] => Array
        (
            [repository] => Network
            [name] => dnsmasq
            [installed_version] => 2.75-89.1
            [available_version] => 2.75-90.1
            [arch] => x86_64
        )

    [1] => Array
        (
            [repository] => DocuRepo
            [name] => docmanager
            [installed_version] => 3.3.0-1.1
            [available_version] => 3.3.1-1.1
            [arch] => noarch
        )

)
```

Maybe there is a better method. If so, please let me know.
