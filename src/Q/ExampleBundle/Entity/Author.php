<?php

namespace Q\ExampleBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Author
 *
 * @ORM\Table(name="authors")
 * @ORM\Entity(repositoryClass="Q\ExampleBundle\Repository\AuthorRepository")
 */
class Author implements EntityInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @JMS\SerializedName("id")
     * @JMS\Groups({"default", "light", "author_default"})
     * @JMS\Type("integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=255)
     * @JMS\SerializedName("first_name")
     * @JMS\Groups({"default", "light", "author_default"})
     * @JMS\Type("string")
     * @Assert\NotBlank(message="Please enter first name")
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=255)
     * @JMS\SerializedName("last_name")
     * @JMS\Groups({"default", "light"})
     * @JMS\Type("string")
     * @Assert\NotBlank(message="Please enter last name")
     */
    private $lastName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthday", type="date", nullable=true)
     * @JMS\SerializedName("birthday")
     * @JMS\Groups({"default", "light"})
     * @JMS\Type("DateTime<'Y-m-d'>")
     * @Assert\Date(message="Please enter a valid birthday")
     * @Assert\NotBlank(message="Please enter birthday")
     */
    private $birthday;

    /**
     * @var string
     *
     * @ORM\Column(name="biography", type="text", nullable=true)
     * @JMS\SerializedName("biography")
     * @JMS\Groups({"default", "author_default"})
     * @JMS\Type("string")
     */
    private $biography;

    /**
     * @var string
     *
     * @ORM\Column(name="gender", type="string", length=10)
     * @JMS\SerializedName("gender")
     * @JMS\Groups({"default", "light"})
     * @JMS\Type("string")
     * @Assert\Choice(choices={"male","female"}, message = "Please enter a valid gender")
     */
    private $gender;

    /**
     * @var string
     *
     * @ORM\Column(name="place_of_birth", type="string", length=255)
     * @JMS\SerializedName("place_of_birth")
     * @JMS\Groups({"default", "light"})
     * @JMS\Type("string")
     * @Assert\NotBlank(message="Please enter place of birth")
     */
    private $placeOfBirth;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(
     *     targetEntity="Q\ExampleBundle\Entity\Book",
     *     mappedBy="author",
     *     orphanRemoval=true,
     *     cascade={"persist","remove"}
     * )
     * @JMS\SerializedName("books")
     * @JMS\Groups({"books"})
     * @JMS\MaxDepth(2)
     * @JMS\Type("ArrayCollection<Q\ExampleBundle\Entity\Book>")
     */
    private $books;


    public function __construct()
    {
        $this->books = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return Author
     */
    public function setFirstName($firstName) : Author
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName() : string
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return Author
     */
    public function setLastName($lastName) : Author
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName() : string
    {
        return $this->lastName;
    }

    /**
     * Set birthday
     *
     * @param \DateTime $birthday
     *
     * @return Author
     */
    public function setBirthday($birthday) : Author
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get birthday
     *
     * @return \DateTime
     */
    public function getBirthday() : \DateTime
    {
        return $this->birthday;
    }

    /**
     * Set biography
     *
     * @param string $biography
     *
     * @return Author
     */
    public function setBiography($biography) : Author
    {
        $this->biography = $biography;

        return $this;
    }

    /**
     * Get biography
     *
     * @return string
     */
    public function getBiography() : string
    {
        return $this->biography;
    }

    /**
     * Set gender
     *
     * @param string $gender
     *
     * @return Author
     */
    public function setGender($gender) : Author
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string
     */
    public function getGender() : string
    {
        return $this->gender;
    }

    /**
     * Set placeOfBirth
     *
     * @param string $placeOfBirth
     *
     * @return Author
     */
    public function setPlaceOfBirth($placeOfBirth) : Author
    {
        $this->placeOfBirth = $placeOfBirth;

        return $this;
    }

    /**
     * Get placeOfBirth
     *
     * @return string
     */
    public function getPlaceOfBirth() : string
    {
        return $this->placeOfBirth;
    }

    /**
     * Add book.
     *
     * @param Book $book
     *
     * @return Author
     */
    public function addBook(Book $book) : Author
    {
        if (!$this->books->contains($book)) {
            $this->books->add($book);
        }

        return $this;
    }

    /**
     * Remove book.
     *
     * @param Book $book
     *
     * @return Author
     */
    public function removeBook(Book $book) : Author
    {
        if ($this->books->contains($book)) {
            $this->books->remove($book);
        }

        return $this;
    }

    /**
     * Get books.
     *
     * @return ArrayCollection|Book[]
     */
    public function getBooks() : ArrayCollection
    {
        return $this->books;
    }

    /**
     * @JMS\VirtualProperty()
     * @JMS\SerializedName("name")
     * @JMS\Groups({"default", "light"})
     */
    public function getName()
    {
        return sprintf('%s %s', $this->getFirstName(), $this->getLastName());
    }
}

