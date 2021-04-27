p <?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contrat
 *
 * @ORM\Table(name="contrat", indexes={@ORM\Index(name="id_userct_fk", columns={"id_ctuser"}), @ORM\Index(name="id_pubct_fk", columns={"id_ctpub"})})
 * @ORM\Entity
 */
class Contrat
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_ctuser", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idCtuser;

    /**
     * @var int
     *
     * @ORM\Column(name="id_ctpub", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idCtpub;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_deb", type="date", nullable=false)
     */
    private $dateDeb;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin", type="date", nullable=false)
     */
    private $dateFin;


}
