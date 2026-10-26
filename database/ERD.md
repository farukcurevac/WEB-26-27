# KICKS & CO. - Draft ERD

Ovo je planski model baze za sneaker store. Model je namjerno odvojen od
implementacije baze; tabele i kolone mogu se prilagoditi kada se bude radio
backend.

## Entity-Relationship Diagram

```mermaid
erDiagram
    USERS ||--o| CART_ITEMS : "ima"
    PRODUCTS ||--o{ CART_ITEMS : "nalazi se u"
    BRANDS ||--o{ PRODUCTS : "proizvodi"
    CATEGORIES ||--o{ PRODUCTS : "grupise"
    USERS ||--o{ ORDERS : "kreira"
    ORDERS ||--|{ ORDER_ITEMS : "sadrzi"
    PRODUCTS ||--o{ ORDER_ITEMS : "narucen je"
    ORDERS ||--o| PAYMENTS : "ima"

    USERS {
        int id PK
        string first_name
        string last_name
        string email UK
        string password_hash
        datetime created_at
    }

    BRANDS {
        int id PK
        string name UKAQ
        string logo_url
    }

    CATEGORIES {
        int id PK
        string name UK
        string description
    }

    PRODUCTS {
        int id PK
        int brand_id FK
        int category_id FK
        string name
        string description
        decimal price
        string image_url
        boolean is_active
        datetime created_at
    }

    CART_ITEMS {
        int id PK
        int user_id FK
        int product_id FK
        int quantity
        datetime created_at
    }

    ORDERS {
        int id PK
        int user_id FK
        decimal total_amount
        string status
        string shipping_address
        datetime created_at
    }

    ORDER_ITEMS {
        int id PK
        int order_id FK
        int product_id FK
        int quantity
        decimal unit_price
    }

    PAYMENTS {
        int id PK
        int order_id FK
        decimal amount
        string method
        string status
        string transaction_reference
        datetime paid_at
    }
```

## Entiteti

| Entitet | Namjena |
|---|---|
| `users` | Korisnički nalozi i podaci potrebni za prijavu. |
| `brands` | Brendovi kao što su Nike, Adidas, Puma i New Balance. |
| `categories` | Grupe proizvoda, npr. muške, ženske ili lifestyle patike. |
| `products` | Katalog proizvoda, cijene, slike i pripadni brend/kategorija. |
| `cart_items` | Proizvodi koje je korisnik dodao u svoju korpu. |
| `orders` | Zaglavlje narudžbe, korisnik, status, adresa i ukupan iznos. |
| `order_items` | Stavke unutar narudžbe i cijena proizvoda u trenutku kupovine. |
| `payments` | Podaci o pokušaju ili uspjehu plaćanja narudžbe. |

## Relacije i pravila

- Jedan korisnik može imati više stavki u korpi, a svaki proizvod može biti u
  korpama više korisnika.
- Svaki proizvod pripada jednom brendu i jednoj kategoriji.
- Jedan korisnik može kreirati više narudžbi.
- Narudžba mora imati najmanje jednu stavku narudžbe.
- Isti proizvod može se pojaviti u više narudžbi.
- Jedna narudžba može imati najviše jedno plaćanje u ovoj početnoj verziji.
- `order_items.unit_price` čuva cijenu u trenutku kupovine, kako kasnije
  promjena cijene proizvoda ne bi promijenila historiju narudžbe.

## Zašto je ovaj model preporučen

Ovih osam entiteta pokrivaju kompletan osnovni tok web shopa: katalog,
korpu, korisnika, narudžbu i plaćanje. `cart_items` i `order_items` su
odvojeni jer korpa predstavlja trenutno stanje, dok `order_items` predstavlja
historijski zapis već kreirane narudžbe.
