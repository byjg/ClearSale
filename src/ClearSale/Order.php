<?php

namespace ClearSale;

class Order
{
    const DATE_TIME_FORMAT = 'Y-m-d\TH:i:s';

    const ECOMMERCE_B2B = 'b2b';
    const ECOMMERCE_B2C = 'b2c';

    private static $ecommerceTypes = array(
        self::ECOMMERCE_B2B,
        self::ECOMMERCE_B2C,
    );

    const STATUS_NOVO = 0;
    const STATUS_APROVADO = 9;
    const STATUS_CANCELADO = 41;
    const STATUS_REPROVADO = 45;

    private static $statuses = array(
        self::STATUS_NOVO,
        self::STATUS_APROVADO,
        self::STATUS_CANCELADO,
        self::STATUS_REPROVADO,
    );

    const PRODUCT_A_CLEAR_SALE = 1;
    const PRODUCT_M_CLEAR_SALE = 2;
    const PRODUCT_T_CLEAR_SALE = 3;
    const PRODUCT_TG_CLEAR_SALE = 4;
    const PRODUCT_TH_CLEAR_SALE = 5;
    const PRODUCT_TG_LIGHT_CLEAR_SALE = 6;
    const PRODUCT_TG_FULL_CLEAR_SALE = 7;
    const PRODUCT_T_MONITORADO = 8;
    const PRODUCT_SCORE_DE_FRAUDE = 9;
    const PRODUCT_CLEAR_ID = 10;
    const PRODUCT_ANALISE_INTERNACIONAL = 11;

    private static $products = array(
        self::PRODUCT_A_CLEAR_SALE,
        self::PRODUCT_M_CLEAR_SALE,
        self::PRODUCT_T_CLEAR_SALE,
        self::PRODUCT_TG_CLEAR_SALE,
        self::PRODUCT_TH_CLEAR_SALE,
        self::PRODUCT_TG_LIGHT_CLEAR_SALE,
        self::PRODUCT_TG_FULL_CLEAR_SALE,
        self::PRODUCT_T_MONITORADO,
        self::PRODUCT_SCORE_DE_FRAUDE,
        self::PRODUCT_CLEAR_ID,
        self::PRODUCT_ANALISE_INTERNACIONAL,
    );

    const LIST_TYPE_NAO_CADASTRADA = 1;
    const LIST_TYPE_CHA_DE_BEBE = 2;
    const LIST_TYPE_CASAMENTO = 3;
    const LIST_TYPE_DESEJOS = 4;
    const LIST_TYPE_ANIVERSARIO = 5;
    const LIST_TYPE_CHA_BAR_OU_CHA_PANELA = 6;

    private static $listTypes = array(
        self::LIST_TYPE_NAO_CADASTRADA,
        self::LIST_TYPE_CHA_DE_BEBE,
        self::LIST_TYPE_CASAMENTO,
        self::LIST_TYPE_DESEJOS,
        self::LIST_TYPE_ANIVERSARIO,
        self::LIST_TYPE_CHA_BAR_OU_CHA_PANELA,
    );

    private $fingerPrint;
    private $id;
    private $date;
    private $email;
    private $ecommerceType;
    private $shippingPrice;
    private $totalItems;
    private $totalOrder;
    private $quantityInstallments;
    private $deliveryTime;
    private $quantityItems;
    private $quantityPaymentTypes;
    private $ip;
    private $gift;
    private $giftMessage;
    private $notes;
    private $status;
    private $reanalysis;
    private $origin;
    private $reservationDate;
    private $country;
    private $nationality;
    private $product;
    private $listType;
    private $listId;

    private $billingData;
    private $shippingData;
    private $payments;
    private $items;
    //private $passengers; // TODO: Not implemented
    //private $connections; // TODO: Not implemented
    //private $hotelReservations; // TODO: Not implemented

    public function __construct()
    {

    }

    public static function create(FingerPrint $fingerPrint, $id, $date, $email, $totalItems, $totalOrder, Customer $billingData, Customer $shippingData, $payments, $items)
    {
        $instance = new self();

        $instance->setFingerPrint($fingerPrint);
        $instance->setId($id);
        $instance->setDate($date, true);
        $instance->setEmail($email);
        $instance->setTotalItems($totalItems);
        $instance->setTotalOrder($totalOrder);
        $instance->setBillingData($billingData);
        $instance->setShippingData($shippingData);
        $instance->setPayments($payments);
        $instance->setItems($items);

        return $instance;
    }

    public function getFingerPrint()
    {
        return $this->fingerPrint;
    }

    public function setFingerPrint(FingerPrint $fingerPrint)
    {
        $this->fingerPrint = $fingerPrint;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getDate()
    {
        return $this->date;
    }

    /**
     *  Set date in format "Y-m-d" or UNIX_TIMESTAMP
     *
     * @param string $date
     * @param bool $isUnixTimestampFormat
     * @return self
     */
    public function setDate($date, $isUnixTimestampFormat = false)
    {
        if (!$isUnixTimestampFormat) {
            $datetime = new \DateTime($date);
        } else {
            $datetime = new \DateTime();
            $datetime->setTimestamp($date);
        }

        $this->date = $datetime->format(self::DATE_TIME_FORMAT);

        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function getEcommerceType()
    {
        return $this->ecommerceType;
    }

    public function setEcommerceType($ecommerceType)
    {
        if (!array_key_exists($ecommerceType, self::$ecommerceTypes)) {
            throw new \InvalidArgumentException(
                sprintf('Invalid ecommerce type (%s)', $type)
            );
        }

        $this->ecommerceType = $ecommerceType;

        return $this;
    }

    public function getShippingPrice()
    {
        return $this->shippingPrice;
    }

    public function setShippingPrice($shippingPrice)
    {
        $this->shippingPrice = $shippingPrice;

        return $this;
    }

    public function getTotalItems()
    {
        return $this->totalItems;
    }

    public function setTotalItems($totalItems)
    {
        $this->totalItems = $totalItems;

        return $this;
    }

    public function getTotalOrder()
    {
        return $this->totalOrder;
    }

    public function setTotalOrder($totalOrder)
    {
        $this->totalOrder = $totalOrder;

        return $this;
    }

    public function getQuantityInstallments()
    {
        return $this->quantityInstallments;
    }

    public function setQuantityInstallments($quantityInstallments)
    {
        $this->quantityInstallments = $quantityInstallments;

        return $this;
    }

    public function getDeliveryTime()
    {
        return $this->deliveryTime;
    }

    public function setDeliveryTime($deliveryTime)
    {
        $this->deliveryTime = $deliveryTime;

        return $this;
    }

    public function getQuantityItems()
    {
        return $this->quantityItems;
    }

    public function setQuantityItems($quantityItems)
    {
        $this->quantityItems = $quantityItems;

        return $this;
    }

    public function getQuantityPaymentTypes()
    {
        return $this->quantityPaymentTypes;
    }

    public function setQuantityPaymentTypes($quantityPaymentTypes)
    {
        $this->quantityPaymentTypes = $quantityPaymentTypes;

        return $this;
    }

    public function getIp()
    {
        return $this->ip;
    }

    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    public function getGift()
    {
        return $this->gift;
    }

    public function setGift($gift)
    {
        $this->gift = $gift;

        return $this;
    }

    public function getGiftMessage()
    {
        return $this->giftMessage;
    }

    public function setGiftMessage($giftMessage)
    {
        $this->giftMessage = $giftMessage;

        return $this;
    }

    public function getNotes()
    {
        return $this->notes;
    }

    public function setNotes($notes)
    {
        $this->notes = $notes;

        return $this;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        if (!array_key_exists($status, self::$statuses)) {
            throw new \InvalidArgumentException(
                sprintf('Invalid status (%s)', $type)
            );
        }

        $this->status = $status;

        return $this;
    }

    public function getReanalysis()
    {
        return $this->reanalysis;
    }

    public function setReanalysis($reanalysis)
    {
        $this->reanalysis = $reanalysis;

        return $this;
    }

    public function getOrigin()
    {
        return $this->origin;
    }

    public function setOrigin($origin)
    {
        $this->origin = $origin;

        return $this;
    }

    public function getReservationDate()
    {
        return $this->reservationDate;
    }

    public function setReservationDate($reservationDate)
    {
        $this->reservationDate = $reservationDate;

        return $this;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    public function getNationality()
    {
        return $this->nationality;
    }

    public function setNationality($nationality)
    {
        $this->nationality = $nationality;

        return $this;
    }

    public function getProduct()
    {
        return $this->product;
    }

    public function setProduct($product)
    {
        if (!array_key_exists($product, self::$products)) {
            throw new \InvalidArgumentException(
                sprintf('Invalid product type (%s)', $type)
            );
        }

        $this->product = $product;

        return $this;
    }

    public function getListType()
    {
        return $this->listType;
    }

    public function setListType($listType)
    {
        if (!array_key_exists($listType, self::$listTypes)) {
            throw new \InvalidArgumentException(
                sprintf('Invalid list type (%s)', $type)
            );
        }

        $this->listType = $listType;

        return $this;
    }

    public function getListId()
    {
        return $this->listId;
    }

    public function setListId($listId)
    {
        $this->listId = $listId;

        return $this;
    }

    public function getBillingData()
    {
        return $this->billingData;
    }

    public function setBillingData(Customer $billingData)
    {
        $this->billingData = $billingData;

        return $this;
    }

    public function getShippingData()
    {
        return $this->shippingData;
    }

    public function setShippingData(Customer $shippingData)
    {
        $this->shippingData = $shippingData;

        return $this;
    }

    public function getPayments()
    {
        return $this->payments;
    }

    public function getPayment($index)
    {
        return $this->payments[$index];
    }

    public function setPayments($payments)
    {
        foreach ($payments as $payment) {
            $this->addPayment($payment);
        }

        return $this;
    }

    public function addPayment(Payment $payment)
    {
        $this->payments[] = $payment;

        return $this;
    }

    public function getItems()
    {
        return $this->items;
    }

    public function setItems($items)
    {
        foreach ($items as $item) {
            $this->addItems($item);
        }

        return $this;
    }

    public function addItems(Item $item)
    {
        $this->items[] = $item;

        return $this;
    }

    public function toXML($prettyPrint = false)
    {
        $xml = new \XMLWriter;
        $xml->openMemory();
        $xml->setIndent($prettyPrint);

        $xml->startElement("ClearSale");
        $xml->startElement("Orders");
        $xml->startElement("Order");

        if ($this->fingerPrint) {
            $this->fingerPrint->toXML($xml);
        }

        if ($this->id) {
            $xml->writeElement("ID", $this->id);
        }

        if ($this->date) {
            $xml->writeElement("Date", $this->date);
        }

        if ($this->email) {
            $xml->writeElement("Email", $this->email);
        }

        if ($this->ecommerceType) {
            $xml->writeElement("B2B_B2C", $this->ecommerceType);
        }

        if ($this->shippingPrice) {
            $xml->writeElement("ShippingPrice", $this->shippingPrice);
        }

        if ($this->totalItems) {
            $xml->writeElement("TotalItems", $this->totalItems);
        }

        if ($this->totalOrder) {
            $xml->writeElement("TotalOrder", $this->totalOrder);
        }

        if ($this->quantityInstallments) {
            $xml->writeElement("QtyInstallments", $this->quantityInstallments);
        }

        if ($this->deliveryTime) {
            $xml->writeElement("DeliveryTimeCD", $this->deliveryTime);
        }

        if ($this->quantityItems) {
            $xml->writeElement("QtyItems", $this->quantityItems);
        }

        if ($this->quantityPaymentTypes) {
            $xml->writeElement("QtyPaymentTypes", $this->quantityPaymentTypes);
        }

        if ($this->ip) {
            $xml->writeElement("IP", $this->ip);
        }

        // TODO: ShippingType not implemented

        if ($this->gift) {
            $xml->writeElement("Gift", $this->gift);
        }

        if ($this->giftMessage) {
            $xml->writeElement("GiftMessage", $this->giftMessage);
        }

        if ($this->notes) {
            $xml->writeElement("Obs", $this->notes);
        }

        if ($this->status) {
            $xml->writeElement("Status", $this->status);
        }

        if ($this->reanalysis) {
            $xml->writeElement("Reanalise", $this->reanalysis);
        }

        if ($this->origin) {
            $xml->writeElement("Origin", $this->origin);
        }

        if ($this->reservationDate) {
            $xml->writeElement("ReservationDate", $this->reservationDate);
        }

        if ($this->country) {
            $xml->writeElement("Country", $this->country);
        }

        if ($this->nationality) {
            $xml->writeElement("Nationality", $this->nationality);
        }

        if ($this->product) {
            $xml->writeElement("Product", $this->product);
        }

        if ($this->listType) {
            $xml->writeElement("ListTypeID", $this->listType);
        }

        if ($this->listId) {
            $xml->writeElement("ListID", $this->listId);
        }

        if ($this->billingData) {
            $xml->startElement("BillingData");
            $this->billingData->toXML($xml);
            $xml->endElement();
        }

        if ($this->shippingData) {
            $xml->startElement("ShippingData");
            $this->shippingData->toXML($xml);
            $xml->endElement();
        }

        if (count($this->payments) > 0) {
            $xml->startElement("Payments");

            foreach ($this->payments as $payment) {
                $payment->toXML($xml);
            }

            $xml->endElement();
        }

        if (count($this->items) > 0) {
            $xml->startElement("Items");

            foreach ($this->items as $item) {
                $item->toXML($xml);
            }

            $xml->endElement();
        }

        $xml->endElement(); // Order
        $xml->endElement(); // Orders
        $xml->endElement(); // ClearSale

        return $xml->outputMemory(true);
    }
}
