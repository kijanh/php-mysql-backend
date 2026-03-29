# Biblioteka knjiga — MVC web aplikacija u PHP

Projektni zadatak iz predmeta **Softver inženjering**.

## Korištene tehnologije
- PHP
- MySQL
- MVC arhitektura
- Bootstrap 5
- HTML / CSS
- JavaScript

## Tema projekta
Aplikacija za evidenciju knjiga i kategorija u biblioteci.

## Funkcionalnosti
- CRUD za **kategorije**
- CRUD za **knjige**
- dvije povezane tabele: `categories` i `books`
- Bootstrap forme i responzivan dizajn
- JavaScript validacija forme
- JavaScript confirm delete
- JavaScript pretraga knjiga

## Struktura projekta
```
app/
  config/
  controllers/
  models/
  views/
public/
sql/
index.php
README.md
```

## Pokretanje projekta
1. Kopiraj projekat u `htdocs` (XAMPP) ili `www` (WAMP/Laragon).
2. Kreiraj bazu pomoću fajla `sql/biblioteka_mvc.sql`.
3. U fajlu `app/config/config.php` podesi:
   - `DB_HOST`
   - `DB_NAME`
   - `DB_USER`
   - `DB_PASS`
4. Pokreni Apache i MySQL.
5. Otvori projekat u browseru.

## GitHub predaja
Za predaju trebaš:
1. Napraviti GitHub repozitorij.
2. Uploadovati kompletan kod.
3. Dodati SQL bazu.
4. Ostaviti ovaj README opis projekta.
5. Redovno commitovati kod.
6. Dodati profesora kao collaborator-a.

## Prijedlog commit poruka
- `Initial MVC project structure`
- `Add categories CRUD`
- `Add books CRUD`
- `Add Bootstrap styling and JS features`
- `Add SQL script and README`

## Napomena
Ako profesor traži dodatne dorade, možeš lako promijeniti naziv projekta, boje, temu ili dodati login sistem.
