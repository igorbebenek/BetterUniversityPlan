-- Czyszczenie istniejących tabel, jeśli istnieją
DROP TABLE IF EXISTS Zajecia;
DROP TABLE IF EXISTS Wykladowca;
DROP TABLE IF EXISTS Grupa_Student;
DROP TABLE IF EXISTS Student;
DROP TABLE IF EXISTS Przedmiot;
DROP TABLE IF EXISTS Grupa;
DROP TABLE IF EXISTS Tok_studiow;
DROP TABLE IF EXISTS Sala_z_budynkiem;
DROP TABLE IF EXISTS Wydzial;

-- Tabela: Wydział
CREATE TABLE Wydzial (
                         id INTEGER PRIMARY KEY,     -- Klucz główny
                         nazwa TEXT NOT NULL,        -- Nazwa wydziału
                         skrot TEXT NOT NULL         -- Skrót nazwy wydziału
);

-- Tabela: Sala z budynkiem
CREATE TABLE Sala_z_budynkiem (
                                  id INTEGER PRIMARY KEY,         -- Klucz główny
                                  budynek_sala TEXT NOT NULL,     -- Pełna nazwa budynku i sali, np. "WI-101"
                                  wydzial_id INTEGER NOT NULL,    -- Klucz obcy do Wydziału
                                  FOREIGN KEY (wydzial_id) REFERENCES Wydzial(id) ON DELETE CASCADE
);

-- Tabela: Tok studiów
CREATE TABLE Tok_studiow (
                             id INTEGER PRIMARY KEY,     -- Klucz główny
                             typ TEXT NOT NULL,          -- Typ toku studiów, np. "licencjackie", "magisterskie"
                             tryb TEXT NOT NULL,         -- Tryb studiów, np. "stacjonarne", "niestacjonarne"
                             typ_skrot TEXT NOT NULL,    -- Skrót typu, np. "lic", "mgr"
                             tryb_skrot TEXT NOT NULL    -- Skrót trybu, np. "stacj.", "niestacj."
);

-- Tabela: Grupa
CREATE TABLE Grupa (
                       id INTEGER PRIMARY KEY,     -- Klucz główny
                       nazwa TEXT NOT NULL         -- Nazwa grupy, np. "Grupa A"
);

-- Tabela: Przedmiot
CREATE TABLE Przedmiot (
                           id INTEGER PRIMARY KEY,          -- Klucz główny
                           nazwa TEXT NOT NULL,             -- Nazwa przedmiotu, np. "Programowanie w PHP"
                           forma TEXT NOT NULL,             -- Forma zajęć, np. "wykład", "ćwiczenia"
                           tok_studiow_id INTEGER NOT NULL, -- Klucz obcy do Toku studiów
                           FOREIGN KEY (tok_studiow_id) REFERENCES Tok_studiow(id) ON DELETE CASCADE
);

-- Tabela: Student
CREATE TABLE Student (
                         id INTEGER PRIMARY KEY      -- Klucz główny (numer albumu studenta)
);

-- Tabela: Grupa-Student (relacja N:M między Grupą a Studentem)
CREATE TABLE Grupa_Student (
                               grupa_id INTEGER NOT NULL,      -- Klucz obcy do Grupy
                               student_id INTEGER NOT NULL,    -- Klucz obcy do Studenta
                               PRIMARY KEY (grupa_id, student_id), -- Klucz główny łączący obie kolumny
                               FOREIGN KEY (grupa_id) REFERENCES Grupa(id) ON DELETE CASCADE,
                               FOREIGN KEY (student_id) REFERENCES Student(id) ON DELETE CASCADE
);

-- Tabela: Wykładowca
CREATE TABLE Wykladowca (
                            id INTEGER PRIMARY KEY,         -- Klucz główny
                            nazwisko_imie TEXT NOT NULL     -- Pełne nazwisko i imię wykładowcy
);

-- Tabela: Zajęcia
CREATE TABLE Zajecia (
                         id INTEGER PRIMARY KEY,         -- Klucz główny
                         data_start TEXT NOT NULL,       -- Data i godzina rozpoczęcia zajęć
                         data_koniec TEXT NOT NULL,      -- Data i godzina zakończenia zajęć
                         zastepca TEXT,                  -- Opcjonalna informacja o zastępcy wykładowcy
                         semestr INTEGER NOT NULL,       -- Semestr, np. 1, 2, 3
                         wykladowca_id INTEGER NOT NULL, -- Klucz obcy do Wykładowcy
                         wydzial_id INTEGER NOT NULL,    -- Klucz obcy do Wydziału
                         grupa_id INTEGER NOT NULL,      -- Klucz obcy do Grupy
                         tok_studiow_id INTEGER NOT NULL,-- Klucz obcy do Toku studiów
                         przedmiot_id INTEGER NOT NULL,  -- Klucz obcy do Przedmiotu
                         sala_id INTEGER NOT NULL,       -- Klucz obcy do Sali z budynkiem
                         student_id INTEGER,             -- Klucz obcy do Studenta (opcjonalnie)
                         FOREIGN KEY (wykladowca_id) REFERENCES Wykladowca(id) ON DELETE CASCADE,
                         FOREIGN KEY (wydzial_id) REFERENCES Wydzial(id) ON DELETE CASCADE,
                         FOREIGN KEY (grupa_id) REFERENCES Grupa(id) ON DELETE CASCADE,
                         FOREIGN KEY (tok_studiow_id) REFERENCES Tok_studiow(id) ON DELETE CASCADE,
                         FOREIGN KEY (przedmiot_id) REFERENCES Przedmiot(id) ON DELETE CASCADE,
                         FOREIGN KEY (sala_id) REFERENCES Sala_z_budynkiem(id) ON DELETE CASCADE,
                         FOREIGN KEY (student_id) REFERENCES Student(id) ON DELETE SET NULL
);
