<?php
namespace AppBundle\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;

class Vehicule
{

    /**
     * @var null|string
     */
    private $id;

    /**
     * @Assert\NotBlank(message="Merci d'ajouter une marque.")
     * @var null|string
     */
    private $make;

    /**
     * @Assert\NotBlank(message="Merci d'ajouter une modèle.")
     * @var null|string
     */
    private $model;

    /**
     * @Assert\NotBlank(message="Merci d'ajouter un titre.")
     * @var null|string
     */
    private $title;

    /**
     * @var null|int
     */
    private $price;

    /**
     * @Assert\NotBlank(message="Merci de renseigner une date.")
     * @var null|int
     */
    private $year;

    /**
     * @var null|int
     */
    private $warranty = 0;

    /**
     * @var null|array
     */
    private $images;

    /**
     * @Assert\NotBlank(message="Merci d'ajouter une image.")
     * @Assert\File(
     *     maxSize = "20048k",
     *     mimeTypes={ "image/*" },
     *     mimeTypesMessage = "Please upload a valid PDF"
     *     )
     */
    private $main_image;

    /**
     * @Assert\NotBlank(message="Merci d'ajouter une description.")
     * @var null|string
     */
    private $description;

    /**
     * @var null|bool
     */
    private $sold = false;

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
     * Gets the value of make.
     *
     * @return null|string
     */
    public function getMake()
    {
        return $this->make;
    }

    /**
     * Sets the value of make.
     *
     * @param null|string $make the make
     *
     * @return self
     */
    public function setMake($make)
    {
        $this->make = $make;

        return $this;
    }



    /**
     * Gets the value of title.
     *
     * @return null|string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets the value of title.
     *
     * @param null|string $title the title
     *
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Gets the value of price.
     *
     * @return null|int
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Sets the value of price.
     *
     * @param null|int $price the price
     *
     * @return self
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Gets the value of year.
     *
     * @return null|int
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Sets the value of year.
     *
     * @param null|int $year the year
     *
     * @return self
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Gets the value of warranty.
     *
     * @return null|int
     */
    public function getWarranty()
    {
        return $this->warranty;
    }

    /**
     * Sets the value of warranty.
     *
     * @param null|int $warranty the warranty
     *
     * @return self
     */
    public function setWarranty($warranty)
    {
        $this->warranty = $warranty;

        return $this;
    }

    /**
     * Gets the value of images.
     *
     * @return null|array
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Sets the value of images.
     *
     * @param null|array $images the images
     *
     * @return self
     */
    public function setImages($images)
    {
        $this->images = $images;

        return $this;
    }



    /**
     * Gets the value of description.
     *
     * @return null|string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Sets the value of description.
     *
     * @param null|string $description the description
     *
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Gets the value of sold.
     *
     * @return null|bool
     */
    public function getSold()
    {
        return $this->sold;
    }

    /**
     * Sets the value of sold.
     *
     * @param null|bool $sold the sold
     *
     * @return self
     */
    public function setSold($sold)
    {
        $this->sold = $sold;

        return $this;
    }

    /**
     * Gets the value of main_image.
     *
     * @return mixed
     */
    public function getMainImage()
    {
        return $this->main_image;
    }

    /**
     * Sets the value of main_image.
     *
     * @param mixed $main_image the main image
     *
     * @return self
     */
    public function setMainImage($main_image)
    {
        $this->main_image = $main_image;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param null|string $model
     */
    public function setModel($model)
    {
        $this->model = $model;
    }


}