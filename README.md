PlatyUredniku

# Jak spustit

Stačí spustit hotový docker image a protože je to napojeno na stejnou MySQL databázy jako texty.hlidacstatu.cz, tak je potřeba ještě připojit do stejné docker sítě, jako mysql.

```
docker run -d --name platyuredniku hlidacstatu/platyuredniku:latest

docker network connect platyuredniku platyuredniku
```

# V případě nasazení od nuly

- vytvořit network `docker network create platyuredniku`

- nainstalovat databázi !MariaDb! - přesně verzi 10.1.38

```
docker run -d --network platyuredniku --name platyurednikudb --env MYSQL_USER=platyuredniku_cz --env MYSQL_PASSWORD=WuodukOmUj0 --env MYSQL_ROOT_PASSWORD=mafasfeDc3 --env MYSQL_DATABASE=platyuredniku_cz_db  mariadb:10.1.38
```

- v souboru `config.php` umístěném v `src\admin\core\` je potřeba nastavit správné přístupy do db (tenhle krok není potřeba, pokud použijeme všechny ostatní kroky z tohohle návodu)
- pro vytvoření databáze v dockeru z dumpu je potřeba nakopírovat sqldump

```
docker cp platyuredniku/backup-2022-02-24.sqldump platyurednikudb:/var/
docker exec -it platyurednikudb /bin/bash
```

- a spustit `mysql -u platyuredniku_cz -p platyuredniku_cz_db < /var/backup-2022-02-24.sqldump`

## Přidání nového uživatele

- přidat uživatele insertem do db
- hash hesla vytvořit pomocí tyhle php funkce `md5(sha1(str_replace(substr("heslo", 0, intval(strlen("heslo")/2)), "", "heslo")).md5("heslo").sha1(substr("heslo", 0, intval(strlen("heslo")/2))));` 
