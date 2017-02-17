-- Käyttäjät
INSERT INTO Kayttaja (nimi, kayttajatunnus, salasana, oikeudet) VALUES ('Olli Opiskelija','oolli','noHashInBash',0);
INSERT INTO Kayttaja (nimi, kayttajatunnus, salasana, oikeudet) VALUES ('Katriina Kurssivastaava','kkurs','pahaKunEiSalausta',1);
INSERT INTO Kayttaja (nimi, kayttajatunnus, salasana, oikeudet) VALUES ('Pekka Professori','pprof','jep',1);

-- Aiheet
INSERT INTO Aihe (nimi) VALUES ('Tietojenkäsittelytiede');
INSERT INTO Aihe (nimi) VALUES ('Matematiikka');

-- Kurssit
INSERT INTO Kurssi (aihe_id, kurssivastaava_id, nimi,julkaistu,lisays_pvm) VALUES (1,3,'Tietokantojen perusteet',TRUE,NOW());
INSERT INTO Kurssi (aihe_id, kurssivastaava_id, nimi,yhteenveto,julkaistu,lisays_pvm) VALUES (1,3,'Tietokantasovellus','Tämä on yhteenveto :D Jee!',TRUE,NOW());
INSERT INTO Kurssi (aihe_id, kurssivastaava_id, nimi,julkaistu,lisays_pvm) VALUES (1,2,'Johdatus tekoälyyn',TRUE,NOW());
INSERT INTO Kurssi (aihe_id, kurssivastaava_id, nimi,julkaistu,lisays_pvm) VALUES (2,2,'Introduction to number theory',FALSE,NOW());

-- Ilmoittautumiset
INSERT INTO Ilmoittautuminen (kayttaja_id, kurssi_id, paivays) VALUES (1,2,NOW());

-- Oppitunnit
INSERT INTO Oppitunti (kurssi_id, otsikko, materiaali, tyyppi) VALUES (2, 'Viikko 2: Tee sql jutut', 'Viikko 2: Hei jou tee nää create ja drop taablit sekä testi datan lisäys. + Kaaviot', 1);
INSERT INTO Oppitunti (kurssi_id, otsikko, materiaali) VALUES (2, 'Viikko 2: How to do it', 'Viikko 2: Tässä on matskut miten jutut tehdään ja pari esimerkkiäkin...');

-- Tehtävät
INSERT INTO Tehtava (sarja_id, tehtavananto, tehtavanumero) VALUES (1, 'Tee create_table.sql', '1a');
INSERT INTO Tehtava (sarja_id, tehtavananto, tehtavanumero) VALUES (1, 'Tee drop_table.sql', '1b');
INSERT INTO Tehtava (sarja_id, tehtavananto, tehtavanumero) VALUES (1, 'Tee add_test_data.sql', '1c');
INSERT INTO Tehtava (sarja_id, tehtavananto, tehtavanumero) VALUES (1, 'Tee relaatiotietokantakaavio', '2');

-- Vastaukset
INSERT INTO Vastaus (kayttaja_id, tehtava_id, vastaus_pvm) VALUES (1, 1, NOW());
INSERT INTO Vastaus (kayttaja_id, tehtava_id, teksti, vastaus_pvm) VALUES (1, 2, 'DROP TABLE IF EXISTS Stuff CASCADE;', NOW());
INSERT INTO Vastaus (kayttaja_id, tehtava_id, vastaus_pvm) VALUES (1, 3, NOW());
INSERT INTO Vastaus (kayttaja_id, tehtava_id, teksti, vastaus_pvm) VALUES (1, 4, 'Here is a picture', NOW());


