CREATE TABLE Wydzial (
                         id INTEGER PRIMARY KEY,
                         nazwa TEXT NOT NULL,
                         skrot TEXT NOT NULL
);

CREATE TABLE Sala_z_budynkiem (
                                  id INTEGER PRIMARY KEY,
                                  budynek_sala TEXT NOT NULL,
                                  wydzial_id INTEGER NOT NULL,
                                  FOREIGN KEY (wydzial_id) REFERENCES Wydzial(id) ON DELETE CASCADE
);

CREATE TABLE Tok_studiow (
                             id INTEGER PRIMARY KEY,
                             typ TEXT NOT NULL,
                             tryb TEXT NOT NULL,
                             typ_skrot TEXT NOT NULL,
                             tryb_skrot TEXT NOT NULL
);

CREATE TABLE Grupa (
                       id INTEGER PRIMARY KEY,
                       nazwa TEXT NOT NULL
);

CREATE TABLE Przedmiot (
                           id INTEGER PRIMARY KEY,
                           nazwa TEXT NOT NULL,
                           forma TEXT NOT NULL,
                           tok_studiow_id INTEGER NOT NULL,
                           FOREIGN KEY (tok_studiow_id) REFERENCES Tok_studiow(id) ON DELETE CASCADE
);

CREATE TABLE Student (
                         id INTEGER PRIMARY KEY
);

CREATE TABLE Grupa_Student (
                               grupa_id INTEGER NOT NULL,
                               student_id INTEGER NOT NULL,
                               PRIMARY KEY (grupa_id, student_id),
                               FOREIGN KEY (grupa_id) REFERENCES Grupa(id) ON DELETE CASCADE,
                               FOREIGN KEY (student_id) REFERENCES Student(id) ON DELETE CASCADE
);

CREATE TABLE Wykladowca (
                            id INTEGER PRIMARY KEY,
                            nazwisko_imie TEXT NOT NULL
);

CREATE TABLE Zajecia (
                         id INTEGER PRIMARY KEY,
                         data_start TEXT NOT NULL,
                         data_koniec TEXT NOT NULL,
                         zastepca TEXT,
                         semestr INTEGER NOT NULL,
                         wykladowca_id INTEGER NOT NULL,
                         wydzial_id INTEGER NOT NULL,
                         grupa_id INTEGER NOT NULL,
                         tok_studiow_id INTEGER NOT NULL,
                         przedmiot_id INTEGER NOT NULL,
                         sala_id INTEGER NOT NULL,
                         student_id INTEGER,
                         FOREIGN KEY (wykladowca_id) REFERENCES Wykladowca(id) ON DELETE CASCADE,
                         FOREIGN KEY (wydzial_id) REFERENCES Wydzial(id) ON DELETE CASCADE,
                         FOREIGN KEY (grupa_id) REFERENCES Grupa(id) ON DELETE CASCADE,
                         FOREIGN KEY (tok_studiow_id) REFERENCES Tok_studiow(id) ON DELETE CASCADE,
                         FOREIGN KEY (przedmiot_id) REFERENCES Przedmiot(id) ON DELETE CASCADE,
                         FOREIGN KEY (sala_id) REFERENCES Sala_z_budynkiem(id) ON DELETE CASCADE,
                         FOREIGN KEY (student_id) REFERENCES Student(id) ON DELETE SET NULL
);
