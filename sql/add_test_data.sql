-- Käyttäjät
INSERT INTO Kayttaja (nimi, tunnus, salasana, oikeudet) VALUES ('Olli Opiskelija','oolli','noHashInBash',0);
INSERT INTO Kayttaja (nimi, tunnus, salasana, oikeudet) VALUES ('Katriina Kurssivastaava','kkurs','pahaKunEiSalausta',1);
INSERT INTO Kayttaja (nimi, tunnus, salasana, oikeudet) VALUES ('Pekka Professori','pprof','jep',1);

-- Aiheet
INSERT INTO Aihe (nimi) VALUES ('Tietojenkäsittelytiede');
INSERT INTO Aihe (nimi) VALUES ('Matematiikka');

-- Kurssit
INSERT INTO Kurssi (kurssivastaava_id, nimi,julkaistu,lisays_pvm) VALUES (1,'Tietokantojen perusteet',TRUE,NOW());
INSERT INTO Kurssi (kurssivastaava_id, nimi,julkaistu,lisays_pvm) VALUES (1,'Tietokantasovellus',TRUE,NOW());
INSERT INTO Kurssi (kurssivastaava_id, nimi,julkaistu,lisays_pvm) VALUES (2,'Johdatus tekoälyyn',TRUE,NOW());
INSERT INTO Kurssi (kurssivastaava_id, nimi,julkaistu,lisays_pvm) VALUES (2,'Introduction to number theory',FALSE,NOW());

-- Ilmoittautumiset
INSERT INTO Ilmoittauminen (kayttaja_id, kurssi_id, ilmoittautumis_pvm) VALUES (0,1,NOW());

-- Oppitunnit
INSERT INTO Oppitunti (kurssi_id, otsikko, materiaali, tyyppi) VALUES (1, 'Viikko 2: Tee sql jutut', 'Viikko 2: Hei jou tee nää create ja drop taablit sekä testi datan lisäys. + Kaaviot', 1);
INSERT INTO Oppitunti (kurssi_id, otsikko, materiaali) VALUES (1, 'Viikko 2: How to do it', 'Viikko 2: Tässä on matskut miten jutut tehdään ja pari esimerkkiäkin...');

-- Tehtävät
INSERT INTO Tehtava (sarja_id, tehtavananto, numero) VALUES (0, 'Tee create_table.sql', '1a');
INSERT INTO Tehtava (sarja_id, tehtavananto, numero) VALUES (0, 'Tee drop_table.sql', '1b');
INSERT INTO Tehtava (sarja_id, tehtavananto, numero) VALUES (0, 'Tee add_test_data.sql', '1c');
INSERT INTO Tehtava (sarja_id, mallivastaus_id, tehtavananto, numero) VALUES (0, 0, 'Tee relaatiotietokantakaavio', '2');

-- Vastaukset
INSERT INTO Vastaus (kayttaja_id, tehtava_id, vastaus_pvm) VALUES (0, 0, NOW());
INSERT INTO Vastaus (kayttaja_id, tehtava_id, teksti, vastaus_pvm) VALUES (0, 1, 'DROP TABLE IF EXISTS Stuff CASCADE;', NOW());
INSERT INTO Vastaus (kayttaja_id, tehtava_id, vastaus_pvm) VALUES (0, 2, NOW());
INSERT INTO Vastaus (kayttaja_id, tehtava_id, teksti, vastaus_pvm) VALUES (0, 3, 'Here is a picture', NOW());


