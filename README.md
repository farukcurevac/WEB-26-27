# KICKS & CO.

KICKS & CO. je web shop za premium patike. Trenutna verzija projekta predstavlja
statički frontend organizovan kao single-page application (SPA). Backend i baza
su planirani za narednu fazu razvoja.

## Tehnologije

- HTML5, CSS3 i JavaScript
- Bootstrap 5
- jQuery i SPAPP za SPA navigaciju
- PHP backend (planirano)
- MySQL baza podataka (planirano)

## Pokretanje

Projekat se pokreće preko lokalnog web servera, na primjer Apache-a u XAMPP-u:

```text
http://localhost/WEB-26-27/frontend/
```

SPA rute:

- `#home`
- `#login`
- `#register`
- `#cart`
- `#brends`

View fajlovi se nalaze u [frontend/views](frontend/views), a zajednički stilovi i
JavaScript u [frontend/assets](frontend/assets).

## Planirane funkcionalnosti

- registracija i prijava korisnika;
- pregled brendova, kategorija i proizvoda;
- dodavanje proizvoda u korpu;
- promjena količine i uklanjanje proizvoda iz korpe;
- kreiranje narudžbe;
- evidencija statusa narudžbe i plaćanja;
- korisnički profil i historija narudžbi.

## Plan external API funkcionalnosti

External API će se planirati za prikaz kursa valuta i preračunavanje cijena
proizvoda iz KM u EUR. API poziv će se koristiti na stranici proizvoda ili u
sažetku korpe, dok će osnovne cijene u bazi ostati u KM.

Ova funkcionalnost nije potrebna za trenutni statički milestone i biće dodata u
kasnijoj fazi.

## Struktura projekta

```text
WEB-26-27/
├── backend/
│   └── rest/
│       ├── dao/
│       ├── routes/
│       └── services/
├── database/
│   └── ERD.md
├── frontend/
│   ├── assets/
│   │   ├── css/
│   │   └── js/
│   └── views/
└── README.md
```

## Database planning

Draft ERD sa osam planiranih entiteta i njihovim relacijama nalazi se u
[database/ERD.md](database/ERD.md).
