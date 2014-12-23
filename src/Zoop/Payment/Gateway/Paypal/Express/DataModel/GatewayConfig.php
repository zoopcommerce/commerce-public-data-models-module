<?php

namespace Zoop\Payment\Gateway\Paypal\Express\DataModel;

use Zoop\Payment\DataModel\AbstractGatewayConfig;
use Zoop\Payment\DataModel\UsernameTrait;
use Zoop\Payment\DataModel\PasswordTrait;
use Zoop\Payment\DataModel\SignatureTrait;
use Zoop\Payment\DataModel\PayPalGatewayConfigInterface;
use Zoop\Payment\DataModel\OmnipayTrait;
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
    use OmnipayTrait;

    /**
     * @ODM\String
     */
    protected $solutionType;

    /**
     * @ODM\String
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

    /**
     * @return string
     */
    public function getSolutionType()
    {
        return $this->solutionType;
    }

    /**
     * @param string $solutionType
     */
    public function setSolutionType($solutionType)
    {
        $this->solutionType = $solutionType;
    }

    /**
     * @return string
     */
    public function getLandingPage()
    {
        return $this->landingPage;
    }

    /**
     * @param string $landingPage
     */
    public function setLandingPage($landingPage)
    {
        $this->landingPage = $landingPage;
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

    /**
     * @return string $type
     */
    public function getType()
    {
        return parent::TYPE_PAYPAL_EXPRESS;
    }
}
