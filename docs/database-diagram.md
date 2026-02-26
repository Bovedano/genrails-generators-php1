# Database Diagram

Diagrama de entidades de las tablas `user` y `blog`.

> Ver diagrama renderizado: [plantuml.com](https://www.plantuml.com/plantuml/uml/dP9FIyD05CJl-HIFN5ABkGZr449fr8YbfYqr4MzXctsKnSrkt3-Aj7vtsRhHKYg8rvdXzuRXJRGXojYM1m4AmymxX5QZ2c4R000CWL58eAgcDv2cozbul9VZsBk2j0W9F6QhwxjiDRWOZSwyWorX_CY2DBM2lLZqc25qHEitgUXfXfBSqVDvLGmYLoiwZmXjcOZw16aCUtMPgyNYFi_cNbvpsJmZFTBtOMAO57KZwM7lovxNA2G6QKqC951EY_oXp8gbDsr7JvaVFzEjkTpyTJh33FzbEugwKQnpJTsb_Adi6sXKzI7sTlOzvJ-hEoJiTd4ijsws3IHV7r0p6WR110MrBVy4)

```plantuml
@startuml

entity "user" {
    * id : UUID <<PK>>
    --
    * name : VARCHAR(255)
    * email : VARCHAR(255) <<unique>>
    * password : VARCHAR(255)
    * role : ENUM('user','admin')
    * active : BOOLEAN
    * blocked : BOOLEAN
    activation_code : VARCHAR(6)
    * created_at : TIMESTAMP
    * updated_at : TIMESTAMP
}

entity "blog" {
    * id : UUID <<PK>>
    --
    * title : VARCHAR(255)
    * description : TEXT
    * user_id : UUID <<FK>>
    * created_at : TIMESTAMP
    * updated_at : TIMESTAMP
}

user ||--o{ blog : "user_id"

@enduml
```

**Convenciones:**
- `*` = campo requerido (NOT NULL)
- sin `*` = nullable
- `<<PK>>` = primary key
- `<<FK>>` = foreign key
- `||--o{` = un user tiene cero o muchos blogs
