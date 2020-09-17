<?php

namespace App\Entity;

use App\Entity\Category as Category;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IdeaRepository")
 */
class Idea
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank(message="Please provide a title for the idea")
     * @Assert\Length(max=255, maxMessage="Max 255 characters")
     * @ORM\Column(type="string", length = 255)
     */
    private $title;

    /**
     * @Assert\Length(min=10, minMessage="Your description is too short 10 characs min")
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @Assert\NotBlank(message="Please provide a author for the idea")
     * @Assert\Length(max=255, maxMessage="Max 255 characters")
     * @ORM\Column(type="text", length=255)
     */
    private $author;

    /**
     *
     * @ORM\Column(type="boolean", length = 255)
     */

    private $isPublished;

    /**
     * @ORM\Column(type="date")
     */
    private $dateCreated;


    /**
     * @var Category
     * @ORM\ManyToOne(targetEntity="\App\Entity\Category", inversedBy="ideas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;


    /**
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param Category $category
     */
    public function setCategory(Category $category)
    {
        $this->category = $category;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author): void
    {
        $this->author = $author;
    }

    /**
     * @return mixed
     */
    public function getIsPublished()
    {
        return $this->isPublished;
    }

    /**
     * @param mixed $isPublished
     */
    public function setIsPublished($isPublished): void
    {
        $this->isPublished = $isPublished;
    }

    /**
     * @return mixed
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * @param mixed $dateCreated
     */
    public function setDateCreated($dateCreated): void
    {
        $this->dateCreated = $dateCreated;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}
