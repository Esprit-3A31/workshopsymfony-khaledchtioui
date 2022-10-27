<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StudentRepository::class)]
class Student
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $Ref= null;

    #[ORM\Column(length: 100)]
    private ?string $Username = null;

    #[ORM\ManyToOne(inversedBy: 'students')]
    #[ORM\JoinColumn(onDelete: "CASCADE")]

    private ?Classroom $classroom = null;


    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->Ref;
    }



    public function getUsername(): ?string
    {
        return $this->Username;
    }

    public function setUsername(string $Username): self
    {
        $this->Username = $Username;

        return $this;
    }

    public function getClassroom(): ?Classroom
    {
        return $this->classroom;
    }

    public function setClassroom(?Classroom $classroom): self
    {
        $this->classroom = $classroom;

        return $this;
    }

}
