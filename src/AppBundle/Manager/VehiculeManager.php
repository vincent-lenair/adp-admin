<?php

namespace AppBundle\Manager;

use AppBundle\Form\Model\Vehicule;
use GuzzleHttp\ClientInterface;
use Symfony\Component\Filesystem\Filesystem;

class VehiculeManager
{


    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var string
     */
    private $imagesPath;

    /**
     * VehiculeManager constructor.
     */
    public function __construct(ClientInterface $client, $imagesPath)
    {
        $this->client = $client;
        $this->imagesPath = $imagesPath;
    }

    public function getVehicules()
    {
        $response = $this->client->request('GET', '/vehicules');
        return json_decode($response->getBody(), true);
    }

    /**
     * @param Vehicule $vehicule
     */
    public function save(Vehicule $vehicule)
    {
        $datas = array(
            'id' => $vehicule->getId(),
            'make' => $vehicule->getMake(),
            'model' => $vehicule->getModel(),
            'title' => $vehicule->getTitle(),
            'description' => $vehicule->getDescription(),
            'price' => $vehicule->getPrice(),
            'sold' => $vehicule->getSold(),
            'warranty' => $vehicule->getWarranty(),
            'year' => $vehicule->getYear(),
        );

        $images = array();

        foreach ($vehicule->getImages() as $image) {
            if ($image) {
                $filename = uniqid() . '.jpg';
                $images[] = $filename;
                $image->move($this->imagesPath, $filename);
            }
        }
        $datas['images'] = $images;

        $filename = uniqid() . '.jpg';
        $vehicule->getMainImage()->move($this->imagesPath, $filename);
        $datas['main_image'] = $filename;

        $this->client->request('POST', '/vehicules', ['json' => $datas]);
    }

    /**
     * @param $vehiculeId string
     */
    public function delete($vehiculeId)
    {

        $vehicule = $this->find($vehiculeId);

        unlink($this->imagesPath.$vehicule->getMainImage());
        foreach ($vehicule->getImages() as $image) {
            unlink($this->imagesPath.$image);
        }
        $this->client->request('DELETE', '/vehicules/' . $vehiculeId);
    }

    /**
     * @param $vehiculeId
     * @return
     */
    public function find($vehiculeId)
    {
        $response = $this->client->request('GET', '/vehicules/' . $vehiculeId);
        $vehiculeData = json_decode($response->getBody(), true);
        return $this->createVehicule($vehiculeData);
    }

    /**
     * @param $vehiculeData
     */
    private function createVehicule($vehiculeData)
    {
        $vehicule = new Vehicule();
        $vehicule->setDescription($vehiculeData['description']);
        if (array_key_exists('images', $vehiculeData)) {
            $vehicule->setImages($vehiculeData['images']);
        }
        if (array_key_exists('price', $vehiculeData)) {
            $vehicule->setPrice($vehiculeData['price']);
        }
        if (array_key_exists('id', $vehiculeData)) {
            $vehicule->setId($vehiculeData['id']);
        }
        $vehicule->setMainImage($vehiculeData['main_image']);
        $vehicule->setMake($vehiculeData['make']);
        $vehicule->setModel($vehiculeData['model']);
        $vehicule->setSold($vehiculeData['sold']);
        $vehicule->setTitle($vehiculeData['title']);
        $vehicule->setWarranty($vehiculeData['warranty']);
        $vehicule->setYear($vehiculeData['year']);
        return $vehicule;
    }
}