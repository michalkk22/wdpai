### Opis Strony
Strona internetowa umożliwia użytkownikom dodawanie postów i komentarzy pod postami. Każdy użytkownik może usuwać własne posty i komentarze, a użytkownik z uprawnieniami administratora może usuwać dowolne. Dane konta użytkownika zapisane są w sesji.

### Widoki i funkcjonalność

![0](w0.PNG)
![1](w1.PNG)

Posty na stronie głównej mogą być filtrowane wg kategorii lub tekstu.

![2](w2.PNG)
![3](w3.PNG)

Post z perspektywy admina:

![4](w4.PNG)

Post z perspektywy zwykłego użytkownika:

![5](w5.PNG)

Tworzenie posta:

![6](w6.PNG)

Widok mobilny:

![7](w7.PNG)
![8](w8.PNG)
![9](w9.PNG)
![10](w10.PNG)

### Struktura Bazy Danych

Diagram relacji:

![4](db_diagram.png)

### Instrukcja uruchomienia

W folderze z repozytorium należy wywołać komendy:
```
docker-compose up --build
docker cp db.sql postgres_db:/tmp/db.sql
docker exec -it postgres_db bash
pg_restore -U myuser -d mydatabase /tmp/db.sql
```

Jest to:
1. budowa i uruchomienie kontenera docker
2. skopiowanie do woluminu backupu bazy danych
3. uruchomienie konsoli kontenera
4. przywrócenie bazy danych