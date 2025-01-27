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

    private ?string $teacher_name = null;
    private ?string $room_name = null;
    private ?string $subject_name = null;

    // Gettery i settery dla relacji
    public function getTeacherName(): ?string { return $this->teacher_name; }
    public function setTeacherName(?string $teacher_name): void { $this->teacher_name = $teacher_name; }

    private ?string $lesson_type = null;

    public function getLessonType(): ?string {
        return $this->lesson_type ? $this->sanitizeClassName($this->lesson_type) : null;
    }

    public function setLessonType(?string $lesson_type): void {
        $this->lesson_type = $lesson_type;
    }

    public static function findFilteredWithRelations(array $filters): array
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));

        $query = "
SELECT DISTINCT 
    z.id AS zajecia_id,
    z.data_start,
    z.data_koniec,
    w.nazwisko_imie AS teacher_name,
    s.budynek_sala AS room_name,
    p.nazwa AS subject_name,
    p.forma AS lesson_type
FROM 
    zajecia z
LEFT JOIN 
    wykladowca w ON z.wykladowca_id = w.id
LEFT JOIN 
    sala_z_budynkiem s ON z.sala_id = s.id
LEFT JOIN 
    przedmiot p ON z.przedmiot_id = p.id
WHERE 
    1=1
";


        $params = [];

        // Filtr nauczyciela
        if (!empty($filters['teacher'])) {
            $query .= " AND w.nazwisko_imie LIKE :teacher";
            $params['teacher'] = '%' . $filters['teacher'] . '%';
        }

        // Filtr sali
        if (!empty($filters['room'])) {
            $query .= " AND s.budynek_sala LIKE :room";
            $params['room'] = '%' . $filters['room'] . '%';
        }

        // Filtr przedmiotu
        if (!empty($filters['subject'])) {
            $query .= " AND p.nazwa LIKE :subject";
            $params['subject'] = '%' . $filters['subject'] . '%';
        }

        // Filtr numeru studenta
        if (!empty($filters['student_number'])) {
            $query .= " AND z.student_id = :student_number";
            $params['student_number'] = $filters['student_number'];
        }

        // Filtr daty weekendu (piątek i niedziela)
        if (!empty($filters['start_date']) && !empty($filters['end_date'])) {
            $query .= " AND z.data_start >= :start_date AND z.data_koniec <= :end_date";
            $params['start_date'] = $filters['start_date'];
            $params['end_date'] = $filters['end_date'];
        }

        $query .= "
GROUP BY 
    z.data_start 
ORDER BY 
    z.data_start;
";

        //$query .= " ORDER BY z.data_start";

        if (empty($params)) {
            return [];
        }

        $statement = $pdo->prepare($query);
        $statement->execute($params);

        $zajeciaArray = [];
        while ($row = $statement->fetch(\PDO::FETCH_ASSOC)) {
            $zajecia = self::fromArray($row);
            $zajecia->teacher_name = $row['teacher_name'] ?? null;
            $zajecia->room_name = $row['room_name'] ?? null;
            $zajecia->subject_name = $row['subject_name'] ?? null;
            $zajecia->data_start = $row['data_start'] ?? null;
            $zajecia->data_koniec = $row['data_koniec'] ?? null;
            $zajeciaArray[] = $zajecia;
        }

        error_log("Query: $query");
        error_log("Params: " . print_r($params, true));

        return $zajeciaArray;
    }



    // Gettery i settery dla podstawowych pól

    public function getSubjectName(): ?string {
        return $this->subject_name;
    }

    public function getRoomName(): ?string {
        return $this->room_name;
    }


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

    // Pobieranie danych z relacjami

    // Metoda do tworzenia obiektu z tablicy
    public static function fromArray($array): Zajecia
    {
        $zajecia = new self();
        $zajecia->lesson_type = $array['lesson_type'] ?? null;
        $zajecia->fill($array);
        return $zajecia;
    }

    private function sanitizeClassName(string $name): string {
        $replace = [
            'ą' => 'a', 'ć' => 'c', 'ę' => 'e', 'ł' => 'l',
            'ń' => 'n', 'ó' => 'o', 'ś' => 's', 'ż' => 'z', 'ź' => 'z',
            'Ą' => 'A', 'Ć' => 'C', 'Ę' => 'E', 'Ł' => 'L',
            'Ń' => 'N', 'Ó' => 'O', 'Ś' => 'S', 'Ż' => 'Z', 'Ź' => 'Z',
        ];
        return strtr($name, $replace);
    }


    // Metoda do wypełniania obiektu
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
}
