<?php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use DateTime;
/**
 *@Entity
 */
class Article {
	/**
	 * @Column(type="integer")
	 * @Id
	 * @GeneratedValue
	 */
	private $id;


	/**
	 * @Column(type="string")
	 */
	private $name;


	/**
	 * @Column(type="string", unique=true)
	 */
	private $slug;

	/**
	 * @Column(type="string")
	 */
	private $image;


	/**
	 * @Column(type="text")
	 */
	private $body;

    /** @ManyToMany(targetEntity="Author")
	 * @JoinTable(name="article_authors",
	 *      joinColumns={@JoinColumn(name="article_id", referencedColumnName="id")},
	 *      inverseJoinColumns={@JoinColumn(name="author_id", referencedColumnName="id")}
	 * )
     */

    private $author;


	/**
	 * @Column(type="datetime")
	 */
	private $published;

	/** 
	 * @ManyToMany(targetEntity="Tag", inversedBy="articles", cascade={"persist"})
	 * @JoinTable(name="article_tags")
	 * @JoinColumn(referencedColumnName="id", nullable=false)
	 */
	private $tags;

	public function __construct() {
		$this->tags = new ArrayCollection();
	}
	public function getId(){
		return $this->id;
	}
	public function setId($value){
		$this->id = $value;
	}

	public function getName(){
		return $this->name;
	}
	public function setName($value){
		$this->name = $value;
	}

	public function getSlug(){
		return $this->slug;
	}
	public function setSlug($value){
		$this->slug = $value;
	}

	public function getImage(){
		return $this->image;
	}
	public function setImage($value){
		$this->image = $value;
	}

	public function getBody(){
		return $this->body;
	}
	public function setBody($value){
		$this->body = $value;
	}

	public function getPublished(){
		return $this->published;
	}
	  public function setPublished(DateTime $value = null) {
        $this->published = $value;
    }
    public function getAuthor(){
        return $this->author;
    }
    public function setAuthor($value){
        $this->author = $value;
    }
	public function getTags(){
		return $this->tags;
	}
} 