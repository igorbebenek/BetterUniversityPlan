<?php
namespace App\Model;

use App\Service\Config;

class Zajecia
{
    private ?int $id = null;
    private ?string $data_start = null;
    private ?string $data_koniec = null;
    private ?string $zastepca = null;
    private ?string $semestr = null;
    private ?int $wykladowca_id = null;
    private ?int $wydzial_id = null;
    private ?int $grupa_id = null;
    private ?int $tok_studiow_id = null;
    private ?int $przedmiot_id = null;
    private ?int $sala_id = null;
    private ?int $student_id = null;

    // Gettery i settery
    public function getId(): ?int { return $this->id; }
    public function setId(int $id): void { $this->id = $id; }

    public function getDataStart(): ?string { return $this->data_start; }
    public function setDataStart(string $data_start): void { $this->data_start = $data_start; }

    public function getDataKoniec(): ?string { return $this->data_koniec; }
    public function setDataKoniec(string $data_koniec): void { $this->data_koniec = $data_koniec; }

    public function getZastepca(): ?string { return $this->zastepca; }
    public function setZastepca(string $zastepca): void { $this->zastepca = $zastepca; }

    public function getSemestr(): ?string { return $this->semestr; }
    public function setSemestr(string $semestr): void { $this->semestr = $semestr; }

    public function getWykladowcaId(): ?int { return $this->wykladowca_id; }
    public function setWykladowcaId(int $wykladowca_id): void { $this->wykladowca_id = $wykladowca_id; }

    public function getWydzialId(): ?int { return $this->wydzial_id; }
    public function setWydzialId(int $wydzial_id): void { $this->wydzial_id = $wydzial_id; }

    public function getGrupaId(): ?int { return $this->grupa_id; }
    public function setGrupaId(int $grupa_id): void { $this->grupa_id = $grupa_id; }

    public function getTokStudiowId(): ?int { return $this->tok_studiow_id; }
    public function setTokStudiowId(int $tok_studiow_id): void { $this->tok_studiow_id = $tok_studiow_id; }

    public function getPrzedmiotId(): ?int { return $this->przedmiot_id; }
    public function setPrzedmiotId(int $przedmiot_id): void { $this->przedmiot_id = $przedmiot_id; }

    public function getSalaId(): ?int { return $this->sala_id; }
    public function setSalaId(int $sala_id): void { $this->sala_id = $sala_id; }

    public function getStudentId(): ?int { return $this->student_id; }
    public function setStudentId(?int $student_id): void { $this->student_id = $student_id; }

    // Metoda do tworzenia obiektu z tablicy
    public static function fromArray($array): Zajecia
    {
        $zajecia = new self();
        $zajecia->fill($array);
        return $zajecia;
    }

    // Metoda do wypełniania obiektu danymi z tablicy
    public function fill($array): Zajecia
    {
        if (isset($array['id']) && !$this->getId()) {
            $this->setId($array['id']);
        }
        if (isset($array['data_start'])) {
            $this->setDataStart($array['data_start']);
        }
        if (isset($array['data_koniec'])) {
            $this->setDataKoniec($array['data_koniec']);
        }
        if (isset($array['zastepca'])) {
            $this->setZastepca($array['zastepca']);
        }
        if (isset($array['semestr'])) {
            $this->setSemestr($array['semestr']);
        }
        if (isset($array['wykladowca_id'])) {
            $this->setWykladowcaId($array['wykladowca_id']);
        }
        if (isset($array['wydzial_id'])) {
            $this->setWydzialId($array['wydzial_id']);
        }
        if (isset($array['grupa_id'])) {
            $this->setGrupaId($array['grupa_id']);
        }
        if (isset($array['tok_studiow_id'])) {
            $this->setTokStudiowId($array['tok_studiow_id']);
        }
        if (isset($array['przedmiot_id'])) {
            $this->setPrzedmiotId($array['przedmiot_id']);
        }
        if (isset($array['sala_id'])) {
            $this->setSalaId($array['sala_id']);
        }
        if (isset($array['student_id'])) {
            $this->setStudentId($array['student_id']);
        }
        return $this;
    }

    // Metoda do zapisu/aktualizacji danych
    public function save(): void
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        if (!$this->getId()) {
            // Wstawianie nowych danych
            $sql = "INSERT INTO zajecia (data_start, data_koniec, zastepca, semestr, wykladowca_id, wydzial_id, grupa_id, tok_studiow_id, przedmiot_id, sala_id, student_id) 
                    VALUES (:data_start, :data_koniec, :zastepca, :semestr, :wykladowca_id, :wydzial_id, :grupa_id, :tok_studiow_id, :przedmiot_id, :sala_id, :student_id)";
            $statement = $pdo->prepare($sql);
            $statement->execute([
                'data_start' => $this->getDataStart(),
                'data_koniec' => $this->getDataKoniec(),
                'zastepca' => $this->getZastepca(),
                'semestr' => $this->getSemestr(),
                'wykladowca_id' => $this->getWykladowcaId(),
                'wydzial_id' => $this->getWydzialId(),
                'grupa_id' => $this->getGrupaId(),
                'tok_studiow_id' => $this->getTokStudiowId(),
                'przedmiot_id' => $this->getPrzedmiotId(),
                'sala_id' => $this->getSalaId(),
                'student_id' => $this->getStudentId(),
            ]);
            $this->setId($pdo->lastInsertId());
        } else {
            // Aktualizacja istniejącego rekordu
            $sql = "UPDATE zajecia SET data_start = :data_start, data_koniec = :data_koniec, zastepca = :zastepca, semestr = :semestr, 
                    wykladowca_id = :wykladowca_id, wydzial_id = :wydzial_id, grupa_id = :grupa_id, tok_studiow_id = :tok_studiow_id, 
                    przedmiot_id = :przedmiot_id, sala_id = :sala_id, student_id = :student_id WHERE id = :id";
            $statement = $pdo->prepare($sql);
            $statement->execute([
                'data_start' => $this->getDataStart(),
                'data_koniec' => $this->getDataKoniec(),
                'zastepca' => $this->getZastepca(),
                'semestr' => $this->getSemestr(),
                'wykladowca_id' => $this->getWykladowcaId(),
                'wydzial_id' => $this->getWydzialId(),
                'grupa_id' => $this->getGrupaId(),
                'tok_studiow_id' => $this->getTokStudiowId(),
                'przedmiot_id' => $this->getPrzedmiotId(),
                'sala_id' => $this->getSalaId(),
                'student_id' => $this->getStudentId(),
                'id' => $this->getId(),
            ]);
        }
    }

    // Metoda usuwania rekordu
    public function delete(): void
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        $sql = "DELETE FROM zajecia WHERE id = :id";
        $statement = $pdo->prepare($sql);
        $statement->execute(['id' => $this->getId()]);
    }

    // Metoda do pobrania wszystkich zajęć
    public static function findAll(): array
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        $sql = "SELECT * FROM zajecia";
        $statement = $pdo->query($sql);

        $zajeciaArray = [];
        $data = $statement->fetchAll(\PDO::FETCH_ASSOC);

        // Zamieniamy każdą tablicę na obiekt Zajecia
        foreach ($data as $item) {
            $zajeciaArray[] = self::fromArray($item);
        }

        return $zajeciaArray;
    }

    // Metoda do pobrania zajęć po ID
    public static function findById(int $id): ?Zajecia
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        $sql = "SELECT * FROM zajecia WHERE id = :id";
        $statement = $pdo->prepare($sql);
        $statement->execute(['id' => $id]);
        $data = $statement->fetch(\PDO::FETCH_ASSOC);
        if ($data) {
            $zajecia = new self();
            $zajecia->fill($data);
            return $zajecia;
        }
        return null;
    }
}
