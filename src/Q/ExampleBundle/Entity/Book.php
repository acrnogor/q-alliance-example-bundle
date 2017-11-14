<?php

namespace Q\ExampleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Q\ExampleBundle\Entity\EntityInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Book
 *
 * @ORM\Table(name="books")
 * @ORM\Entity(repositoryClass="Q\ExampleBundle\Repository\BookRepository")
 */
class Book implements EntityInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @JMS\SerializedName("id")
     * @JMS\Groups({"default", "light"})
     * @JMS\Type("integer")
     * @Assert\Type("integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Author", inversedBy="books", cascade={"persist"})
     * @JMS\SerializedName("author")
     * @JMS\Groups({"author"})
     * @JMS\Type("Q\ExampleBundle\Entity\Author")
     * @Assert\NotNull(message="Please select author")
     */
    private $author;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     * @JMS\SerializedName("title")
     * @JMS\Groups({"default", "light"})
     * @JMS\Type("string")
     * @Assert\NotBlank(message="Please enter title")
     */
    private $title;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="release_date", type="date")
     * @JMS\SerializedName("release_date")
     * @JMS\Groups({"default", "light"})
     * @JMS\Type("DateTime<'Y-m-d'>")
     * @Assert\Date(message="Please provide a valid date")
     */
    private $releaseDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     * @JMS\SerializedName("updated_at")
     * @JMS\Groups({"default", "light"})
     * @JMS\Type("DateTime<'Y-m-d H:i:s'>")
     */
    private $updatedAt;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     * @JMS\SerializedName("description")
     * @JMS\Groups({"default"})
     * @JMS\Type("string")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="isbn", type="string", length=255)
     * @JMS\SerializedName("isbn")
     * @JMS\Groups({"default", "light"})
     * @JMS\Type("integer")
     * @Assert\NotBlank(message="Please enter ISBN number")
     * @Assert\Isbn(message="Please provide a valid ISBN")
     */
    private $isbn;

    /**
     * @var string
     *
     * @ORM\Column(name="format", type="string", length=255)
     * @JMS\SerializedName("format")
     * @JMS\Groups({"default", "light"})
     * @JMS\Type("string")
     */
    private $format;

    /**
     * @var int
     *
     * @ORM\Column(name="number_of_pages", type="integer")
     * @JMS\SerializedName("number_of_pages")
     * @JMS\Groups({"default", "light"})
     * @JMS\Type("integer")
     * @Assert\Type("integer")
     *
     */
    private $numberOfPages;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
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
     * @return Book
     */
    public function setAuthor($author)
    {
        $this->author = $author;
        return $this;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Book
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set releasedAt
     *
     * @param \DateTime $releaseDate
     *
     * @return Book
     */
    public function setReleaseDate($releaseDate)
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    /**
     * Get releaseDate
     *
     * @return \DateTime
     */
    public function getReleaseDate()
    {
        return $this->releaseDate;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTimeInterface $updatedAt
     *
     * @return Book
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Book
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set isbn
     *
     * @param string $isbn
     *
     * @return Book
     */
    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;

        return $this;
    }

    /**
     * Get isbn
     *
     * @return string
     */
    public function getIsbn()
    {
        return $this->isbn;
    }

    /**
     * Set format
     *
     * @param string $format
     *
     * @return Book
     */
    public function setFormat($format)
    {
        $this->format = $format;

        return $this;
    }

    /**
     * Get format
     *
     * @return string
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * Set numberOfPages
     *
     * @param integer $numberOfPages
     *
     * @return Book
     */
    public function setNumberOfPages($numberOfPages)
    {
        $this->numberOfPages = $numberOfPages;

        return $this;
    }

    /**
     * Get numberOfPages
     *
     * @return int
     */
    public function getNumberOfPages()
    {
        return $this->numberOfPages;
    }

    /**
     * @JMS\VirtualProperty()
     * @JMS\SerializedName("author_name")
     * @JMS\Groups({"author_name"})
     *
     * @return string
     */
    public function getAuthorName()
    {
        $author = $this->getAuthor();

        if ($author instanceof Author) {
            return trim(sprintf('%s %s', $author->getFirstName(), $author->getLastName()));
        }

        return '';
    }
}

