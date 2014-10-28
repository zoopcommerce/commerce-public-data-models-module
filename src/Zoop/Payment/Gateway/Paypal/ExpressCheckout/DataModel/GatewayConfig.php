<?php

namespace Zoop\Payment\Gateway\Paypal\ExpressCheckout\DataModel;

use Zoop\Payment\DataModel\AbstractGatewayConfig;
use Zoop\Payment\DataModel\UsernameTrait;
use Zoop\Payment\DataModel\PasswordTrait;
use Zoop\Payment\DataModel\SignatureTrait;
use Zoop\Payment\DataModel\PaypalGatewayConfigInterface;
//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

/**
 * @ODM\Document
 */
class GatewayConfig extends AbstractGatewayConfig implements PaypalGatewayConfigInterface
{
    use UsernameTrait;

    use PasswordTrait;

    use SignatureTrait;

    /**
     * @ODM\Collection
     */
    protected $solutionType;

    /**
     * @ODM\Collection
     */
    protected $landingPage;

    /**
     * @ODM\String
     */
    protected $brandName;

    /**
     * @ODM\String
     */
    protected $headerImageUrl;

    /**
     * @ODM\String
     */
    protected $logoImageUrl;

    /**
     * @ODM\String
     */
    protected $borderColor;

    public function __construct()
    {
        parent::__construct();

        $this->solutionType = [];
        $this->landingPage  = [];
    }

    /**
     * @return string
     */
    public function getSolutionType()
    {
        return $this->solutionType;
    }

    /**
     * @param array $solutionType
     */
    public function setSolutionType(array $solutionType)
    {
        $this->solutionType = $solutionType;
    }

    /**
     * @param string $solutionType
     */
    public function addSolutionType($solutionType)
    {
        $this->solutionType[] = $solutionType;
    }

    /**
     * @return string
     */
    public function getLandingPage()
    {
        return $this->landingPage;
    }

    /**
     * @param array $landingPage
     */
    public function setLandingPage(array $landingPage)
    {
        $this->landingPage = $landingPage;
    }

    /**
     * @param string $landingPage
     */
    public function addLandingPage($landingPage)
    {
        $this->landingPage[] = $landingPage;
    }

    /**
     * @return string
     */
    public function getBrandName()
    {
        return $this->brandName;
    }

    /**
     * @param string $brandName
     */
    public function setBrandName($brandName)
    {
        $this->brandName = $brandName;
    }

    /**
     * @return string
     */
    public function getHeaderImageUrl()
    {
        return $this->headerImageUrl;
    }

    /**
     * @param string $headerImageUrl
     */
    public function setHeaderImageUrl($headerImageUrl)
    {
        $this->headerImageUrl = $headerImageUrl;
    }

    /**
     * @return the $logoImageUrl
     */
    public function getLogoImageUrl()
    {
        return $this->logoImageUrl;
    }

    /**
     * @param field_type $logoImageUrl
     */
    public function setLogoImageUrl($logoImageUrl)
    {
        $this->logoImageUrl = $logoImageUrl;
    }

    /**
     * @return string
     */
    public function getBorderColor()
    {
        return $this->borderColor;
    }

    /**
     * @param string $borderColor
     */
    public function setBorderColor($borderColor)
    {
        $this->borderColor = $borderColor;
    }
}
