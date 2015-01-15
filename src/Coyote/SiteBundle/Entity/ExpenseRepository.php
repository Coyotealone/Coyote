<?php

namespace Coyote\SiteBundle\Entity;

use Coyote\SiteBundle\Entity\Site;
use Coyote\SiteBundle\Entity\Currency;
use Coyote\SiteBundle\Entity\Business;
use Coyote\SiteBundle\Entity\Fee;
use Coyote\SiteBundle\Entity\UserFees;

use Doctrine\ORM\EntityRepository;

/**
 * ExpenseRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ExpenseRepository extends EntityRepository
{
    /**
     * find expense user by date.
     *
     * @access public
     * @param mixed $date
     * @param mixed $id
     * @return array expense
     */
    public function findExpense($date, $id)
    {
        $query = $this->getEntityManager()
                        ->createQuery("
	            SELECT e FROM CoyoteSiteBundle:Expense e
	            WHERE e.userfees = :id and e.date LIKE :date"
                        );
        $query->setParameters(array('date' => $date, 'id' => $id));
        return $query->getResult();
    }

    /**
     * update all status expense.
     *
     * @access public
     * @param mixed $em
     * @return "OK"
     */
    public function updateStatus()
    {
        $expense = $this->_em->getRepository('CoyoteSiteBundle:Expense')->findAll();
        foreach($expense as $data)
        {
            $data->setStatus(0);
            $this->_em->persist($data);
        }
        $this->_em->flush();
        return "OK";
    }

    /**
     * export expense to import in ERP.
     *
     * @access public
     * @return string
     */
    public function fileDataExpenseCompta()
    {
        $query = $this->getEntityManager()
                      ->createQuery("
                        SELECT e FROM CoyoteSiteBundle:Expense e
                        WHERE e.status = 1 ORDER BY e.userfees "
                        );
        $res = $query->getResult();

        $result = '';
        $userfees = '';
        foreach($res as $data)
        {
            if($data->getUserFees()->getLogin() != $userfees)
            {
                $userfees = $data->getUserFees()->getLogin();
                $result .= "H;".$data->getUserFees()->getLogin()."\r\n";
            }
            $result .= "D;";
            $result .= $data->getUserFees()->getLogin().";";//En majuscule
            $result .= $data->getSite()->getCode().";";
            $result .= $data->getDate()->format('dmy').";";
            $result .= $data->getFee()->getCode().";";
            $result .= $data->getCurrency()->getCode().";";
            $result .= $data->getAmount().";";
            $result .= $data->getActualAmount().";";
            $result .= $data->getAmountTTC().";";
            $result .= $data->getFee()->getCodeRate().";";
            $result .= $data->getAmountTVA().";";
            $result .= $data->getAmountTVA().";";
            if($data->getFee()->getCode() == "ENTRE1")
                $result .= $data->getUserFees()->getCar()->getCode().";;";
            else
                $result .= $data->getUserFees()->getCode().";;";
            $result .= $data->getBusiness()->getCode().";";
            $result .= $data->getUserFees()->getService().";";
            $result .= $data->getComment().";\r\n";

        }

        return $result;
    }

    /**
     * computing VAT with price and rate .
     *
     * @access public
     * @param mixed $rate
     * @param mixed $price
     * @return float
     */
    public function calculTVA($rate, $price)
    {
        $vat_amount = $price - (($price * 100) / ($rate +100));
        return round($vat_amount, 2);
    }

    /**
     * generate date.
     *
     * @access public
     * @param mixed $date
     * @return string
     */
    public function formDate($date)
    {
        if(is_numeric($date))
        {
            $jour = substr($date, 0, 2);
            $mois = substr($date, 2, 2);
            $annee = substr($date, 4, 2);
            $date = $jour."/".$mois."/".$annee;
            $datetime = new \DateTime();
            $datetime->createFromFormat('d/m/y', $date);
        }
        return $datetime;
    }

    public function checkDate($date)
    {
        if(is_numeric($date))
        {
            return $this->formDate($date);
        }
        else
            return $date;
    }

    /**
     * prepare save expense user fees.
     *
     * @access public
     * @param mixed $user_fee_id
     * @param mixed $data
     * @param mixed $increment
     * @return array expense
     */
    public function saveExpense($user_fee_id, $data, $increment)
    {
        $site = $this->_em->getRepository('CoyoteSiteBundle:Site')->find($data['site'.$increment]);
        $currency = $this->_em->getRepository('CoyoteSiteBundle:Currency')->find($data['devise'.$increment]);
        $business = $this->_em->getRepository('CoyoteSiteBundle:Business')->find($data['affaire'.$increment]);
        $fee = $this->_em->getRepository('CoyoteSiteBundle:Fee')->find($data['article'.$increment]);
        $user_fee = $this->_em->getRepository('CoyoteSiteBundle:UserFees')->find($user_fee_id);

        $expense = new expense();
        $expense->setUserFees($user_fee);
        $expense->setFee($fee);
        $expense->setBusiness($business);
        $expense->setCurrency($currency);
        $expense->setSite($site);
        $expense->setComment($data['com'.$increment]);
        $rate = $fee->getRate();
        $price = $data['ttc'.$increment];
        $tva = $this->calculTVA($rate, $price);
        $expense->setAmountTVA($tva);
        $expense->setAmountTTC($price);
        $expense->setActualAmount($price);
        $expense->setAmount($data['qte'.$increment]);
        $expense->setStatus(1);
        $date = $this->checkDate($data['date'.$increment]);
        $format = 'd/m/y H:i:s';
        $datetime = \DateTime::createFromFormat($format, $date.' 00:00:00');
        $expense->setDate($datetime);
        return $expense;
    }

    public function findExpenseById($id_start, $id_end)
    {
        $query = $this->getEntityManager()
                      ->createQuery("
        	            SELECT e FROM CoyoteSiteBundle:Expense e
        	            WHERE e.id = :idstart "
                        );
        $query->setParameters(array('idstart' => $id_start, 'idend' => $id_end));
        return $query->getResult();
    }

    public function updateStatusExense($em, $expense)
    {
        foreach($expense as $data)
        {
            $data->setStatus(1);
            $em->persist($data);
        }
        $em->flush();
        return "OK";
    }
}
