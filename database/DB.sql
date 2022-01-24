CREATE DATABASE IF NOT EXISTS destiniaDB;

CREATE table if not exists meaningQuery(
    id int not null auto_increment PRIMARY KEY,
    query VARCHAR(60) NOT NULL,
    typeLang varchar(60) NOT NULL,
    meaning varchar(256) NOT NULL
);


INSERT INTO meaningQuery (query, typeLang, meaning) VALUES
('hola','UTF-8','saludo'),
('adios','UTF-8','despedida'),
('coche','UTF-8','vehiculo de cuatro ruedas'),
('avion','UTF-8','vehiculo volador'),
('moto','UTF-8','vehiculo de dos ruedas');