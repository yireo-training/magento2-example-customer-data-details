<?php
declare(strict_types=1);

namespace Yireo\ExampleCustomerDataDetails\Plugin\CustomerData;

use Magento\Customer\CustomerData\Customer as Subject;
use Magento\Customer\Helper\Session\CurrentCustomer;

/**
 * Class CustomerPlugin
 * @package Yireo\ExampleCustomerDataDetails\Plugin\CustomerData
 */
class CustomerPlugin
{
    /**
     * @var CurrentCustomer
     */
    protected $currentCustomer;

    /**
     * @param CurrentCustomer $currentCustomer
     */
    public function __construct(
        CurrentCustomer $currentCustomer
    ) {
        $this->currentCustomer = $currentCustomer;
    }

    /**
     * @param Subject $subject
     * @param $returnValue
     * @return array
     */
    public function afterGetSectionData(Subject $subject, $returnValue)
    {
        if (!$this->currentCustomer->getCustomerId()) {
            return [];
        }

        $customer = $this->currentCustomer->getCustomer();

        $returnValue['email'] = $customer->getEmail();
        $returnValue['middlename'] = $customer->getMiddlename();
        $returnValue['lastname'] = $customer->getLastname();
        $returnValue['gender'] = $customer->getGender();

        return $returnValue;
    }
}
