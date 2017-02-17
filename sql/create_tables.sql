CREATE TABLE Kayttaja(
  id SERIAL PRIMARY KEY,
  nimi TEXT NOT NULL,
  kayttajatunnus VARCHAR(60) NOT NULL,
  salasana VARCHAR(60) NOT NULL,
  oikeudet INTEGER DEFAULT 0
);

CREATE TABLE Aihe(
  id SERIAL PRIMARY KEY,
  nimi VARCHAR(60) NOT NULL
);

CREATE TABLE Kurssi(
  id SERIAL PRIMARY KEY,
  aihe_id INTEGER NOT NULL REFERENCES Aihe(id),
  kurssivastaava_id INTEGER NOT NULL REFERENCES Kayttaja(id),
  nimi VARCHAR(120) NOT NULL,
  yhteenveto TEXT,
  julkaistu boolean DEFAULT FALSE,
  lisays_pvm DATE
);

CREATE TABLE Ilmoittautuminen(
  kayttaja_id INTEGER NOT NULL REFERENCES Kayttaja(id),
  kurssi_id INTEGER NOT NULL REFERENCES Kurssi(id),
  paivays DATE
);


CREATE TABLE Oppitunti(
  id SERIAL PRIMARY KEY,
  kurssi_id INTEGER NOT NULL REFERENCES Kurssi(id),
  otsikko VARCHAR(120) NOT NULL,
  materiaali TEXT,
  rivi INTEGER DEFAULT 0,
  tyyppi INTEGER DEFAULT 0
);

CREATE TABLE Tehtava(
  id SERIAL PRIMARY KEY,
  sarja_id INTEGER NOT NULL REFERENCES Oppitunti(id),
  tehtavananto TEXT NOT NULL,
  tehtavanumero VARCHAR(6)
);

CREATE TABLE Vastaus(
  id SERIAL PRIMARY KEY,
  kayttaja_id INTEGER NOT NULL REFERENCES Kayttaja(id),
  tehtava_id INTEGER NOT NULL REFERENCES Tehtava(id),
  teksti TEXT,
  vastaus_pvm DATE NOT NULL
);





