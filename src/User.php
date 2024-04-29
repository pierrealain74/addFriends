<?php 

class User
{

    // Constructeur en PHP8
    public function __construct(
        private string $firstname, private string $lastname, private string $email, private string $description, private string $age
        ){}


    // Setter pour firstname
    public function setFirstname(string $firstname): void 
    {
        $this->firstname = $firstname;
    }

    // Getter pour firstname
    public function getFirstname(): string 
    {
        return $this->firstname;
    }

    // Setter pour lastname
    public function setLastname(string $lastname): void 
    {
        $this->lastname = $lastname;
    }

    // Getter pour lastname
    public function getLastname(): string 
    {
        return $this->lastname;
    }

    // Setter pour email
    public function setEmail(string $email): void 
    {
        $this->email = $email;
    }

    // Getter pour email
    public function getEmail(): string 
    {
        return $this->email;
    }

    // Setter pour description
    public function setDescription(string $description): void 
    {
        $this->description = $description;
    }

    // Getter pour description
    public function getDescription(): string 
    {
        return $this->description;
    }

    // Setter pour age
    public function setAge(string $age): void 
    {
        $this->age = $age;
    }

    // Getter pour age
    public function getAge(): string 
    {
        return $this->age;
    }

    // To validate form
    public function validateForm(): array 
    {
        $errors = [];

        // No field should be empty
        if (empty($this->firstname) || empty($this->lastname) || empty($this->email) || empty($this->description) || empty($this->age)) {
            $errors[] = "Tous les champs sont obligatoires.";
        }

        // To validate email format
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "L'adresse email n'est pas valide.";
        }

        // To validate a date in the Age field
        if (strtotime($this->age) === false) {
            $errors[] = "La date de naissance n'est pas valide.";
        }

        return $errors;
    }

    public function insertIntoDatabase(\PDO $pdo, string $photoFileName): bool 
    {
        $formattedDate = date('Y-m-d', strtotime($this->age));

        $query = "INSERT INTO user (firstname, lastname, email, age, description, photo) VALUES (:firstname, :lastname, :email, :age, :description, :photo)";
        $stmt = $pdo->prepare($query);

        $stmt->bindValue(':firstname', $this->firstname, \PDO::PARAM_STR);
        $stmt->bindValue(':lastname', $this->lastname, \PDO::PARAM_STR);
        $stmt->bindValue(':email', $this->email, \PDO::PARAM_STR);
        $stmt->bindValue(':description', $this->description, \PDO::PARAM_STR);
        $stmt->bindValue(':age', $formattedDate, \PDO::PARAM_STR);
        $stmt->bindValue(':photo', $photoFileName, \PDO::PARAM_STR);

        return $stmt->execute();
    }


}

?>