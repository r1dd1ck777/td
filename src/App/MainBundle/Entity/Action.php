<?php

namespace App\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Rid\Bundle\ImageBundle\Model\RidImage;

/**
 * @ORM\Table(name="td_action")
 * @ORM\Entity
 */
class Action
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="rid_image", length=255, options={"default" = ""})
     */
    private $image;

    public function __construct()
    {
        $this->image = new RidImage();
    }

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
     * Set image
     *
     * @param rid_image $image
     * @return Action
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return rid_image 
     */
    public function getImage()
    {
        return $this->image;
    }
}
