
CREATE TABLE Wydzial (
                         id INT AUTO_INCREMENT PRIMARY KEY,
                         nazwa VARCHAR(255) NOT NULL,
                         skrot VARCHAR(50) NOT NULL
);

CREATE TABLE Sala_z_budynkiem (
                                  id INT AUTO_INCREMENT PRIMARY KEY,
                                  budynek_sala VARCHAR(255) NOT NULL,
                                  wydzial_id INT NOT NULL,
                                  FOREIGN KEY (wydzial_id) REFERENCES Wydzial(id) ON DELETE CASCADE
);

CREATE TABLE Tok_studiow (
                             id INT AUTO_INCREMENT PRIMARY KEY,
                             typ VARCHAR(50) NOT NULL,
                             tryb VARCHAR(50) NOT NULL,
                             typ_skrot VARCHAR(10) NOT NULL,
                             tryb_skrot VARCHAR(10) NOT NULL
);

CREATE TABLE Grupa (
                       id INT AUTO_INCREMENT PRIMARY KEY,
                       nazwa VARCHAR(255) NOT NULL
);

CREATE TABLE Przedmiot (
                           id INT AUTO_INCREMENT PRIMARY KEY,
                           nazwa VARCHAR(255) NOT NULL,
                           forma VARCHAR(50) NOT NULL,
                           tok_studiow_id INT NOT NULL,
                           FOREIGN KEY (tok_studiow_id) REFERENCES Tok_studiow(id) ON DELETE CASCADE
);
CREATE TABLE Student (
                         id INT PRIMARY KEY
);

CREATE TABLE Grupa_Student (
                               grupa_id INT NOT NULL,
                               student_id INT NOT NULL,
                               PRIMARY KEY (grupa_id, student_id),
                               FOREIGN KEY (grupa_id) REFERENCES Grupa(id) ON DELETE CASCADE,
                               FOREIGN KEY (student_id) REFERENCES Student(id) ON DELETE CASCADE
);

CREATE TABLE Wykladowca (
                            id INT AUTO_INCREMENT PRIMARY KEY,
                            nazwisko_imie VARCHAR(255) NOT NULL
);

CREATE TABLE Zajecia (
                         id INT AUTO_INCREMENT PRIMARY KEY,
                         data_start DATETIME NOT NULL,
                         data_koniec DATETIME NOT NULL,
                         zastepca VARCHAR(255),
                         semestr INT NOT NULL,
                         wykladowca_id INT NOT NULL,
                         wydzial_id INT NOT NULL,
                         grupa_id INT NOT NULL,
                         tok_studiow_id INT NOT NULL,
                         przedmiot_id INT NOT NULL,
                         sala_id INT NOT NULL,
                         student_id INT,
                         FOREIGN KEY (wykladowca_id) REFERENCES Wykladowca(id) ON DELETE CASCADE,
                         FOREIGN KEY (wydzial_id) REFERENCES Wydzial(id) ON DELETE CASCADE,
                         FOREIGN KEY (grupa_id) REFERENCES Grupa(id) ON DELETE CASCADE,
                         FOREIGN KEY (tok_studiow_id) REFERENCES Tok_studiow(id) ON DELETE CASCADE,
                         FOREIGN KEY (przedmiot_id) REFERENCES Przedmiot(id) ON DELETE CASCADE,
                         FOREIGN KEY (sala_id) REFERENCES Sala_z_budynkiem(id) ON DELETE CASCADE,
                         FOREIGN KEY (student_id) REFERENCES Student(id) ON DELETE SET NULL
);
