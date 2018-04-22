<?php
namespace Feiffy\PHPCrawler\Entity;
/**
 * @Entity @Table(name="book", uniqueConstraints={@UniqueConstraint(name="unique", columns={"isbn"})})
 */
class Book
{
    /**
     * @Id @Column(type="integer") @GeneratedValue
     * @var int
     */
    protected $id;

    /**
     * @Column(type="string")
     * @var string
     */
    protected $title;

    /**
     * @Column(type="string", nullable=true)
     * @var string
     */
    protected $sub_title;

    /**
     * @Column(type="string")
     * @var string
     */
    protected $author;

    /**
     * @Column(type="string")
     * @var string
     */
    protected $publisher;

    /**
     * @Column(type="string")
     * @var string
     */
    protected $publish_date;

    /**
     * @Column(type="string")
     * @var string
     */
    protected $isbn;

    /**
     * @Column(type="string")
     * @var string
     */
    protected $size;

    /**
     * @Column(type="integer")
     * @var int
     */
    protected $pages;

    /**
     * @Column(type="integer")
     * @var int
     */
    protected $wordage;

    /**
     * @Column(type="string")
     * @var string
     */
    protected $paper_type;

    /**
     * @Column(type="string")
     * @var string
     */
    protected $packet_type;

    /**
     * @Column(type="datetime", nullable=true, options={"default": null})
     * @var \DateTime
     */
    protected $updated_time;

    /**
     * @Column(type="datetime", nullable=true, options={"default": null})
     * @var \DateTime
     */
    protected $created_time;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getSubTitle()
    {
        return $this->sub_title;
    }

    /**
     * @param mixed $sub_title
     */
    public function setSubTitle($sub_title)
    {
        $this->sub_title = $sub_title;
    }

    /**
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * @param string $author
     */
    public function setAuthor(string $author)
    {
        $this->author = $author;
    }

    /**
     * @return string
     */
    public function getPublisher(): string
    {
        return $this->publisher;
    }

    /**
     * @param string $publisher
     */
    public function setPublisher(string $publisher)
    {
        $this->publisher = $publisher;
    }

    /**
     * @return string
     */
    public function getPublishDate(): string
    {
        return $this->publish_date;
    }

    /**
     * @param string $publish_date
     */
    public function setPublishDate(string $publish_date)
    {
        $this->publish_date = $publish_date;
    }

    /**
     * @return string
     */
    public function getIsbn(): string
    {
        return $this->isbn;
    }

    /**
     * @param string $isbn
     */
    public function setIsbn(string $isbn)
    {
        $this->isbn = $isbn;
    }

    /**
     * @return string
     */
    public function getSize(): string
    {
        return $this->size;
    }

    /**
     * @param string $size
     */
    public function setSize(string $size)
    {
        $this->size = $size;
    }

    /**
     * @return int
     */
    public function getPages(): int
    {
        return $this->pages;
    }

    /**
     * @param int $pages
     */
    public function setPages(int $pages)
    {
        $this->pages = $pages;
    }

    /**
     * @return int
     */
    public function getWordage(): int
    {
        return $this->wordage;
    }

    /**
     * @param int $wordage
     */
    public function setWordage(int $wordage)
    {
        $this->wordage = $wordage;
    }

    /**
     * @return string
     */
    public function getPaperType(): string
    {
        return $this->paper_type;
    }

    /**
     * @param string $paper_type
     */
    public function setPaperType(string $paper_type)
    {
        $this->paper_type = $paper_type;
    }

    /**
     * @return string
     */
    public function getPacketType(): string
    {
        return $this->packet_type;
    }

    /**
     * @param string $packet_type
     */
    public function setPacketType(string $packet_type)
    {
        $this->packet_type = $packet_type;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedTime(): \DateTime
    {
        return $this->updated_time;
    }

    /**
     * @param \DateTime $updated_time
     */
    public function setUpdatedTime(\DateTime $updated_time)
    {
        $this->updated_time = $updated_time;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedTime(): \DateTime
    {
        return $this->created_time;
    }

    /**
     * @param \DateTime $created_time
     */
    public function setCreatedTime(\DateTime $created_time)
    {
        $this->created_time = $created_time;
    }
}