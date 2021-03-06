<?php

namespace iim\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * Comment
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="iim\BlogBundle\Entity\CommentRepository")
 */
class Comment
{
    use ORMBehaviors\Timestampable\Timestampable;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="string", length=255)
     */
    private $content;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="User")
     */
    private $author;

    /**
     * @var integer
     * @ORM\ManyToOne(targetEntity="Image")
     */
    private $img;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Comment
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     *
     * Set author
     * @param int $author
     * @return Comment
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * Get author
     * @return int
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     *
     * Set img
     * @param int $img
     * @return Comment
     */
    public function setImg($img)
    {
        $this->img = $img;
    }

    /**
     * Get img
     * @return int
     */
    public function getImg()
    {
        return $this->img;
    }


}
