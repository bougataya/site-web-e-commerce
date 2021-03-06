<?php

namespace SBS\AdminstrationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
// N'oubliez pas ce use :
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * ImageDescription
 *
 * @ORM\Table(name="image_description")
 * @ORM\Entity(repositoryClass="SBS\AdminstrationBundle\Repository\ImageDescriptionRepository")
 */
class ImageDescription
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=250)
     */
    private $url;

 private $file;
  
    public function getFile()
  {
    return $this->file;
  }

  public function setFile(UploadedFile $file = null)
  {
    $this->file = $file;
  }

	public function upload()
  {
    // Si jamais il n'y a pas de fichier (champ facultatif), on ne fait rien
    if (null === $this->file) {
      return;
    }

    // On récupère le nom original du fichier de l'internaute
    $name = $this->file->getClientOriginalName();

    // On déplace le fichier envoyé dans le répertoire de notre choix
    $this->file->move($this->getUploadRootDir(), $name);

    // On sauvegarde le nom de fichier dans notre attribut $url
    $this->url = $name;

  }

  public function getUploadDir()
  {
    // On retourne le chemin relatif vers l'image pour un navigateur (relatif au répertoire /web donc)
    return 'uploads/img';
  }

  protected function getUploadRootDir()
  {
    // On retourne le chemin relatif vers l'image pour notre code PHP
    return __DIR__.'/../../../../web/'.$this->getUploadDir();
  }

	public function isnull(){
		if ( empty($this->file) )
			return 'khawya';
		else
			return '3ammra';
	}
	
	public function supprimer($sup){
		unlink($this->getUploadRootDir().'/'.$sup);

	}
	
	 public function getWebPath()
  {
    return $this->getUploadDir().'/'.$this->getUrl();
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
     * Set url
     *
     * @param string $url
     * @return ImageDescription
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }
}
