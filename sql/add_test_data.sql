-- Käyttäjät
INSERT INTO Kayttaja (nimi, kayttajatunnus, salasana, oikeudet) VALUES ('Olli Opiskelija','oolli','noHashInBash',0);
INSERT INTO Kayttaja (nimi, kayttajatunnus, salasana, oikeudet) VALUES ('Katriina Kurssivastaava','kkurs','pahaKunEiSalausta',1);
INSERT INTO Kayttaja (nimi, kayttajatunnus, salasana, oikeudet) VALUES ('Pekka Professori','pprof','jep',1);
INSERT INTO Kayttaja (nimi, kayttajatunnus, salasana, oikeudet) VALUES ('Veera Vierailija','vveer','salasana',0);

-- Aiheet
INSERT INTO Aihe (nimi) VALUES ('Tietojenkäsittelytiede');
INSERT INTO Aihe (nimi) VALUES ('Matematiikka');

-- Kurssit
INSERT INTO Kurssi (aihe_id, kurssivastaava_id, nimi,yhteenveto,julkaistu,lisays_pvm) VALUES (1,3,'Tietokantojen perusteet','HUOM! Koe on perjantaina 10.3 salissa B123',TRUE,NOW());
INSERT INTO Kurssi (aihe_id, kurssivastaava_id, nimi,yhteenveto,julkaistu,lisays_pvm) VALUES (1,3,'Tietokantasovellus','Tämä on yhteenveto :D Jee!',TRUE,'2017-01-01');
INSERT INTO Kurssi (aihe_id, kurssivastaava_id, nimi,julkaistu,lisays_pvm) VALUES (1,2,'Johdatus tekoälyyn',FALSE,NOW());
INSERT INTO Kurssi (aihe_id, kurssivastaava_id, nimi,yhteenveto,julkaistu,lisays_pvm) VALUES (2,2,'Introduction to number theory','More information later',TRUE,NOW());
INSERT INTO Kurssi (aihe_id, kurssivastaava_id, nimi,yhteenveto,julkaistu,lisays_pvm) VALUES (2,2,'Bayesian Networks','This is an in-depth course about Bayesian probability theory and the use of Bayesian networks in abstract mathematical models.',TRUE,'2017-02-05');

-- Ilmoittautumiset
INSERT INTO Ilmoittautuminen (kayttaja_id, kurssi_id, paivays) VALUES (1,2,NOW());
INSERT INTO Ilmoittautuminen (kayttaja_id, kurssi_id, paivays) VALUES (1,4,NOW());
INSERT INTO Ilmoittautuminen (kayttaja_id, kurssi_id, paivays) VALUES (4,4,NOW());
INSERT INTO Ilmoittautuminen (kayttaja_id, kurssi_id, paivays) VALUES (4,5,NOW());

-- Oppitunnit
INSERT INTO Oppitunti (kurssi_id, otsikko, materiaali, tyyppi) VALUES (2, 'Viikko 1: Setup','Katsokaa materiaalista apua', 1);
INSERT INTO Oppitunti (kurssi_id, otsikko, materiaali) VALUES (2, 'Viikko 1: Materiaali', 'Web-sovellusten toiminta perustuu asiakas- ja palvelinkoneiden väliseen kommunikointiin, jossa asiakas pyytää palvelua, jonka palvelin tarjoaa. Käytännössä, kun avaat sivun selaimellasi (esimerkiksi Firefox tai Google Chrome), toimit asiakkaana sivua tarjoavalle palvelimelle.
Selaimessa tehdyt pyynnöt kohdistuvat URL:hin, kuten esimerkiksi http://www.cs.helsinki.fi/courses. URL:n ensimmäinen osa on yleensä DNS-nimi, joka on esimerkissämme www.cs.helsinki.fi. DNS-nimen avulla pystytään selvittämään www-sivua hallinnoivan palvelimen osoite. Toinen osa taas viittaa palvelimelta hakemaamme resurssiin, joka on esimerkissämme courses. Katsotaan seuraavaksi, minkälaisia vastauksia palvelin antaa pyyntöihimme käytännössä.');
INSERT INTO Oppitunti (kurssi_id, otsikko, materiaali, tyyppi) VALUES (2, 'Viikko 2: Setup','Katsokaa materiaalista apua', 1);
INSERT INTO Oppitunti (kurssi_id, otsikko, materiaali) VALUES (2, 'Viikko 2: Materiaali', 'MVC-malli (model-view-controller) on nykyään hyvin yleinen web-sovellusten toteutusmalli, jonka tarkoituksena on erottaa näkymä sovelluslogiikasta. Siinä sovellus jaetaan kolmeen osaan:

- malliin (model), joka mahdollistaa tietokannasta haetun tiedon esittämisen sovelluksen kannalta mielekkäässä muodossa, eli yleensä olioina, jolloin kukin malli kuvaa yhtä sovelluksen tietokohteista (esim. Asiakas, Tuote, Opiskelija, jne.). Kaikki tietokantaan kohdistuvat kyselyt suoritetaan mallien kautta.
- näkymään (view), joka määrittää sovelluksen käyttöliittymän ulkoasun ja tiedon esitysmuodon. Sen kautta lähetään myös käyttäjän syöttämiä tietoja sovellukselle esimerkiksi lomakkeiden kautta.
- kontrolleriin (controller), joka toimii liimana näkymän ja mallin välissä. Se käsittelee selaimen lähettämät pyynnöt, välittää mallilta saamansa sisällön näkymälle tai pyytää mallia tekemään muutoksia tietokantaan.');

-- Tehtävät
INSERT INTO Tehtava (sarja_id, tehtavananto, tehtavanumero) VALUES (1, 'NetBeans yms.', '1');
INSERT INTO Tehtava (sarja_id, tehtavananto, tehtavanumero) VALUES (1, 'Dokumentaatio yms.', '2');
INSERT INTO Tehtava (sarja_id, tehtavananto, tehtavanumero) VALUES (3, 'Tee create_table.sql', '1a');
INSERT INTO Tehtava (sarja_id, tehtavananto, tehtavanumero) VALUES (3, 'Tee drop_table.sql', '1b');
INSERT INTO Tehtava (sarja_id, tehtavananto, tehtavanumero) VALUES (3, 'Tee add_test_data.sql', '1c');
INSERT INTO Tehtava (sarja_id, tehtavananto, tehtavanumero) VALUES (3, 'Tee relaatiotietokantakaavio', '2');

-- Vastaukset
-- INSERT INTO Vastaus (kayttaja_id, tehtava_id, vastaus_pvm) VALUES (1, 1, NOW());
-- INSERT INTO Vastaus (kayttaja_id, tehtava_id, teksti, vastaus_pvm) VALUES (1, 2, 'DROP TABLE IF EXISTS Stuff CASCADE;', NOW());
-- INSERT INTO Vastaus (kayttaja_id, tehtava_id, vastaus_pvm) VALUES (1, 3, NOW());
-- INSERT INTO Vastaus (kayttaja_id, tehtava_id, teksti, vastaus_pvm) VALUES (1, 4, 'Here is a picture', NOW());


