
PRAGMA foreign_keys = ON;

CREATE TABLE IF NOT EXISTS pessoa (
    chave INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    login TEXT UNIQUE NOT NULL,
    dt_nascimento REAL NOT NULL,
    url_foto TEXT,
    interesse_homens INTEGER NOT NULL,
    interesse_mulheres INTEGER NOT NULL,
    sexo TEXT NOT NULL,
    CHECK (interesse_homens = 1 OR interesse_homens = 0),
    CHECK (interesse_mulheres = 1 OR interesse_mulheres = 0),
    CHECK (sexo = 'M' OR sexo = 'F'),
    CHECK (date(dt_nascimento) IS NOT NULL),
    CHECK ((LENGTH(url_foto) > 10 OR LENGHT(url_foto) < 1000) OR url_foto IS NULL)
 )