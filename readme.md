Kod reprezentuje przykładową implementację DDD dla przykładowego contextu Shop (sklepy) zostały zawarte podstawowe koncepty architektury architektury heksagonalnej. Dla uproszczenia nie została zaimplementowana warstwa infrastruktury oraz nie został dodane żaden framework.

Aby zbudować środowisko oparte o php (docker) należy za pierwszy razem wykonać **make build**, po zbudowaniu obrazu w celu pobrania paczek composera proszę wykonać **make bash** a następnie **composer install**.

W celu zweryfikowania czy wszystko działa poprawnie proszę wykonać **make test**.

Aktualnie kod pozwala na dodanie nowego sklepu oraz zmianę jego nazwy. Proszę się zapoznać z kodem, na jego podstawie dodamy / dostosujemy dodatkowe funkcjonalności.
