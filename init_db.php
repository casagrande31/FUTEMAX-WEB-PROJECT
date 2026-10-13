
CREATE TABLE IF NOT EXISTS "produtos" (
	"id"	INTEGER,
	"nome"	TEXT NOT NULL,
	"descricao"	TEXT,
	"sexo"	TEXT,
	"quantidade"	INTEGER,
	"imagem"	TEXT,
	"id_usuario"	INTEGER,
	PRIMARY KEY("id" AUTOINCREMENT),
	FOREIGN KEY("id_usuario") REFERENCES "usuarios"("id")
);
CREATE TABLE IF NOT EXISTS "usuarios" (
	"id"	INTEGER,
	"usuario"	TEXT NOT NULL UNIQUE,
	"senha"	TEXT NOT NULL,
	PRIMARY KEY("id" AUTOINCREMENT)
);
